<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case PAID = 'paid';
    case PENDING = 'pending';
    case VOID = 'void';
    case FAILED = 'failed';

//    public const PENDING = 0;
//    public const PAID = 1;
//    public const VOID = 2;
//    public const FAILED = 3;
//
//    public static function all(): array
//    {
//        return [
//            self::PAID,
//            self::FAILED,
//            self::PENDING,
//            self::VOID
//        ];
//    }

    public function toString():string
    {
        return match($this){
            self::PAID => 'Paid',
            self::PENDING => 'Pending',
            self::VOID => 'Void',
            self::FAILED => 'Failed'
        };
    }

    public function color():Color
    {
        return match($this){
            self::PAID => Color::GREEN,
            self::PENDING => Color::ORANGE,
            self::VOID => Color::GRAY,
            self::FAILED => Color::RED
        };
    }

}