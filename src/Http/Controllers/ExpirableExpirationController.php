<?php

namespace Davideccia\TicTac\Http\Controllers;

use Davideccia\TicTac\Contracts\Expirable;
use Davideccia\TicTac\Http\Requests\ExpirationIndexRequest;
use Davideccia\TicTac\Http\Resources\ExpirationResource;
use Davideccia\TicTac\Models\Expiration;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpirableExpirationController
{
    public function index(ExpirableExpirationController $request, Expirable $expirable): ResourceCollection
    {
        $input = $request->validated();
        $expirations = $expirable->expirations();

        if ($input['expired']) {
            $expirations = $expirations->expired();
        } elseif ($input['expiring']) {
            $expirations = $expirations->expiring();
        } else {
            $expirations = $expirations->ok();
        }

        if ($input['paginate'] ?? false) {
            $expirations = $expirations->paginate($input['per_page'], page: $input['page']);
        } else {
            $expirations = $expirations->get();
        }

        return ExpirationResource::collection($expirations);
    }
}
