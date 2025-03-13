<?php

namespace Davideccia\TicTac\Http\Resources;

use Davideccia\TicTac\Models\Expiration;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Expiration $resource
 */
class ExpirationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $resourceArray = parent::toArray($request);

        //

        return $resourceArray;
    }
}
