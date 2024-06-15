<?php
class SpecialtyController extends BaseController
{
    private $specialtyModel;

    public function __construct()
    {
        $this->loadModel('SpecialtyModel');
        $this->specialtyModel = new SpecialtyModel();
    }

    public function index()
    {
        $listSpecialties = $this->specialtyModel->getSpecialtiesForAdmin();
        return $this->view('admin.specialties', [
            'listSpecialties' => $listSpecialties,
        ]);
    }

    public function add()
    {
        session_start();
        if (isset($_SESSION['admin_name'])) {
            $specialtyName = $_GET['specialtyName'];
            $specialtyDescription = $_GET['specialtyDescription'];
            $specialtyStatus = $_GET['specialtyStatus'];

            $employee_id = $_SESSION['admin_id'];

            $specialty = $this->specialtyModel->addSpecialty($specialtyName, $specialtyDescription, $specialtyStatus, $employee_id);
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($specialty);
                exit;
            }
            return $this->view('admin.specialties', [
                'specialty' => $specialty,
            ]);
        } else {
            header('Location: http://localhost/Medicare/index.php?controller=home&action=not_found');
            exit();
        }
    }

    public function get_one()
    {
        $specialty_id = $_GET['specialtyId'] ?? '';
        $specialty = $this->specialtyModel->getById($specialty_id);
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode($specialty);
            exit;
        }
        return $this->view('admin.specialty-detail', [
            'specialty' => $specialty,
        ]);
    }

    public function update()
    {
        session_start();
        if (isset($_SESSION['admin_name'])) {
            $specialty_id = $_POST['specialtyId'];
            $specialtyName = $_POST['specialtyName'];
            $specialtyDescription = $_POST['specialtyDescription'];
            $specialtyStatus = $_POST['specialtyStatus'];

            $employee_id = $_SESSION['admin_id'];

            $specialty = $this->specialtyModel->updateSpecialtyById($specialty_id, $specialtyName, $specialtyDescription, $specialtyStatus, $employee_id);
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($specialty);
                exit;
            }
            return $this->view('admin.specialty-detail', [
                'specialty' => $specialty,
            ]);
        } else {
            header('Location: http://localhost/Medicare/index.php?controller=home&action=not_found');
            exit();
        }
    }
}
