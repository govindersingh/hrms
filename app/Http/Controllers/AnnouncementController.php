<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = __('Announcement');
        $announcements = Announcement::get();
        return view('pages.announcement.index',compact(
            'pageTitle',
            'announcements'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'nullable|max:255',
            'status' => 'required',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'author_id' => 'required'
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public'); // Save to storage/app/public/attachments
        }

        Announcement::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'status' => $request->status,
            'attachment' => $attachmentPath,
            'author_id' => $request->author_id
        ]);
        $notification = notify(__("Announcement created."));
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        return view('pages.announcement.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('pages.announcement.edit',compact(
            'announcement'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'nullable|max:255',
            'status' => 'required',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'updated_by' => 'required'
        ]);

        $attachmentPath = $announcement->attachment;

        if ($request->hasFile('attachment')) {
            if ($announcement->attachment && Storage::disk('public')->exists($announcement->attachment)) {
                Storage::disk('public')->delete($announcement->attachment);
            }
    
            // Store the new attachment and update the path
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $announcement->update([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'status' => $request->status,
            'attachment' => $attachmentPath,
            'updated_by' => $request->updated_by
        ]);
        $notification = notify(__("Announcement updated."));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        $notification = notify(__('Announcement has been deleted'));
        return redirect()->route('announcement.index')->with($notification);
    }

    public function details($id)
    {
        try {
            // Fetch the announcement
            $announcement = Announcement::findOrFail($id);
    
            // Render the partial view
            $html = view('pages.announcement.announcement-details', compact('announcement'))->render();
    
            // Return JSON response
            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            // Handle errors gracefully
            return response()->json(['error' => __('Unable to fetch announcement details.')], 404);
        }
    }
}
