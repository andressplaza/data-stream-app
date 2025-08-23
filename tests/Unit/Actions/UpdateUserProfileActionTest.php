<?php

declare(strict_types=1);

use App\Actions\UpdateUserProfileAction;
use App\Models\User;

it('updates user profile data', function (): void {
    $user = User::factory()->create([
        'name' => 'Original Name',
        'email' => 'original@example.com',
        'shopify_store_url' => null,
        'facebook_pixel_id' => null,
        'shopify_api_token' => null,
        'facebook_pixel_token' => null,
    ]);

    $action = new UpdateUserProfileAction();

    $data = [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'shopify_store_url' => 'https://example.myshopify.com',
        'facebook_pixel_id' => 'pixel123',
        'shopify_api_token' => 'token123',
        'facebook_pixel_token' => 'fbtoken123',
    ];

    $updatedUser = $action->handle($user, $data);

    expect($updatedUser->name)->toBe('Updated Name');
    expect($updatedUser->email)->toBe('updated@example.com');
    expect($updatedUser->shopify_store_url)->toBe('https://example.myshopify.com');
    expect($updatedUser->facebook_pixel_id)->toBe('pixel123');
    expect($updatedUser->shopify_api_token)->toBe('token123');
    expect($updatedUser->facebook_pixel_token)->toBe('fbtoken123');

    // Verificar que los datos se guardaron en la base de datos  
    $user->refresh();
    expect($user->name)->toBe('Updated Name');
    expect($user->email)->toBe('updated@example.com');
});

it('updates only provided fields', function (): void {
    $user = User::factory()->create([
        'name' => 'Original Name',
        'email' => 'original@example.com',
        'shopify_store_url' => 'https://original.myshopify.com',
    ]);

    $action = new UpdateUserProfileAction();

    $data = [
        'name' => 'Updated Name',
        'shopify_store_url' => 'https://updated.myshopify.com',
    ];

    $updatedUser = $action->handle($user, $data);

    expect($updatedUser->name)->toBe('Updated Name');
    expect($updatedUser->email)->toBe('original@example.com'); // No cambió  
    expect($updatedUser->shopify_store_url)->toBe('https://updated.myshopify.com');
});

it('handles encrypted fields correctly', function (): void {
    $user = User::factory()->create();
    $action = new UpdateUserProfileAction();

    $data = [
        'shopify_api_token' => 'secret_token_123',
        'facebook_pixel_token' => 'fb_secret_456',
    ];

    $updatedUser = $action->handle($user, $data);

    // Los tokens deben estar encriptados en la base de datos  
    expect($updatedUser->shopify_api_token)->toBe('secret_token_123');
    expect($updatedUser->facebook_pixel_token)->toBe('fb_secret_456');

    // Verificar que están encriptados en la base de datos  
    $user->refresh();
    expect($user->getAttributes()['shopify_api_token'])->not()->toBe('secret_token_123');
    expect($user->getAttributes()['facebook_pixel_token'])->not()->toBe('fb_secret_456');
});
