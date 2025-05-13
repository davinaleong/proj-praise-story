<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimony;
use App\Helpers\Setting;
use App\Helpers\Status;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonies = Testimony::where('user_id', auth()->id())
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('testimonies.index', compact('testimonies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statues = Status::STATUSES_TESTIMONY;

        return view('testimonies.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        //
    }

    private function getTestimony(string $uuid): Testimony
    {
        $testimony = Testimony::where('uuid', $uuid)->firstOrFail();

        if ($testimony->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return $testimony;
    }
}
