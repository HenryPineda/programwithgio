<?php

namespace App\Models;
use App\Models\Model;
use App\Models\User;
use App\Models\Invoice;

class SignUp extends Model
{
    public function __construct(protected User $userModel,protected Invoice $invoiceModel)
    {
        parent::__construct();
    }

    public function register(array $userInfo, array $invoiceInfo):int
    {
        try {
            $this->db->beginTransaction();

            $userId = $this->userModel->create($userInfo['email'],$userInfo['full_name'], $userInfo['is_active'], $userInfo['created_at']);
            $invoiceId = $this->invoiceModel->create($invoiceInfo['amount'], $userId);
            $user = $this->db->query('SELECT * FROM users where id='.$userId)->fetch();

            $this->db->commit();

            echo "<pre>";
            print_r($user);
            echo "</pre >";

            return $invoiceId;

        }catch (\Throwable $e){

            var_dump($e->getMessage());
            if($this->db->inTransaction()){
                $this->db->rollBack();
            }
        }

    }

}