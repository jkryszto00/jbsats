<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\Apply\Actions\RejectApplyAction;
use App\Domain\Apply\Models\Apply;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class RejectApplyController extends Controller
{
    public function __invoke(Apply $apply): RedirectResponse
    {
        $this->authorize('update', $apply);

        RejectApplyAction::execute($apply);
        return redirect()->route('panel.apply.show', $apply->jobOffer);
    }
}
