<?php

namespace Bitnetic\JsonApi\Exceptions;

use Bitnetic\JsonApi\Resource\ArrayResource;
use function Composer\Autoload\includeFile;

/**
 * Class JsonApiExceptionHandler
 * @package Bitnetic\JsonApi\Exceptions
 */
class JsonApiExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return @return \Illuminate\Http\Response|null
     */
    public static function render($request, \Exception $exception)
    {
        if (! $request->expectsJson()) {
            return null;
        }

        $mapping = config('jsonapi.returnCodes') ?? [];
        $class = get_class($exception);
        if (! array_key_exists($class, $mapping)) {
            return null;
        }

        $data = [];

        $message = config('jsonapi.messages.' . $class) ?? null;
        $meta = $message !== null ? ['message' => $message] : [];

        $errorCode = $mapping[$class];
        $showErrors = config('jsonapi.errors.' . $class) ?? false;
        $errors = $showErrors ? $exception->errors() : [];

        return (
            new ArrayResource($data, $meta, $errors, $errorCode)
        )->response($request);
    }
}
