<?php

namespace App\Domain\Apply\Actions;

use App\Domain\Apply\Enums\ApplyStatus;
use App\Domain\Apply\Models\Apply;

class RejectApplyAction
{
    public static function execute(Apply $apply): Apply
    {
        if ($apply->status !== ApplyStatus::APPLIED) {
            throw new \Exception('Reject apply not allowed');
        }

        $apply->update([
            'status' => ApplyStatus::REJECTED
        ]);

        return $apply;
    }
}
