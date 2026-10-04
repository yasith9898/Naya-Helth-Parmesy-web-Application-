<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::ordered()->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        // Pass title to the view
        $title = 'Create Partner';
        return view('admin.partners.create', compact('title'));
    }

    public function store(Request $request)
    {
        \Log::info('Partner store request', ['has_image' => $request->hasFile('image'), 'all_files' => array_keys($request->allFiles())]);

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_es' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_es' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_link' => 'nullable|url',
            'order' => 'integer|min:0'
        ]);

        $partnerData = [
            'name' => [
                'en' => $validated['name_en'],
                'es' => $validated['name_es']
            ],
            'description' => [
                'en' => $validated['description_en'] ?? '',
                'es' => $validated['description_es'] ?? ''
            ],
            'website_link' => $validated['website_link'],
            'order' => $validated['order'] ?? 0
        ];

        if ($request->hasFile('image')) {
            $partnerData['image'] = $request->file('image')->store('partners', 'public');
            \Log::info('Partner image stored at: ' . $partnerData['image']);
        } else {
            \Log::info('No image file received for partner');
        }

        Partner::create($partnerData);
        \Log::info('Partner created successfully');

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner created successfully.');
    }

    public function show(Partner $partner)
    {
        $title = 'View Partner';
        return view('admin.partners.show', compact('partner', 'title'));
    }

    public function edit(Partner $partner)
    {
        // Pass title to the view
        $title = 'Edit Partner';
        return view('admin.partners.edit', compact('partner', 'title'));
    }

    public function update(Request $request, Partner $partner)
    {
        \Log::info('Partner update request', ['partner_id' => $partner->id, 'has_image' => $request->hasFile('image')]);

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_es' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_es' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_link' => 'nullable|url',
            'order' => 'integer|min:0'
        ]);

        $partnerData = [
            'name' => [
                'en' => $validated['name_en'],
                'es' => $validated['name_es']
            ],
            'description' => [
                'en' => $validated['description_en'] ?? '',
                'es' => $validated['description_es'] ?? ''
            ],
            'website_link' => $validated['website_link'],
            'order' => $validated['order'] ?? 0
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($partner->image) {
                Storage::disk('public')->delete($partner->image);
                \Log::info('Deleted old partner image: ' . $partner->image);
            }
            $partnerData['image'] = $request->file('image')->store('partners', 'public');
            \Log::info('Partner image updated to: ' . $partnerData['image']);
        } else {
            \Log::info('No new image for partner update');
        }

        $partner->update($partnerData);
        \Log::info('Partner updated successfully');

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->image) {
            Storage::disk('public')->delete($partner->image);
        }

        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner deleted successfully.');
    }

    public function toggleStatus(Partner $partner)
    {
        $partner->update(['is_active' => !$partner->is_active]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner status updated successfully.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Partner::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
