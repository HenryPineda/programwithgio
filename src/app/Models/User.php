<?php

namespace App\Models;
use PDO;

class User extends Model
{
    public function create(string $email,string $full_name,bool $is_active,string $createdAt):int
    {
        $queryForNewUser = 'INSERT INTO users (email, full_name, is_active, created_at) values(:name, :email, :active, :date)';
        $newUserStm = $this->db->prepare($queryForNewUser);
        $newUserStm->bindValue(':email', $email);
        $newUserStm->bindValue(':name', $full_name);
        $newUserStm->bindValue(':active', $is_active, PDO::PARAM_BOOL);
        $newUserStm->bindValue(':date', $createdAt);
        //['email' =>$email, 'name'=> $full_name, 'active'=> $is_active, 'date'=> $createdAt]
        $newUserStm->execute();
        return (int)$this->db->lastInsertId();

    }

    public function all()
    {
        $query = "SELECT * FROM users";
        $stm = $this->db->prepare($query);
        $stm->execute();
        return $stm->fetchAll();
    }

}