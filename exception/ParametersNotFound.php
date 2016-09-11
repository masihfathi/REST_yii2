<?php

namespace app\exception;

use Yii;
use yii\web\HttpException;

class ParametersNotFound extends HttpException
{
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(403, $message, $code, $previous);
    }
}



