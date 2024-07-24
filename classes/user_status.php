<?php
class UserStatus
{
    private $id;
    private $driverId;
    private $accessLevel;
    private $employeeNumber;
    private $lname;
    private $fname;
    private $email;
    private $pass;
    private $resetCode;
    private $resetAt;
    private $createAt;
    private $updateAt;

    public function __construct($id, $driverId, $accessLevel, $employeeNumber, $lname, $fname, $email, $pass, $resetCode, $resetAt, $createAt, $updateAt)
    {
        $this->id = $id;
        $this->driverId = $driverId;
        $this->employeeNumber = $employeeNumber;
        $this->lname = $lname;
        $this->fname = $fname;
        $this->email = $email;
        $this->accessLevel = $accessLevel;
        $this->createAt = $createAt;
        $this->resetAt = $resetAt;
        $this->pass = $pass;
        $this->resetCode = $resetCode;
        $this->updateAt = $updateAt;
    }

    //getメソッド
    public function getId()
    {
        return $this->id;
    }
    public function getDriverId()
    {
        return $this->driverId;
    }
    public function getEmployeeNumber()
    {
        return $this->employeeNumber;
    }
    public function getLname()
    {
        return $this->lname;
    }
    public function getFname()
    {
        return $this->fname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getAccessLevel()
    {
        return $this->accessLevel;
    }
    public function getCreateAt()
    {
        return $this->createAt;
    }
    public function getResetAt()
    {
        return $this->resetAt;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getResetCode()
    {
        return $this->resetCode;
    }
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    //ステータスの参照だけなので、setメソッドは不要
}
