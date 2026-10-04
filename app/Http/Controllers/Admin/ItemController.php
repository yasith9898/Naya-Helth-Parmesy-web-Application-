<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->paginate(10);
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.items.create');
    }

    public function store(Request $request)
    {
        // Debug: See what's coming in the request
        Log::info('Item Store Request:', $request->all());

        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_es' => 'nullable|string|max:255',
            'trade_name_en' => 'nullable|string|max:255',
            'trade_name_es' => 'nullable|string|max:255',
            'origin_en' => 'nullable|string|max:255',
            'origin_es' => 'nullable|string|max:255',
            'packaging_en' => 'nullable|string',
            'packaging_es' => 'nullable|string',
            'composition_en' => 'nullable|string',
            'composition_es' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        try {
            $data = $request->all();

            // Handle checkbox value properly
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                $coverImage = $request->file('cover_image');
                $coverImagePath = $coverImage->store('items/cover', 'public');
                $data['cover_image'] = $coverImagePath;
                Log::info('Cover image stored at: ' . $coverImagePath);
            }

            // Handle gallery images upload
            if ($request->hasFile('gallery_images')) {
                $galleryPaths = [];
                foreach ($request->file('gallery_images') as $image) {
                    $galleryPath = $image->store('items/gallery', 'public');
                    $galleryPaths[] = $galleryPath;
                    Log::info('Gallery image stored at: ' . $galleryPath);
                }
                $data['gallery_images'] = $galleryPaths;
            }

            // Generate UNIQUE slug with trade name consideration
            $baseSlug = Str::slug($data['name_en']);
            $slug = $baseSlug;
            $counter = 1;

            while (Item::where('slug', $slug)
                      ->where('trade_name_en', $data['trade_name_en'] ?? null)
                      ->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;

            // Create the item
            $item = Item::create($data);
            Log::info('Item created successfully with ID: ' . $item->id);

            return redirect()->route('admin.items.index')
                ->with('success', 'Item created successfully.');

        } catch (\Exception $e) {
            Log::error('Error creating item: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating item: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_es' => 'nullable|string|max:255',
            'trade_name_en' => 'nullable|string|max:255',
            'trade_name_es' => 'nullable|string|max:255',
            'origin_en' => 'nullable|string|max:255',
            'origin_es' => 'nullable|string|max:255',
            'packaging_en' => 'nullable|string',
            'packaging_es' => 'nullable|string',
            'composition_en' => 'nullable|string',
            'composition_es' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        try {
            $data = $request->all();

            // Handle checkbox value properly
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            // Handle file uploads
            if ($request->hasFile('cover_image')) {
                // Delete old cover image
                if ($item->cover_image) {
                    Storage::disk('public')->delete($item->cover_image);
                }
                $coverImagePath = $request->file('cover_image')->store('items/cover', 'public');
                $data['cover_image'] = $coverImagePath;
                Log::info('Cover image updated to: ' . $coverImagePath);
            }

            // Handle explicit removal of cover image (checkbox)
            if ($request->has('remove_cover_image') && $request->input('remove_cover_image')) {
                if ($item->cover_image) {
                    Storage::disk('public')->delete($item->cover_image);
                    Log::info('Cover image removed for item ID: ' . $item->id);
                }
                $data['cover_image'] = null;
            }

            if ($request->hasFile('gallery_images')) {
                // Delete old gallery images
                if ($item->gallery_images) {
                    foreach ($item->gallery_images as $oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }

                $galleryPaths = [];
                foreach ($request->file('gallery_images') as $image) {
                    $galleryPath = $image->store('items/gallery', 'public');
                    $galleryPaths[] = $galleryPath;
                    Log::info('Gallery image stored at: ' . $galleryPath);
                }
                $data['gallery_images'] = $galleryPaths;
            }

            // Handle removal of selected gallery images (checkboxes)
            if ($request->has('remove_gallery_images')) {
                $toRemove = (array) $request->input('remove_gallery_images');
                $existing = $item->gallery_images ?: [];

                // Delete files and filter out removed ones
                $remaining = [];
                foreach ($existing as $existingImage) {
                    if (in_array($existingImage, $toRemove)) {
                        Storage::disk('public')->delete($existingImage);
                        Log::info('Removed gallery image: ' . $existingImage . ' for item ID: ' . $item->id);
                    } else {
                        $remaining[] = $existingImage;
                    }
                }

                // If new gallery uploads are provided they replace the gallery entirely
                if (!empty($data['gallery_images'])) {
                    // $data['gallery_images'] already set from uploads above
                } else {
                    $data['gallery_images'] = $remaining;
                }
            }

            // Update slug if name_en or trade_name_en changed
            if ($item->name_en !== $data['name_en'] || $item->trade_name_en !== $data['trade_name_en']) {
                $baseSlug = Str::slug($data['name_en']);
                $slug = $baseSlug;
                $counter = 1;

                while (Item::where('slug', $slug)
                          ->where('trade_name_en', $data['trade_name_en'] ?? null)
                          ->where('id', '!=', $item->id)
                          ->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                $data['slug'] = $slug;
            }

            $item->update($data);
            Log::info('Item updated successfully with ID: ' . $item->id);

            return redirect()->route('admin.items.index')
                ->with('success', 'Item updated successfully.');

        } catch (\Exception $e) {
            Log::error('Error updating item: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating item: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Item $item)
    {
        try {
            // Delete associated images
            if ($item->cover_image) {
                Storage::disk('public')->delete($item->cover_image);
                Log::info('Deleted cover image: ' . $item->cover_image);
            }

            if ($item->gallery_images) {
                foreach ($item->gallery_images as $image) {
                    Storage::disk('public')->delete($image);
                    Log::info('Deleted gallery image: ' . $image);
                }
            }

            $itemId = $item->id;
            $item->delete();
            Log::info('Item deleted successfully with ID: ' . $itemId);

            return redirect()->route('admin.items.index')
                ->with('success', 'Item deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Error deleting item: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error deleting item: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Item $item)
    {
        try {
            $item->update(['is_active' => !$item->is_active]);
            Log::info('Item status toggled for ID: ' . $item->id . ' to: ' . ($item->is_active ? 'active' : 'inactive'));

            return response()->json([
                'success' => true,
                'is_active' => $item->is_active
            ]);

        } catch (\Exception $e) {
            Log::error('Error toggling item status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
