<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**  
 * @property-read int $id  
 * @property-read string $name
 * @property-read string $email
 * @property-read CarbonInterface|null $email_verified_at  
 * @property string $password  
 * @property-read string|null $remember_token  
 * @property-read CarbonInterface $created_at  
 * @property-read CarbonInterface $updated_at  
 * @property string|null $shopify_api_token  
 * @property string|null $facebook_pixel_token  
 * @property string|null $shopify_store_url  
 * @property string|null $facebook_pixel_id  
 */
final class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'shopify_api_token',
        'facebook_pixel_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'shopify_api_token' => 'encrypted',
            'facebook_pixel_token' => 'encrypted',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->email === 'andresplaza123@icloud.com' ? true : false;
        }

        return true;
    }
}
