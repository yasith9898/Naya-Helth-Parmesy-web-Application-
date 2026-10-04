<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('order', 'asc')->get();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slides', 'public');
            $validated['image'] = $imagePath;
        }

        Slide::create($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide created successfully!');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $validated = $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:500',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'order' => 'nullable|integer',
        'button_text' => 'nullable|string|max:50',
        'button_link' => 'nullable|string|max:255',
        'is_active' => 'sometimes|boolean' // Add this validation
    ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }

            $imagePath = $request->file('image')->store('slides', 'public');
            $validated['image'] = $imagePath;
        }

        $slide->update($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide updated successfully!');
    }

    public function destroy(Slide $slide)
    {
        // Delete image
        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }

        $slide->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide deleted successfully!');
    }

    public function toggleStatus(Slide $slide)
    {
        $slide->update(['is_active' => !$slide->is_active]);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide status updated successfully!');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            Slide::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}
