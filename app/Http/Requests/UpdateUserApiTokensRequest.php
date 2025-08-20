<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserApiTokensRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'shopify_store_url' => ['nullable', 'url', 'max:255'],
            'shopify_api_token' => ['nullable', 'string', 'max:500'],
            'facebook_pixel_id' => ['nullable', 'string', 'max:50'],
            'facebook_pixel_token' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'shopify_store_url.url' => 'La URL de Shopify debe ser una URL válida.',
            'shopify_store_url.max' => 'La URL de Shopify no puede exceder 255 caracteres.',
            'shopify_api_token.max' => 'El token de Shopify no puede exceder 500 caracteres.',
            'facebook_pixel_id.max' => 'El ID del pixel de Facebook no puede exceder 50 caracteres.',
            'facebook_pixel_token.max' => 'El token de Facebook no puede exceder 500 caracteres.',
        ];
    }
}
