<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Factory as Validation;
use Illuminate\Hashing\HashManager as Hash;
use Illuminate\Auth\AuthManager as Auth;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
     * Auth instance.
     * @var $auth
     */
    protected $auth;

    /**
     * Create new controller instance
     *
     * @param  \Illuminate\Validation\Factory  $validation
     * @param \Illuminate\Contracts\Routing\ResponseFactory $response
     * @param \Illuminate\Auth\AuthManager $auth
     * @param Hash $hash
     * @return void
     */
    public function __construct(Response $response, Validation $validation, Hash $hash, Auth $auth)
    {
        $this->responseFactory = $response;
        $this->validation = $validation;
        $this->hash = $hash;
        $this->auth = $auth;
    }
}
