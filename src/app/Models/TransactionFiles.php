<?php

namespace App\Models;
use App\Exceptions\FileDoesNotExistException;

class TransactionFiles
{
    public static function getCSVTransactionFiles(): array
    {
        $files = [];
        foreach (scandir(STORAGE_PATH) as $file){

            if(is_dir($file)){
                continue;
            }
            $path_parts = pathinfo(STORAGE_PATH.$file);

            if($path_parts['extension'] === "csv"){
                $files[] = STORAGE_PATH. '/'. $file;
            }
        }
        return $files;
    }

    public static function getTransactions(string $file, ?string $transactionHandler = null): array
    {
        $transactions = [];

        if(!file_exists($file)){
            throw new FileDoesNotExistException();
        }

        $fileResource = fopen($file, 'r');

        fgetcsv($fileResource);

        while(($transaction = fgetcsv($fileResource)) !== false)
        {
            if($transactionHandler !== null){
                $transactions[] = static::$transactionHandler($transaction);
            }else{
                $transactions[] = static::parseTransaction($transaction);
            }
        }

        return $transactions;
    }

    private static function parseTransaction(array $transaction):array
    {
        [$date, $checkNumber, $description, $amount] = $transaction;

        $amount = (float) str_replace(['$', ','], '', $amount);
        return [
            'date' => $date,
            'checkNumber' => $checkNumber,
            'description' => $description,
            'amount' => $amount
        ];
    }
}