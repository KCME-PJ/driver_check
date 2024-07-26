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
}
