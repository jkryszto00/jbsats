<?php

namespace App\Http\Controllers\Panel\Apply;

use App\Domain\Apply\Actions\RejectApplyAction;
use App\Domain\Apply\Models\Apply;
use App\Exceptions\CannotChangeApplyStatusException;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class RejectApplyController extends Controller
{
    public function __invoke(Apply $apply): RedirectResponse
    {
        $this->authorize('update', $apply);

        try {
            RejectApplyAction::execute($apply);
            return redirect()->back();
        } catch (CannotChangeApplyStatusException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
