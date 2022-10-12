<?php

namespace App\Models;
use App\Customer;
use App\Enums\InvoiceStatus;
use App\Mail;
use App\Mailable;
use App\DB;
use PDO;

class Invoice extends Model implements Mailable
{
    use Mail;

    //private float $amount;
    private array $data = [];

//    /**
//     * @param float $amount
//     * @param string $description
//     * @param string $creditCardInfo
//     * @param string|null $id
//     * @return void
//     */
//    public function __construct(
//        public float $amount,
//        private string $description,
//        private string $creditCardInfo,
//        private Customer $customer,
//        public ?string $id = null)
//    {
//        $this->id = uniqid();
//    }

    /**
     * @param float $amount
     * @param string $description
     * @param string $creditCardInfo
     * @param string|null $id
     * @return void
     */
    public function __construct(
        public ?float $amount = null,
        public ?string $id = null)
    {
        parent::__construct();
        $this->id = uniqid();
    }

    public function create(float $amount, int $user_id):int
    {
        $queryForNewInvoice = 'INSERT INTO invoices (amount, user_id) values (:amount, :user_id)';
        $newInvoiceStm = $this->db->prepare($queryForNewInvoice);
        $newInvoiceStm->bindValue(':amount', $amount);
        $newInvoiceStm->bindValue(':user_id', $user_id);
        $newInvoiceStm->execute();

        return (int)$this->db->lastInsertId();
    }

    public function find(int $invoiceId)
    {
        $fetchStmt = $this->db->prepare(
            'SELECT invoices.id as invoice_id, amount, user_id, full_name FROM invoices
                    INNER JOIN users ON user_id= users.id
                    WHERE invoices.id = :id'
        );


//        $fetchStmt->bindValue(':email', '%'. $email.'%');
        $fetchStmt->bindValue(':id', $invoiceId);
        $fetchStmt->execute();
        return $fetchStmt->fetch();
    }


    /**
     * It process the invoice and then sends an email
     *
     * @param float $amount
     * @param string $description
     * @return void
     */
    private function process(float $amount, string $description)
    {
        if($amount <= 0){
            throw new \InvalidArgumentException('Invalid amount provided!');
        }

        if(empty($this->customer->getBillingInfo())){
            throw new MissingBillingInfo();
        }
        var_dump('from private method', $amount, $description);
        $this->sendEmail();
    }

    private static function cancel(float $amount, string $reason)
    {
        var_dump('from static method cancel', $amount, $reason);
    }

    public function __call(string $name, array $arguments)
    {
//        if (method_exists($this, $name)) {
//            $this->$name(...$arguments);
//        }
        if (method_exists($this, $name)) {
            call_user_func_array([$this, $name], $arguments);
        }
    }

    public static function __callStatic(string $name, array $arguments)
    {
        if (method_exists(self::class, $name)) {
            self::$name(...$arguments);
        }
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __set(string $name, $value): void
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
        else {
            if (!array_key_exists($name, $this->data)) {
                $this->data[$name] = $value;
            }
        }
    }

    public function __isset(string $name): bool
    {
        var_dump('isset');
        return array_key_exists($name, $this->data);
    }

    public function __unset(string $name): void
    {
        var_dump('unset');
        unset($this->data[$name]);
    }

    public function __toString(): string
    {
        return "This is the string representation of the Invoice class";
    }

    public function __invoke(float $amount, string $description)
    {
        var_dump($amount, $description);
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'description' => $this->description,
            'creditCardInfo' => $this->creditCardInfo
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id = $data['id'];
        $this->amount = $data['amount'];
        $this->description = $data['description'];
        $this->creditCardInfo = $data['creditCardInfo'];
        var_dump($data);
    }

    public function all(InvoiceStatus $status): array
    {
        var_dump('Inside all method', $status->value);
        $stm = $this->db->prepare(
            'SELECT id, amount,status FROM invoices WHERE status = ?'
        );

        $stm->execute([$status->value]);
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
}