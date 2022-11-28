<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\Apply\Actions\AcceptApplyAction;
use App\Domain\Apply\Models\Apply;
use App\Exceptions\CannotChangeApplyStatusException;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class AcceptApplyController extends Controller
{
    public function __invoke(Apply $apply): RedirectResponse
    {
        $this->authorize('update', $apply);

        try {
            AcceptApplyAction::execute($apply);
            return redirect()->back();
        } catch (CannotChangeApplyStatusException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
