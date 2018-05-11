<?php

namespace Bitnetic\JsonApi\Controllers;

use App\Http\Controllers\Controller;
use Bitnetic\JsonApi\Resource\ExampleResource;

/**
 * Class ExampleController
 * @package Bitnetic\JsonApi\Controllers
 */
class ExampleController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/api/example",
     *   summary="Returns a list of JSON-API example resources",
     *   tags={"example"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @SWG\Schema(
     *       allOf={@SWG\Schema(ref="#/definitions/JsonApiResource")},
     *       @SWG\Property(
     *         property="data",
     *         type="array",
     *         @SWG\Items(
     *           ref="#/definitions/ExampleResource"
     *         )
     *       )
     *     )
     *   )
     * )
     *
     * @return \Bitnetic\JsonApi\Resource\JsonApiResourceCollection
     */
    public function list()
    {
        $collection = collect([null, null]);

        return ExampleResource::collection($collection);
    }

    /**
     * @SWG\Get(
     *   path="/api/example/{id}",
     *   summary="Returns a single JSON-API example response",
     *   tags={"example"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @SWG\Schema(
     *       allOf={@SWG\Schema(ref="#/definitions/JsonApiResource")},
     *       @SWG\Property(
     *         property="data",
     *         ref="#/definitions/ExampleResource"
     *       )
     *     )
     *   )
     * )
     *
     * @return ExampleResource
     */
    public function show()
    {
        return new ExampleResource(null);
    }
}
