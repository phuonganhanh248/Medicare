<?php
class PatientController extends BaseController
{
    private $patientModel;
    private $specialtyModel;
    private $appointmentModel;

    public function __construct()
    {
        $this->loadModel('PatientModel');
        $this->patientModel = new PatientModel();

        $this->loadModel('SpecialtyModel');
        $this->specialtyModel = new SpecialtyModel();

        $this->loadModel('AppointmentModel');
        $this->appointmentModel = new AppointmentModel();

    }

    public function index()
    {
        $listSpecialties = $this->specialtyModel->getSpecialtiesForAdmin();
        $listPatients = $this->patientModel->getPatientForAdmin();
        return $this->view('admin.patients', [
            'listPatients' => $listPatients,
            'listSpecialties' => $listSpecialties,
        ]);
    }

    public function profile()
    {
        session_start();
        if (isset($_SESSION['user_phone'])) {
            $phone = $_SESSION['user_phone'];
            $patient = $this->patientModel->findByPhone($phone);
            return $this->view('client.profile', [
                'patient' => $patient,
            ]);
        } else {
            header('Location: http://localhost/Medicare/index.php?controller=home&action=not_found');
            exit();
        }
    }

    public function detail()
    {
        $id = $_GET['patient_id'] ?? null;
        $patient = $this->patientModel->findById($id);
        $listAppointments = $this->appointmentModel->getAppointmentsByPatient($patient['phone'], $patient['patient_id']);
        return $this->view('admin.patient-detail', [
            'patient' => $patient,
            'listAppointments' => $listAppointments,
        ]);
    }

    public function update_information()
    {
        session_start();
        if (isset($_SESSION['user_phone'])) {
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_SESSION['user_phone'];
            $result = $this->patientModel->updatePatient($name, $gender, $dob, $email, $address, $phone);
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($result);
                exit;
            } else {
                return $this->view('client.profile', [
                    'result' => $result,
                ]);
            }
        } else {
            header('http://localhost/Medicare/index.php?controller=home&action=login');
            exit();
        }
    }

    public function history()
    {
        session_start();
        if (isset($_SESSION['user_phone'])) {
            $phone = $_SESSION['user_phone'];
            $patient_id = $_SESSION['patient_id'];
            $listAppointments = $this->appointmentModel->getAppointmentsByPatient($phone, $patient_id);
            return $this->view('client.history', [
                'listAppointments' => $listAppointments,
            ]);
        } else {
            header('Location: http://localhost/Medicare/index.php?controller=home&action=not_found');
            exit();
        }
    }

    public function search()
    {
        $phone = $_POST['phone'];
        $listAppointments = $this->appointmentModel->getAppointmentsByPatient($phone);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($listAppointments);
            exit;
        } else {
            return $this->view('client.history', [
                'listAppointments' => $listAppointments,
            ]);
        }

    }

    public function update_status()
    {
        session_start();
        if (isset($_SESSION['admin_name'])) {
            $employee_id = $_SESSION['admin_id'];
            $status = $_POST['status'];
            $patient_id = $_POST['patient_id'];
            $result = $this->patientModel->updateStatus($patient_id, $status, $employee_id );
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($result);
                exit;
            } else {
                return $this->view('404', [
                    'result' => $result,
                ]);
            }
        } else {
            header('Location: http://localhost/Medicare/index.php?controller=home&action=not_found');
            exit();
        }
    }

    public function get_one()
    {
        $patient_id = $_POST['patient_id'];
        $patient = $this->patientModel->findById($patient_id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($patient);
            exit;
        } else {
            return $this->view('404', [
                'patient' => $patient,
            ]);
        }
    }
}
