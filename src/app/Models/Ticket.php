<?php

namespace App\Models;

class Ticket extends Model
{
    public function all(): \Generator
    {
        $stm = $this->db->query(
            'SELECT * FROM tickets'
        );
        return $this->fetchLazy($stm);
    }

}