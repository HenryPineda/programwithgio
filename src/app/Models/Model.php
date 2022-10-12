<?php

namespace App\Models;
use App\App;
use \PDO;
use App\DB;

abstract class Model
{
    protected ?DB $db = null;
    public function __construct()
    {
        $this->db = App::db();

    }

    public function fetchLazy(\PDOStatement $stm): \Generator
    {
        foreach ($stm as $record)
        {
            yield $record;
        }
    }

}