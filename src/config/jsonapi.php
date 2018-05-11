<?php

return [
    'returnCodes' => [
        'Illuminate\Validation\ValidationException' => 422,
        'Illuminate\Auth\AuthenticationException' => 401,
        'Illuminate\Auth\Access\AuthorizationException' => 403,
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException' => 404,
        'Illuminate\Database\Eloquent\ModelNotFoundException' => 404,
    ],
    'errors' => [
        'Illuminate\Validation\ValidationException' => true,
        'Illuminate\Auth\AuthenticationException' => false,
        'Illuminate\Auth\Access\AuthorizationException' => false,
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException' => false,
        'Illuminate\Database\Eloquent\ModelNotFoundException' => false,
    ],
    'messages' => [
        'Illuminate\Validation\ValidationException' => 'The given data was invalid.',
        'Illuminate\Auth\AuthenticationException' => 'User not authenticated.',
        'Illuminate\Auth\Access\AuthorizationException' => 'This action is unauthorized.',
        'Symfony\Component\HttpKernel\Exception\NotFoundHttpException' => 'Page not found.',
        'Illuminate\Database\Eloquent\ModelNotFoundException' => 'Object not found.',
    ],
];
