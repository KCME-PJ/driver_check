<?php
class UserStatusMapper
{
    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function userList()
    {
        $sql_userList = <<<SQL
        SELECT * FROM drivers
        SQL;
        $stmt = $this->pdo->query($sql_userList);
        $users = [];
        foreach ($stmt as $row) {
            $users[] = new UserStatus($row);
        }
        return $users;
    }
    public function findById($d_id)
    {
        $sql_findUser = <<<SQL
        SELECT * FROM drivers WHERE d_id = :d_id
        SQL;
        $stmt = $this->pdo->prepare($sql_findUser);
        $stmt->execute(['d_id' => $d_id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return new UserStatus($data);
    }
    public function driverUpdate(UserStatus $userStatus) //driver情報アップデート処理
    {
        $d_id = $userStatus->getId();                   //UserStatus classのgetterから値を取得
        $driver_id = $userStatus->getDriverId();
        $auth = $userStatus->getAccessLevel();
        $employee = $userStatus->getEmployeeNumber();
        $f_name = $userStatus->getFname();
        $l_name = $userStatus->getLname();
        $email = $userStatus->getEmail();
        $sql_update = <<<SQL
        UPDATE drivers SET driver_id = :driver_id, access_authority = :auth, employee_number = :employee, f_name = :f_name, l_name = :l_name, email = :email
        WHERE d_id = :d_id
        SQL;
        $stmt = $this->pdo->prepare($sql_update);
        $stmt->bindParam(':driver_id', $driver_id);
        $stmt->bindParam(':auth', $auth);
        $stmt->bindParam(':employee', $employee);
        $stmt->bindParam(':f_name', $f_name);
        $stmt->bindParam(':l_name', $l_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':d_id', $d_id);
        return $stmt->execute();
    }
}
