<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\DB;
use App\Models\User;

final readonly class UpdateUserProfileAction
{
    /**
     * Execute the action.
     */
    public function handle(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }
}
