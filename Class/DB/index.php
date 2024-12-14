<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "Filmfinder";
    private $instance = null;
    private $column = "*";
    private $order = "";
    private $count = 0;
    private $conn;

    private function __construct()
    {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function select($column = "*")
    {
        $this->column = $column;
        return $this;
    }

    public function order($column, $order = "ASC")
    {
        $this->order = "ORDER BY $column $order";
        return $this;
    }

    public function get($table)
    {
        $sql = "SELECT $this->column FROM $table $this->order";
        $result = $this->conn->query($sql);
        $this->count = $result->num_rows;

        if ($this->count > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function getWhere($table, $column, $value)
    {
        $sql = "SELECT $this->column FROM $table WHERE $column = '$value' $this->order";
        $result = $this->conn->query($sql);
        $this->count = $result->num_rows;

        if ($this->count > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function getLike($table, $column, $value)
    {
        $sql = "SELECT $this->column FROM $table WHERE $column LIKE '%$value%' $this->order";
        $result = $this->conn->query($sql);
        $this->count = $result->num_rows;

        if ($this->count > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function check($table, $column, $value)
    {
        $sql = "SELECT $this->column FROM $table WHERE $column = '$value'";
        $result = $this->conn->query($sql);
        $this->count = $result->num_rows;

        if ($this->count > 0) {
            return true;
        }

        return false;
    }

    public function count()
    {
        return $this->count;
    }

    public function insert($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_values($data));

        $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
        $result = $this->conn->query($sql);

        if ($result) {
            return true;
        }

        return false;
    }

    public function update($table, $data, $where)
    {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = '$value', ";
        }
        $set = rtrim($set, ", ");

        $sql = "UPDATE $table SET $set WHERE $where";
        $result = $this->conn->query($sql);

        if ($result) {
            return true;
        }

        return false;
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        $result = $this->conn->query($sql);

        if ($result) {
            return true;
        }

        return false;
    }

    public function search($table, $column, $keyword)

    {

        // Code to search for records in a table

        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $column LIKE ?");

        $stmt->bind_param("s", $keyword);

        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

