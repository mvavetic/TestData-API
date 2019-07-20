<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Factory as Validation;
use Illuminate\Hashing\HashManager as Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $validation;

    protected $hash;

    public function __construct(Validation $validation, Hash $hash)
    {
        $this->validation = $validation;
        $this->hash = $hash;
    }
}
