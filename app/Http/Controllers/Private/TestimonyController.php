<?php

namespace App\Http\Controllers\Private;

use Illuminate\Http\Request;
use App\Models\Testimony;
use App\Helpers\Setting;
use App\Helpers\Status;
use App\Http\Controllers\Controller;

class TestimonyController extends Controller
{
    public function index()
    {
        $statuses = [Status::STATUS_TESTIMONY_PUBLIC, Status::STATUS_TESTIMONY_PRIVATE];
        $items_per_page = Setting::ITEMS_PER_PAGE_100;

        $testimonies = Testimony::whereIn('status', $statuses)
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate($items_per_page);

        return view('private.index', compact('testimonies'));
    }

    public function show(string $uuid)
    {
        $testimony = $this->getTestimony($uuid);

        return view('private.show', compact('testimony'));
    }

    private function getTestimony(string $uuid): Testimony
    {
        $statuses =[Status::STATUS_TESTIMONY_PUBLIC, Status::STATUS_TESTIMONY_PRIVATE];
        $testimony = Testimony::where('uuid', $uuid)
            ->whereIn('status', $statuses)
            ->firstOrFail();

        if ($testimony->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return $testimony;
    }
}
