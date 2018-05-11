<?php

namespace Bitnetic\JsonApi\Resource;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class JsonApiResourceCollection
 * @package Bitnetic\JsonApi\Resource
 */
class JsonApiResourceCollection extends AnonymousResourceCollection
{
    /**
     * JsonApiResourceCollection constructor.
     * @param $resource
     * @param string $collects
     * @param array $meta
     * @param array $errors
     * @param int $statusCode
     */
    public function __construct(
        $resource,
        string $collects,
        array $meta = [],
        array $errors = [],
        int $statusCode = 200
    ) {
        parent::__construct($resource, $collects);

        $meta['status'] = $statusCode;
        $this->additional([
            'meta' => $meta,
            'errors' => $errors,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \InvalidArgumentException
     */
    public function toResponse($request): JsonResponse
    {
        $response = parent::toResponse($request);

        if ($this->additional['meta']['status'] !== 200) {
            $response->setStatusCode($this->additional['meta']['status']);
        }

        return $response;
    }
}
