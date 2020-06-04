<?php

namespace App\Exceptions;

use Exception;
use App\Libs\LogCustom;

class PurchaseException extends Exception
{
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    private $log_name = 'PurchaseController';
    private $log_path = '/logs/purchase.log';

    public function report()
    {
        $LogCustom = new LogCustom($this->log_name);
        $LogCustom->daily($this->log_path, $this->message);
    }

    public function render()
    {
        return response()->view('errors.500');
    }
}
