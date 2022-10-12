<?php

namespace App;
use PDO;

class QueryBuilder
{
    public \PDOStatement $statement;
    public string $query = "";
    public string $table = "";
    public string $column = "";
    public int $value;
    public function __construct(protected PDO $pdo)
    {
    }

    public function selectAll(string $table)
    {
        $this->table = $table;
        $this->query ="SELECT * FROM {$table}";
        $this->statement = $this->pdo->prepare($this->query);
        return $this;
    }

    public function where($column, $value){
        $this->column = $column;
        $this->value = $value;
        //$this->query = "SELECT * FROM {$this->table} WHERE {$column}= :value";
        $this->query = "SELECT * FROM {$this->table} WHERE {$column}= '$value'";
        $this->statement = $this->pdo->prepare($this->query);
        return $this;
    }

    public function get()
    {
        //$this->statement->bindValue('value', $this->value);
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_CLASS);
    }
}