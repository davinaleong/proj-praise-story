<?php

namespace App\Http\Controllers;

use App\Helpers\Setting;
use App\Helpers\Status;
use App\Models\Testimony;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class MeTestimonyController extends Controller
{
    public function index()
    {
        $statuses = [Status::STATUS_TESTIMONY_PUBLIC, Status::STATUS_TESTIMONY_PRIVATE, Status::STATUS_TESTIMONY_PUBLISHED];
        $items_per_page = Setting::ITEMS_PER_PAGE_100;

        $testimonies = Testimony::where('user_id', auth()->id())
            ->whereIn('status', $statuses)
            ->orderByDesc('published_at')
            ->orderBy('title')
            ->paginate($items_per_page );


        return view('me.published-testimonies.index', compact('testimonies'));
    }

    public function show(string $uuid)
    {
        $testimony = $this->getTestimony($uuid);

        return view('me.published-testimonies.show', compact('testimony'));
    }

    private function getTestimony(string $uuid): Testimony
    {
        $testimony = Testimony::where('uuid', $uuid)->firstOrFail();

        if ($testimony->status === Status::STATUS_TESTIMONY_DRAFT) {
            abort(404);
        }

        if ($testimony->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return $testimony;
    }
}
