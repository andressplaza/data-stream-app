<?php

declare(strict_types=1);

use App\Models\User;

test('to array', function () {
    $user = User::factory()->create()->refresh()
        ->makeVisible([
            'password',
            'remember_token',
            'shopify_api_token',
            'facebook_pixel_token',
        ]);

    expect(array_keys($user->toArray()))
        ->toBe([
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'remember_token',
            'created_at',
            'updated_at',
            'shopify_api_token',
            'facebook_pixel_token',
            'shopify_store_url',
            'facebook_pixel_id',
        ]);
});
