<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Factory as Validation;
use Illuminate\Hashing\HashManager as Hash;

class Controller extends BaseController
{
    /**
     * Validation instance.
     *
     * @var $validation
     */
    protected $validation;

    /**
     * Hashing instance.
     *
     * @var $hash
     */
    protected $hash;

    /**
     * Create new controller instance
     *
     * @param  \Illuminate\Validation\Factory  $validation
     * @param \Illuminate\Hashing\HashManager $hash
     * @return void
     */
    public function __construct(Validation $validation, Hash $hash)
    {
        $this->validation = $validation;
        $this->hash = $hash;
    }
}
