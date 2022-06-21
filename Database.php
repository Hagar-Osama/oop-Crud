<?php
class Database
{

    private $serverName =  'localhost';
    private $userName =  'root';
    private $password =  '';
    private $dbName =  'company';
    private $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect($this->serverName, $this->userName, $this->password, $this->dbName);
        if (!$this->connection) {
            die('Connection to Database Failed' . mysqli_connect_error());
        }
    }

    public function hashPassword($password)
    {
        return sha1($password);
    }

    public function insert($sql)
    {
        if (mysqli_query($this->connection, $sql)) {
            return 'Data Inserted Successfully';
        } else {
            die('Insertion failed' . mysqli_connect_error());
        }
    }

    public function readData($table)
    {
        $data = [];
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            die('Insertion failed' . mysqli_connect_error());
        }
    }

    public function findRecord($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE `id` = '$id'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result)) {

            return mysqli_fetch_assoc($result);
        } else {
            die('Error' . mysqli_connect_error());
        }
    }

    public function update($sql)
    {
        if (mysqli_query($this->connection, $sql)) {
            return 'Data Inserted Successfully';
        } else {
            die('Update failed' . mysqli_connect_error());
        }
    }

    public function Delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE `id` = '$id'";
        if (mysqli_query($this->connection, $sql)) {
            return 'Data Deleted Successfully';
        } else {
            die('Delete failed' . mysqli_connect_error());
        }
    }
}
