<?php

namespace Bitnetic\JsonApi\Resource;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\Resource;

/**
 * @SWG\Definition(
 *   type="object",
 *   @SWG\Xml(name="JsonApiResource")
 * )
 *
 * @SWG\Property(property="data", type="object")
 * @property \stdClass $data
 *
 * @SWG\Property(
 *   property="meta",
 *   type="object",
 *   @SWG\Property(property="status", type="number", example=200)
 *   @SWG\Property(property="success", type="boolean", example=true)
 * )
 * @property \stdClass $meta
 *
 * @SWG\Property(property="errors", type="object")
 * @property \stdClass $errors
 *
 * Class JsonApiResource
 * @package Bitnetic\JsonApi\Resource
 */
class JsonApiResource extends Resource
{
    /**
     * JsonApiResource constructor.
     * @param $resource
     * @param array|int $metaOrKey
     * @param array $errors
     * @param int $statusCode
     */
    public function __construct($resource, $metaOrKey = [], array $errors = [], int $statusCode = 200)
    {
        parent::__construct($resource);

        // Unfortunately laravel sends the collection offset key during hydration of collections
        // as 2nd parameter
        $meta = [];
        if (is_array($metaOrKey)) {
            $meta = array_merge([], $metaOrKey);
        }

        if ((!empty($errors)) || ($statusCode >= 400)) {
            $success = false;
        } else {
            $success = true;
        }

        $meta['status'] = $statusCode;
        $meta['success'] = $success;

        $additionals = [
            'meta' => $meta,
        ];

        if (!$success) {
            $additionals['errors'] = $errors;
        }

        $this->additional($additionals);
    }

    /**
     * @param $resource
     * @param array $meta
     * @param array $errors
     * @return JsonApiResourceCollection
     */
    public static function collection($resource, array $meta = [], array $errors = []): JsonApiResourceCollection
    {
        return new JsonApiResourceCollection($resource, get_called_class(), $meta, $errors);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        // provide shortcut
        if ($this->resource === null) {
            return [];
        }

        return parent::toArray($request);
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

        // mutually exclude data and errors
        if (isset($this->additional['errors'])) {
            $data = $response->getData(true);
            unset($data['data']);
            $response->setData($data);
        }

        return $response;
    }
}
