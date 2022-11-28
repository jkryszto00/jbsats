<?php

namespace App\Http\Controllers\Panel;

use App\Domain\Shared\Models\Media;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ShowCvController extends Controller
{
    public function __invoke(string $name)
    {
        $cv = Media::where('name', $name)->firstOrFail();
        $path = storage_path('app/'.$cv->collection.'/'.$cv->name);

        if (!Gate::allows('show-cv', $cv)) {
            abort(403);
        }

        return response()->file($path);
    }
}
