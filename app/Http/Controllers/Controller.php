<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Factory as Validation;
use Illuminate\Hashing\HashManager as Hash;
use Illuminate\Contracts\Routing\ResponseFactory as Response;

class Controller extends BaseController
{
    /**
     * Validation instance.
     *
     * @var $validation
     */
    protected $validation;

    /**
     * ResponseFactory instance.
     *
     * @var $responseFactory
     */
    protected $responseFactory;

    /**
     * Hash instance.
     *
     * @var $hash
     */
    protected $hash;

    /**
     * Create new controller instance
     *
     * @param  \Illuminate\Validation\Factory  $validation
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     * @param Hash $hash
     * @return void
     */
    public function __construct(Response $response, Validation $validation, Hash $hash)
    {
        $this->responseFactory = $response;
        $this->validation = $validation;
        $this->hash = $hash;
    }
}
