<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // IMPORTANT: Import the Storage facade

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->only(['indexAdmin', 'store', 'destroy']);
    }

    /**
     * Display a listing of the resource for the public home page.
     */
    public function index()
    {
        $index = Content::all();

        return view("home", ["index" => $index]);
    }

    /**
     * Display a listing of the content for the admin dashboard.
     * This method fetches all content and passes it to the admin_dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function indexAdmin()
    {
        $contents = Content::all();

        return view('admin_dashboard', ['contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not used directly here, form is on dashboard
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContentRequest $request)
    {
        $validatedData = $request->validated(); // Get all validated data

        // Handle image upload if a file is present
        if ($request->hasFile('gambar')) {
            // IMPORTANT CHANGE: Use storePublicly() or store('path', 'disk_name')
            // storePublicly() specifically targets the 'public' disk.
            // The path 'images/content' is relative to the 'public' disk's root (storage/app/public).
            $path = $request->file('gambar')->storePublicly('images/content', 'public'); // Explicitly use 'public' disk
            // Alternatively: $path = Storage::disk('public')->put('images/content', $request->file('gambar'));

            $validatedData['gambar'] = $path;
        } else {
            $validatedData['gambar'] = null;
        }

        // Create a new Content record with the (potentially updated) validated data.
        Content::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Service content added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContentRequest $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Content $content)
    {
        // If the content has an associated image file, delete it from storage.
        if ($content->gambar) {
            // Storage::delete expects the path relative to the storage/app directory.
            // Make sure to delete from the correct disk if you had multiple.
            Storage::disk('public')->delete($content->gambar); // Explicitly delete from 'public' disk
        }

        // Delete the content record from the database.
        $content->delete();

        return redirect()->route('admin.dashboard')->with('success_delete', 'Service content deleted successfully!');
    }
}
