<?php
class User
{
    private $id;
    private $employeeNumber;
    private $lname;
    private $fname;
    private $email;
    private $pass;

    public function __construct($id = null, $employeeNumber, $lname, $fname, $email, $pass)
    {
        $this->id = $id;
        $this->employeeNumber = $employeeNumber;
        $this->lname = $lname;
        $this->fname = $fname;
        $this->email = $email;
        $this->pass = $pass;
    }

    //getメソッド
    public function getId()
    {
        return $this->id;
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
    public function getPass()
    {
        return $this->pass;
    }

    //setメソッド
    public function setEmployeeNumber($employeeNumber)
    {
        $this->employeeNumber = $employeeNumber;
    }
    public function setLname($lname)
    {
        $this->lname = $lname;
    }
    public function setFname($fname)
    {
        $this->fname = $fname;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
}
