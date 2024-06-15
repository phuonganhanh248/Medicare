<?php
    class AuthController  extends BaseController{
        private $authModel;

        public function __construct()
        {
            $this->loadModel('AuthModel');
            $this->authModel = new AuthModel();
        }
        public function login() {
            return $this->view('client.login', [
            ]);
        }

        public function register() {
            return include './views/client/register.php';
        }

        public function processRegister() {
            $phone = $_POST['phone'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $result = $this->authModel->registerClient($phone, $password, $name);
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($result);
                exit;
            }
            return $this->view('client.register', [
                'result' => $result,
            ]);
        }

        public function loginAdmin() {
            return $this->view('admin.login');
        }

        public function processLoginAdmin()
        {
            $phone = $_POST['phone'];
            $password = $_POST['password'];
//            $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 12]);
            $result = $this->authModel->loginAdmin($phone, $password);
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($result);
                exit;
            }
            return $this->view('admin.login', [
                'result' => $result,
            ]);
        }

        public function processLoginClient()
        {
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $result = $this->authModel->loginClient($phone, $password);
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode($result);
                exit;
            }
            return $this->view('client.login', [
                'result' => $result,
            ]);
        }

        public function logout()
        {
            $this->authModel->logout();
            return $this->view('admin.login');
        }

    }
