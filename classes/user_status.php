<?php
class UserStatus
{
    private $d_id;
    private $driver_id = null;
    private $access_authority;
    private $employee_number;
    private $l_name;
    private $f_name;
    private $email;
    private $pass;
    private $reset_code;
    private $reset_at;
    private $create_at;
    private $update_at;

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    //getメソッド
    public function getId()
    {
        return $this->d_id;
    }
    public function getDriverId()
    {
        return $this->driver_id;
    }
    public function getEmployeeNumber()
    {
        return $this->employee_number;
    }
    public function getLname()
    {
        return $this->l_name;
    }
    public function getFname()
    {
        return $this->f_name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getAccessLevel()
    {
        return $this->access_authority;
    }
    public function getCreateAt()
    {
        return $this->create_at;
    }
    public function getResetAt()
    {
        return $this->reset_at;
    }
    public function getPass()
    {
        return $this->pass;
    }
    public function getResetCode()
    {
        return $this->reset_code;
    }
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    //ステータスの参照だけなので、setメソッドは不要
}
