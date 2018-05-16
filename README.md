# JsonApi.org compability package for Laravel 5.5+

This package is intended to provide an easy way to achieve compatibility with the API standards defined at http://jsonapi.org.
Currently, only the top-level structure (http://jsonapi.org/format/#document-top-level) is supported,
but ongoing work strives for a more complete coverage of the standard.

## How to install it

You can install the package via _composer_:

    $ composer require bitnetic/jsonapi "0.1.*"

JsonApi comes with a config file named _config/jsonapi.php_.
This file is deployed to the central laravel configuration directory using the _vendor:publish_ command:

    $ php artisan vendor:publish --provider "Bitnetic\JsonApi\JsonApiServiceProvider"

Next, extend your exception handler with JsonApi standard responses:

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return JsonApiExceptionHandler::render($request, $exception)
            ?? parent::render($request, $exception);
    }

## How to use it

This JsonApi package is minimal-invasive to Laravel.
Just use HTTP resources within your controllers and extend them from `JsonApiResource`.

This is an example controller method:

    /**
     * @return UserResource
     */
    public function getUser(Request $request)
    {
        return new UserResource($request->user());
    }

You can also use collections in a `list()`-method by calling `UserResource::collect($myUsers);`.

# Put extra data into the response

You can always add your own data into the `meta` or `errors` field, or return a different HTTP status code.
The package just makes sure that the status code is mapped additionally as a `status` field within the meta block.

    return new UserResource($myUser, ['type' => 'admin'], $exception->errors(), 404);
     
# How to write an appropriate resource

Take a look at the following example:

    class UserResource extends JsonApiResource
    {
        public function toArray($request)
        {
            return [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->when(
                    $request->user() ... e.g.,
                    MySecureTokenFactory::wrap($this->password),
            ];
        }
    }

In a resource like `UserResource($user)`, you can access the underlying user object by using `$this`.

You can also take a look the included `ExampleResource` and adopt it to your needs.

# The outcome

The formatted Json-Api-Response from the examples above should produce something like this:

    {
      "data": {
        "name": "John Doe",
        "email": "john@example.com"
      },
      "meta": {
        "status": 200
        "success": true
      }
    }
