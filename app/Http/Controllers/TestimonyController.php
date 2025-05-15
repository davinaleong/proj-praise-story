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
            ->orderBy('title')
            ->paginate(Setting::ITEMS_PER_PAGE_100);

        return view('me.testimonies.index', compact('testimonies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::getSelectOptions();

        return view('me.testimonies.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->getRules());

        $testimony = Testimony::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $request->published_at,
        ]);

        return redirect()
            ->route('me.testimonies.show', $testimony->uuid)
            ->with('message', 'Testimony created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $testimony = $this->getTestimony($uuid);

        return view('me.testimonies.show', compact('testimony'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $testimony = $this->getTestimony($uuid);
        $testimony->statusHumanName = Status::getHumanName($testimony->status);

        $statuses = Status::getSelectOptions();

        return view('me.testimonies.edit', compact('testimony', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $testimony = $this->getTestimony($uuid);

        $request->validate($this->getRules());

        $testimony->title = $request->title;
        $testimony->content = $request->content;
        $testimony->status = $request->status;
        $testimony->published_at = $request->published_at;
        $testimony->save();

        return redirect()
            ->route('me.testimonies.show', $testimony->uuid)
            ->with('message', 'Testimony updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $testimony = $this->getTestimony($uuid);
        $testimony->delete();

        return redirect()
            ->route('me.testimonies.index')
            ->with('message', 'Testimony deleted successfully.');
    }

    private function getTestimony(string $uuid): Testimony
    {
        $testimony = Testimony::where('uuid', $uuid)->firstOrFail();

        if ($testimony->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return $testimony;
    }

    private function getRules(): array
    {
        $statuses = implode(',', Status::STATUSES_TESTIMONY);

        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => "required|in:$statuses",
            'published_at' => 'required|date',
        ];
    }
}
