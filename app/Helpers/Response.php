<?php

namespace App\Helpers;

class Response
{
    public $data     = [];
    public $messages = [];
    public $status   = 200;
    public $header   = [];
    public $view     = '';
    public $redirect = null;
}
