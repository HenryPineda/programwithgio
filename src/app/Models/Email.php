<?php

namespace App\Models;

use Symfony\Component\Mime\Address;
use App\Enums\EmailStatus;
use PDO;

class Email extends Model
{
    public function queue(
        Address $to,
        Address $from,
        string $subject,
        string $html,
        ?string $text = null
    )
    {
        $stm = $this->db->prepare(
            'INSERT INTO emails (subject, status, text_body, html_body, meta, created_at)
                    VALUE(?, ?, ?, ?, ?, NOW())'
        );

        $meta['to'] = $to->toString();
        $meta['from'] = $from->toString();

        $stm->execute([$subject, EmailStatus::Queue->value, $text, $html, json_encode($meta)]);
    }

    public function getEmailByStatus(EmailStatus $status): array
    {
        $stm = $this->db->prepare(
            'SELECT * 
                    FROM emails 
                    WHERE status = ?'
        );

        $stm->execute([$status->value]);

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function markEmailSent(EmailStatus $status, int $id):void
    {
        $stm =$this->db->prepare(
            'UPDATE emails
                    SET status = ?, sent_at = NOW()
                    WHERE id = ?'
        );

        $stm->execute([$status->value, $id]);
    }

}