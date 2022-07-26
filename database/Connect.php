<?php

class Connect
{
    public $connection = null;

    function createConnection()
    {
        try {
            $this->connection = mysqli_connect("localhost", "root", "", "crud_php");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    function getConnection()
    {
        if($this->connection == null)
        {
            $this->createConnection();
        }
        return $this->connection;
    }
    
}