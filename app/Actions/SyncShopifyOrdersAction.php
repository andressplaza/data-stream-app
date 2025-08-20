<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Facades\DB;

final readonly class SyncShopifyOrdersAction
{
    /**
     * Execute the action.
     */
    public function handle(): void
    {
        DB::transaction(function (): void {
            //
        });
    }
}
