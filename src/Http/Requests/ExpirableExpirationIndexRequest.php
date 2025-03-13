<?php

namespace Davideccia\TicTac\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExpirableExpirationIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'paginate' => ['nullable', 'integer', 'min:1'],
            'page' => [Rule::requiredIf(fn() => $this->input('paginate', false)), 'integer', 'min:1'],
            'per_page' => [Rule::requiredIf(fn() => $this->input('paginate', false)), 'integer', 'min:1', 'max:100'],
            'expired' => ['required', 'bool'],
            'expiring' => ['required', 'bool', 'different:expired'],
        ];
    }
}
