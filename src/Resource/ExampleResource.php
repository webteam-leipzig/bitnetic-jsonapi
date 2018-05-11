<?php

namespace Bitnetic\JsonApi\Resource;

use Carbon\Carbon;

/**
 * @SWG\Definition(
 *   type="object",
 *   required={"content", "reason", "locale", "date"},
 *   @SWG\Xml(name="ExampleResource")
 * )
 *
 * @SWG\Property(property="content", type="string", example="This is an example.")
 * @property string $content
 *
 * @SWG\Property(property="reason", type="string", example="We need a test response.")
 * @property string $reason
 *
 * @SWG\Property(property="locale", type="string", format="ISO-3166-1 ALPHA-2", example="de")
 * @property string $locale
 *
 * @SWG\Property(property="date", type="string", format="ISO-8601", example="2018-05-08T14:12:59+02:00")
 * @property string $date
 *
 * Class ExampleResource
 * @package Bitnetic\JsonApi\Resource
 */
class ExampleResource extends JsonApiResource
{
    public function toArray($request): array
    {
        return [
            'content' => 'This is an example.',
            'reason' => 'We need a test response.',
            'locale' => \App::getLocale(),
            'date' => (new Carbon())->toIso8601String(),
        ];
    }
}
