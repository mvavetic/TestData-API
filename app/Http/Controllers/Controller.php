<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Factory as Validation;
use Illuminate\Hashing\HashManager as Hash;
use Illuminate\Routing\ResponseFactory;

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
     * Hashing instance.
     *
     * @var $hash
     */
    protected $hash;

    /**
     * Response instance.
     *
     * @var $response
     */
    protected $response;

    public function __construct(ResponseFactory $response, Validation $validation, Hash $hash)
    {
        $this->response = $response;
        $this->validation = $validation;
        $this->hash = $hash;
    }
}
