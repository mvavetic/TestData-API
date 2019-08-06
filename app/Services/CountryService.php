<?php

namespace App\Services;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Interfaces\ReturnTypeInterface;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\JsonResponse;
use App\Models\Country;
use Illuminate\Validation\Factory as Validation;

class CountryService extends Controller
{
    /**
     * Model to be used
     *
     * @var Country
     */
    protected $countryModel;

    /**
     * Repository for a model
     *
     * @var BaseRepository
     */
    protected $repository;

    /**
     * Setting the model to a protected variable
     *
     * @param Country $countryModel
     * @param Response $response
     * @param Validation $validation
     */
    public function __construct(Country $countryModel, Response $response, Validation $validation)
    {
        $this->countryModel = $countryModel;

        $this->repository = new BaseRepository($this->countryModel);

        parent::__construct($response, $validation);
    }

    /**
     * Get all countries
     *
     * @param array $data
     * @return ReturnTypeInterface
     */
    public function findAll(array $data) : ReturnTypeInterface
    {
        $countries = $this->repository->findAll();

        if ($data['data_format'] === DataFormat::JSON) {
            $countriesMapper = new CountryResource($countries);
            return new JsonResponse($countriesMapper->collection($countries), HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.country.list', compact('countries'))->header('Content-Type', 'text/xml');
        }
    }
}