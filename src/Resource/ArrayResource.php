<?php

namespace Bitnetic\JsonApi\Resource;

/**
 * @SWG\Definition(
 *     required={},
 *     type="object",
 *     @SWG\Xml(name="ArrayResource")
 * )
 *
 * Class ArrayResource
 * @package Bitnetic\JsonApi\Resource
 */
class ArrayResource extends JsonApiResource
{
    public function toArray($request): array
    {
        return $this->resource;
    }
}
