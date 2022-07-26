<?php

require_once dirname(dirname(__FILE__)) . "\database\Connect.php";

class UserDB
{
    private ?Connect $connection = null;
    private string $sqlCreateUser = "INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)";
    private string $sqlReadUser = "SELECT * FROM users ORDER BY name ASC";
    private string $sqlUpdateUser = "UPDATE users SET name = ?, phone = ?, email = ?, password = ? WHERE id = ?";
    private string $sqlDeleteUser = "DELETE FROM users WHERE id = ?";
    private string $sqlFindUser = "SELECT * FROM users WHERE id = ?";

    function createUserDb($name, $phone, $email, $password)
    {
        if ($this->connection == null) {
            $this->connection = new Connect();
        }
        $conn = $this->connection->getConnection();

        $name = mysqli_escape_string($conn, $name);
        $phone = mysqli_escape_string($conn, $phone);
        $email = mysqli_escape_string($conn, $email);
        $password = mysqli_escape_string($conn, $password);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_stmt_init($conn);

        try {
            $stmt->prepare($this->sqlCreateUser);
            $stmt->bind_param('ssss', $name, $phone, $email, $password);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function readUserDb()
    {
        if ($this->connection == null) {
            $this->connection = new Connect();
        }
        $conn = $this->connection->getConnection();

        try {
            $result = $conn->query($this->sqlReadUser);
            if ($result->num_rows > 0) {
                return $result->fetchAll();
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function updateUserDb($id, $name, $phone, $email, $password)
    {
        if ($this->connection == null) {
            $this->connection = new Connect();
        }

        $name = mysqli_escape_string($conn, $name);
        $phone = mysqli_escape_string($conn, $phone);
        $email = mysqli_escape_string($conn, $email);
        $password = mysqli_escape_string($conn, $password);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $conn = $this->connection->getConnection();

        $stmt = mysqli_stmt_init($conn);

        try {
            $stmt->prepare($this->sqlUpdateUser);
            $stmt->bind_param("ssssi", $name, $phone, $email, $password, $id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function deleteUserDb($id)
    {
        if ($this->connection == null) {
            $this->connection = new Connect();
        }

        $conn = $this->connection->getConnection();

        $stmt = mysqli_stmt_init($conn);

        try {
            $stmt->prepare($this->sqlDeleteUser);
            $stmt->bind_param("i", $id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function findUserDb($id)
    {
        if ($this->connection == null) {
            $this->connection = new Connect();
        }

        $conn = $this->connection->getConnection();

        $stmt = mysqli_stmt_init($conn);

        try {
            $stmt->prepare($this->sqlFindUser);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = false;
            if ($stmt->num_rows > 0) {
                $result = $stmt->fetch_assoc();
            }
            $stmt->close();
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
