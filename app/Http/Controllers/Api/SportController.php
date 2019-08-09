<?php

namespace App\Http\Controllers\Api;

use App\Enums\DataFormat;
use App\Enums\HttpStatusCode;
use App\Exceptions\NotFoundException;
use App\Exceptions\SystemException;
use App\Http\Controllers\Controller;
use App\Http\Resources\SportResource;
use App\Interfaces\ReturnTypeInterface;
use App\Services\SportService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SportsListRequest;

class SportController extends Controller
{
    /**
     * Get all sports
     *
     * @param SportsListRequest $request
     * @param SportService $sportService
     * @return ReturnTypeInterface
     * @throws SystemException|NotFoundException
     */
    public function index(SportsListRequest $request, SportService $sportService) : ReturnTypeInterface
    {
        $data = $request->validateData();

        $sports = $sportService->findAll();

        if ($data['data_format'] === DataFormat::JSON) {
            $sportsMapper = new SportResource($sports);

            return new JsonResponse($sportsMapper->collection($sports), HttpStatusCode::HTTP_OK);
        } elseif ($data['data_format'] === DataFormat::XML) {
            return $this->responseFactory->view('XML.sport.list', compact('sports'))->header('Content-Type', 'text/xml');
        }
    }
}
