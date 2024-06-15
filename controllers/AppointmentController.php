<?php
require_once 'BaseController.php';
class AppointmentController extends BaseController
{
    private $timeSlotModel;
    private $appointmentModel;
    private $doctorModel;
    private $specialtyModel;

    public function __construct()
    {
        $this->loadModel('TimeSlotModel');
        $this->timeSlotModel = new TimeSlotModel();

        $this->loadModel('AppointmentModel');
        $this->appointmentModel = new AppointmentModel();

        $this->loadModel('DoctorModel');
        $this->doctorModel = new DoctorModel();

        $this->loadModel('SpecialtyModel');
        $this->specialtyModel = new SpecialtyModel();
    }

    public function getByDateAndDoctor()
    {
        $date_slot = isset($_GET['dateSlot']) ? $_GET['dateSlot'] : null;
        $doctorId = isset($_GET['doctorId']) ? $_GET['doctorId'] : null;
        $listTimeSlot = $this->timeSlotModel->getByDateAndDoctor($date_slot, $doctorId);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($listTimeSlot);
            exit;
        } else {
            return $this->view('test', [
                'listTimeSlot' => $listTimeSlot
            ]);
        }
    }

    /**
     * @throws Exception
     */
    public function create(){
        session_start();
        $patient_id = $_SESSION['patient_id'] ?? null;
        $specialId = intval($_POST['specialId']);
        $doctorId = intval($_POST['doctorId']);
        $dateSlot = intval($_POST['dateSlot']);
        $timeSlotId = intval($_POST['timeSlotId']);
        $patientName = $_POST['patientName'];
        $patientGender = intval($_POST['patientGender']);
        $patientDob = $_POST['patientDob'];
        $patientPhone = $_POST['patientPhone'];
        $patientEmail = $_POST['patientEmail'];
        $patientDescription = $_POST['patientDescription'];
        $appointment = $this->appointmentModel->createAppointment(
            $specialId, $doctorId, $dateSlot, $timeSlotId,
            $patientName, $patientGender, $patientDob, $patientPhone, $patientEmail, $patientDescription,$patient_id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($appointment);
            exit;
        } else {
            return $this->view('test', [
                'message' => $appointment
            ]);
        }
    }

    public function update_show()
    {
        $listSpecialties = $this->specialtyModel->getSpecialtiesForAdmin();
        $listDoctors = $this->doctorModel->getDoctorForAdmin();
        return $this->view('admin.appointment-update', [
            'listSpecialties' => $listSpecialties,
            'listDoctors' => $listDoctors
        ]);
    }

    public function update()
    {
        session_start();
        if (isset($_SESSION['admin_name'])) {
            $update_by = $_SESSION['admin_id'];

            $id = $_POST['id'];
            $employee_id = $_POST['employee_id'];
            $specialty_id = $_POST['specialty_id'];
            $date_slot = $_POST['date_slot'];
            $time_id = $_POST['time_id'];
            $patient_name = $_POST['patient_name'];
            $patient_gender = $_POST['patient_gender'];
            $patient_email = $_POST['patient_email'];
            $patient_description = $_POST['patient_description'];
            $status = $_POST['status'];

            $update = $this->appointmentModel->updateAppointment($id, $employee_id, $specialty_id, $date_slot, $time_id,
                $patient_name, $patient_gender, $patient_email, $patient_description, $status, $update_by);
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($update);
                exit;
            } else {
                return $this->view('test', [
                    'message' => $update
                ]);
            }
        } else {
            header('Location: http://localhost/Medicare/index.php?controller=home&action=not_found');
            exit();
        }
    }

    public function index(){
        $page = $_GET['page'] ?? 1;

        $listSpecialties = $this->specialtyModel->getSpecialtiesForAdmin();
        $listDoctors = $this->doctorModel->getDoctorForAdmin();

        $totalAppointment = $this->appointmentModel->getTotalAppointments();
        $listAppointments = $this->appointmentModel->getAllAppointmentsForAdmin(10, $page);

        $specialty= $_GET['specialty'] ?? null;
        $doctor = $_GET['doctor'] ?? null;
        $search = $_GET['search'] ?? null;
        $statusAppointment = $_GET['statusAppointment'] ?? null;

        if($specialty || $doctor || $search || (isset($statusAppointment) && $statusAppointment !== '')) {
            $listAppointments = $this->appointmentModel->getAllAppointmentsForAdmin(10, $page, $specialty, $doctor, $statusAppointment, $search);
            $totalAppointment = $this->appointmentModel->getTotalAppointmentsWithParam($specialty, $doctor, $statusAppointment,$search);
        }

        return $this->view('admin.appointments', [
            'listAppointments' => $listAppointments,
            'listSpecialties' => $listSpecialties,
            'listDoctors' => $listDoctors,
            'totalAppointment' => $totalAppointment,
            'specialtySelected' => $specialty,
            'doctorSelected' => $doctor,
            'statusAppointment' => $statusAppointment,
            'search' => $search,
//            co the bo cac bien, vi lay $_GET
        ]);
    }

    public function today(){
        $page = $_GET['page'] ?? 1;

        $listSpecialties = $this->specialtyModel->getSpecialtiesForAdmin();
        $listDoctors = $this->doctorModel->getDoctorForAdmin();



        $specialty= $_GET['specialty'] ?? null;
        $doctor = $_GET['doctor'] ?? null;
        $date = $_GET['date'] ?? null;
        $search = $_GET['search'] ?? null;


        $listAppointments = $this->appointmentModel->getAppointmentToday(10, $page, $specialty, $doctor,$date, $search);
        $totalAppointment = $this->appointmentModel->getTotalAppointmentsToday($specialty, $doctor, $date ,$search);

        return $this->view('admin.appointment-today', [
            'listAppointments' => $listAppointments,
            'listSpecialties' => $listSpecialties,
            'listDoctors' => $listDoctors,
            'totalAppointment' => $totalAppointment,
            'specialtySelected' => $specialty,
            'doctorSelected' => $doctor,
            'search' => $search,
//            co the bo cac bien, vi lay $_GET
        ]);
    }

    public function confirm(){
        $page = $_GET['page'] ?? 1;

        $listSpecialties = $this->specialtyModel->getSpecialtiesForAdmin();
        $listDoctors = $this->doctorModel->getDoctorForAdmin();

        $specialty= $_GET['specialty'] ?? null;
        $doctor = $_GET['doctor'] ?? null;
        $search = $_GET['search'] ?? null;

        $listAppointments = $this->appointmentModel->getAppointmentConfirm(10, $page, $specialty, $doctor, $search);
        $totalAppointment = $this->appointmentModel->getTotalAppointmentsConfirm($specialty, $doctor, $search);

        return $this->view('admin.appointment-confirm', [
            'listAppointments' => $listAppointments,
            'listSpecialties' => $listSpecialties,
            'listDoctors' => $listDoctors,
            'totalAppointment' => $totalAppointment,
            'specialtySelected' => $specialty,
            'doctorSelected' => $doctor,
            'search' => $search,
//            co the bo cac bien, vi lay $_GET
        ]);
    }

    public function get_one(){
        $appointmentId = $_GET['appointmentId'] ?? null;

        $appointment = $this->appointmentModel->getAppointmentById($appointmentId);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($appointment);
            exit;
        }
        return $this->view('admin.appointment-confirm', [
            'appointment' => $appointment,
        ]);
    }

    public function update_result()
    {
        $id = $_POST['appointment_id'];

        if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] == 0) {
            $result = $this->uploadToCloudinary($this->escapeBackslashes($_FILES['pdfFile']['tmp_name']));
        }

        $update = $this->appointmentModel->updateResultAppointment($id, $result);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($update);
            exit;
        } else {
            return $this->view('test', [
                'message' => $update
            ]);
        }

    }

    public function detail(): void
    {
        $appointment_id = $_GET['id'];
        $appointment = $this->appointmentModel->getAppointmentById($appointment_id);
        $this->view('admin.appointment-detail', [
            'appointment' => $appointment,
        ]);
    }

    public function detail_client(): void
    {
        $appointment_id = $_GET['id'];
        $appointment = $this->appointmentModel->getAppointmentById($appointment_id);
        $this->view('client.appointment-detail', [
            'appointment' => $appointment,
        ]);
    }

    public function uploadToCloudinary($filePath): string
    {
        try {
            $cloudinary = $GLOBALS['cloudinary'];

            $options = [
                'resource_type' => 'auto',
                'type' => 'upload',
                'access_mode' => 'public'
            ];

            $result = $cloudinary->uploadApi()->upload($filePath, $options);

            return $result['secure_url'];
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    private function escapeBackslashes($string): array|string
    {
        return str_replace("\\", "\\\\", $string);
    }
}