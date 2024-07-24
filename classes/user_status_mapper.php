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
            $users[] = new UserStatus(
                $row['d_id'],
                $row['driver_id'],
                $row['access_authority'],
                $row['employee_number'],
                $row['l_name'],
                $row['f_name'],
                $row['email'],
                $row['pass'],
                $row['reset_code'],
                $row['reset_at'],
                $row['create_at'],
                $row['update_at']
            );
        }
        return $users;
    }
}
