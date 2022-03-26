<?php

class QueryBuilder 
{

    protected $pdo;

    public function __construct($pdo) 
    {
        $this->pdo = $pdo;
    }

    /*
        Parameters: 
            string - $table (Table in Database)
        Description: get all record from table
        Return value: array
    */

    public function getAll($table) {

        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    /*
        Parameters: 
            string - $table (Table in Database)
            string - $id (id column in table)
        Description: get one column from table
        Return value: array
    */

    public function getOne($table, $id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
        $statement->execute(["id" => $id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }

    /*
        Parameters: 
            string - $table (Table in Database)
            array - $data (Data to be added to the table)
        Description: insert data in table
    */

    public function create($table, $data) 
    {
        $keys = array_keys($data);
        $stringOfKeys = implode(',', $keys);
        $placeholders = ':' . implode(',:', $keys);

        $sql = "INSERT INTO $table ($stringOfKeys) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    /*
        Parameters: 
            string - $table (Table in Database)
            array - $data (Data to be update in table)
        Description: update data in table
    */

    public function update($table, $data) 
    {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= $key . '=:' . $key . ',';
        }
        $fields = rtrim($fields, ',');

        $sql = "UPDATE $table SET $fields WHERE id=:id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);

    }

    /*
        Parameters: 
            string - $table (Table in Database)
            string - $id (id column in table)
        Description: delete column in table
    */

    public function delete($table, $id) 
    {
        $sql = "DELETE FROM $table WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(["id" => $id]);
    }

}