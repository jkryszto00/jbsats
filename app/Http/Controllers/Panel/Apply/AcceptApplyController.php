<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\Apply\Actions\AcceptApplyAction;
use App\Domain\Apply\Models\Apply;
use Illuminate\Http\RedirectResponse;

class AcceptApplyController
{
    public function __invoke(Apply $apply): RedirectResponse
    {
        AcceptApplyAction::execute($apply);
        return redirect()->route('panel.apply.show', $apply->jobOffer);
    }
}
