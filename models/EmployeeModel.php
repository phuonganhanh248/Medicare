<?php
class EmployeeModel  extends BaseModel {
    const ROLE = 'employee';

    protected $connection = null;

    public function __construct() {
        $this->connection = $this->connect();
    }

    private function _query($sql){
        return mysqli_query($this->connection, $sql);
    }

    public function getById($id): array
    {
        $sql = "SELECT e.employee_id AS id,
                        e.name AS name,
                       e.username AS username,
                       e.avt AS avt,
                       e.gender AS gender,
                       e.dob AS dob,
                       e.email AS email,
                       e.phone AS phone,
                       e.address AS address,
                       e.status AS status,
                       e.specialty_id AS specialty_id,
                       e.employee_code AS employee_code,
                       p.name AS positionName
                FROM employees AS e
                JOIN positions AS p ON e.position_id = p.position_id
                WHERE e.employee_id = $id";

        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }

    public function getEmployeeForAdmin(): array
    {
        $sql = "SELECT
                    e.employee_id AS id,
                    e.avt AS avt,
                    e.name AS name,
                    p.name AS position,
                    e.email AS email,
                    e.phone AS phone,
                    e.address AS address,
                    e.gender AS gender,
                    e.dob AS dob,
                    e.employee_code AS employee_code,
                    e.status AS status
                FROM employees AS e
                         JOIN positions AS p ON e.position_id = p.position_id
                         JOIN roles AS r ON e.role_id = r.role_id
                WHERE r.role_name = LOWER('employee') ORDER BY e.employee_id DESC";

        $query = $this->_query($sql);
        $data = [];
        while ($result = mysqli_fetch_assoc($query)) {
            $data[] = $result;
        }
        return $data;
    }

    public function updateEmployee($employee_id, $name, $dob, $email, $phone, $gender, $address, $status, $avt, $update_by): bool
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $updated_at = date("Y-m-d H:i:s");

        $sql = "UPDATE employees SET
                name = ?,
                phone = ?,
                email = ?,
                dob = ?,
                gender = ?,
                address = ?, 
                status = ?,
                update_at = ?,
                avt = ?,
                update_by = ?
            WHERE employee_id = ?";

        $stmt = mysqli_prepare($this->connection, $sql);
        if ($stmt === false) {
            throw new Exception('MySQL prepare error: ' . mysqli_error($this->connection));
        }

        mysqli_stmt_bind_param($stmt, 'ssssisissii',
            $name, $phone, $email, $dob, $gender,
            $address, $status, $updated_at, $avt, $update_by,$employee_id);

        $result = mysqli_stmt_execute($stmt);
        if ($result === false) {
            throw new Exception('Failed to execute statement: ' . mysqli_stmt_error($stmt));
        }

        mysqli_stmt_close($stmt);
        return $result;
    }

    public function addEmployee($name, $dob, $email, $phone, $gender, $address, $position_id, $status, $avt, $update_by): bool
    {
        $created_at = date("Y-m-d H:i:s");
        $hashedPassword = password_hash('Abc12345', PASSWORD_BCRYPT, ['cost' => 12]);
        $role_id = 1;

        $sql = "INSERT INTO employees (
                   position_id,
                   role_id,
                   name,
                   password,
                   phone,
                   email,
                   dob,
                   gender,
                   address, 
                   status,
                   create_at,
                   avt,
                   update_by)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($this->connection, $sql);
        if ($stmt === false) {
            throw new Exception('MySQL prepare error: ' . mysqli_error($this->connection));
        }

        mysqli_stmt_bind_param($stmt, 'iisssssisissi',
            $position_id, $role_id, $name, $hashedPassword, $phone, $email, $dob, $gender,
            $address, $status, $created_at, $avt, $update_by);
        $result = mysqli_stmt_execute($stmt);
        if ($result === false) {
            throw new Exception('Failed to execute statement: ' . mysqli_stmt_error($stmt));
        }

        // Lấy ID của nhân viên vừa được thêm
        $employee_id = mysqli_insert_id($this->connection);

        // Bước 2: Tạo employee_code và cập nhật
        if ($position_id == 2) {
            $employee_code = 'NUR' . $employee_id;
        } elseif ($position_id == 3) {
            $employee_code = 'REC' . $employee_id;
        } else {
            $employee_code = 'EMP' . $employee_id;
        }

        $sqlUpdate = "UPDATE employees SET employee_code = ? WHERE employee_id = ?";
        $stmtUpdate = mysqli_prepare($this->connection, $sqlUpdate);
        if ($stmtUpdate === false) {
            throw new Exception('MySQL prepare error: ' . mysqli_error($this->connection));
        }

        mysqli_stmt_bind_param($stmtUpdate, 'si', $employee_code, $employee_id);
        $resultUpdate = mysqli_stmt_execute($stmtUpdate);
        if ($resultUpdate === false) {
            throw new Exception('Failed to update employee code: ' . mysqli_stmt_error($stmtUpdate));
        }

        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmtUpdate);

        return $result;
    }
}