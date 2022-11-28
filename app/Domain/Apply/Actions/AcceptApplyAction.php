<?php

namespace App\Domain\Apply\Actions;

use App\Domain\Apply\Enums\ApplyStatus;
use App\Domain\Apply\Models\Apply;
use App\Exceptions\CannotChangeApplyStatusException;

class AcceptApplyAction
{
    public static function execute(Apply $apply): Apply
    {
        if ($apply->status !== ApplyStatus::APPLIED->value) {
            throw new CannotChangeApplyStatusException('Accept apply not allowed');
        }

        $apply->update([
            'status' => ApplyStatus::ACCEPTED
        ]);

        return $apply;
    }
}
