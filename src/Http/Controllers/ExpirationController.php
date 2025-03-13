<?php

namespace Davideccia\TicTac\Http\Controllers;

use Davideccia\TicTac\Http\Requests\ExpirationIndexRequest;
use Davideccia\TicTac\Http\Resources\ExpirationResource;
use Davideccia\TicTac\Models\Expiration;

class ExpirationController
{
    public function index(ExpirationIndexRequest $request)
    {
        $input = $request->validated();
        $expirations = Expiration::query();

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
