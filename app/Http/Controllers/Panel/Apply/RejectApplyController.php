<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\Apply\Actions\RejectApplyAction;
use App\Domain\Apply\Models\Apply;
use Illuminate\Http\RedirectResponse;

class RejectApplyController
{
    public function __invoke(Apply $apply): RedirectResponse
    {
        RejectApplyAction::execute($apply);
        return redirect()->route('panel.apply.show', $apply->jobOffer);
    }
}
