<?php
class UserMapper
{
    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function insert(User $user)
    {
        $employeeNumber = $user->getEmployeeNumber();
        $sql_duplicate = <<<SQL
        SELECT COUNT(*) FROM drivers WHERE employee_number = :employeeNumber
        SQL;
        $stmt = $this->pdo->prepare($sql_duplicate);
        $stmt->bindParam(':employeeNumber', $employeeNumber);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("登録済のドライバーです。");
        }
        $email = $user->getEmail();
        $sql_mail_duplicate = <<<SQL
        SELECT COUNT(*) FROM drivers WHERE email = :email
        SQL;
        $stmt = $this->pdo->prepare($sql_mail_duplicate);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("メールアドレスが重複しています。");
        }
        $lname = $user->getLname();
        $fname = $user->getFname();
        $pass = password_hash($user->getPass(), PASSWORD_DEFAULT);
        $sql_insert = <<<SQL
        INSERT INTO drivers (employee_number, l_name, f_name, email, pass)
        VALUES(:employeeNumber, :lname, :fname, :email, :pass)
        SQL;
        $stmt = $this->pdo->prepare($sql_insert);
        $stmt->bindParam(':employeeNumber', $employeeNumber);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        return $stmt->execute();
    }
}
