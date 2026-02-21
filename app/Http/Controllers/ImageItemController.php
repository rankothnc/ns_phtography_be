<?php

namespace App\Http\Controllers;

use App\Models\ImageCategory;
use App\Models\ImageItem;
use Illuminate\Http\Request;

class ImageItemController extends Controller
{
    public function index()
    {
        $items = ImageItem::with('category')
            ->orderBy('ii_id', 'asc')
            ->paginate(10);

        return view('image-items.index', compact('items'));
    }

    public function getGalleryItemsForAPI(Request $request)
    {
        $query = ImageItem::with([
            'category' => function ($q) {
                $q->where('status', 'active');
            }
        ])
        ->where('status', 'active');

        if ($request->filled('category_id')) {
            if(!empty($request->category_id)){
                $query->where('ic_id', $request->category_id);
            }
        }

        $items = $query
            ->orderBy('ii_id', 'asc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'msg' => 'Gallery items retrieved successfully',
            'data' => $items
        ]);
    }

    public function create(Request $request)
    {
        $categories = ImageCategory::where('status', 'active')->get();

        return view('image-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ic_id' => 'required|integer',
            'image_title' => 'required|string|max:255',
            'image_desc_short' => 'nullable|string',
            'image_desc_long' => 'nullable|string',
            'status' => 'required|in:active,delete',
            'capture_date' => 'required|date|before_or_equal:today',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Get category
        $category = ImageCategory::findOrFail($request->ic_id);

        // Clean category name for folder
        $categoryFolder = str_replace(' ', '_', strtolower($category->ic_name));

        // Create upload path
        $uploadPath = public_path(path: 'storage/uploads/'.$categoryFolder);

        if (! file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Prepare image name
        $imageFile = $request->file('image');
        $firstWord = strtolower(strtok($request->image_title, ' '));
        $timestamp = now()->format('Ymd_Hi');
        $extension = $imageFile->getClientOriginalExtension();

        $imageName = $firstWord.'_'.$timestamp.'.'.$extension;

        // Move image
        $imageFile->move($uploadPath, $imageName);

        // Save relative path
        $imagePath = 'storage/uploads/'.$categoryFolder.'/'.$imageName;

        ImageItem::create([
            'ic_id' => $request->ic_id,
            'image_path' => $imagePath,
            'image_title' => $request->image_title,
            'image_desc_short' => $request->image_desc_short,
            'image_desc_long' => $request->image_desc_long,
            'status' => $request->status,
            'capture_date' => $request->capture_date,
            'c_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Image item saved successfully!');
    }

    public function edit($id)
    {
        $item = ImageItem::findOrFail($id);
        $categories = ImageCategory::where('status', 'active')->get();

        return view('image-items.create', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $item = ImageItem::findOrFail($id);

        $request->validate([
            'ic_id' => 'required|integer',
            'image_title' => 'required|string|max:255',
            'image_desc_short' => 'nullable|string',
            'image_desc_long' => 'nullable|string',
            'status' => 'required|in:active,delete',
            'capture_date' => 'required|date|before_or_equal:today',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Update basic fields
        $item->ic_id = $request->ic_id;
        $item->image_title = $request->image_title;
        $item->image_desc_short = $request->image_desc_short;
        $item->image_desc_long = $request->image_desc_long;
        $item->status = $request->status;
        $item->capture_date = $request->capture_date;

        // If new image uploaded
        if ($request->hasFile('image')) {

            // Delete old image
            if ($item->image_path && file_exists(public_path($item->image_path))) {
                unlink(public_path($item->image_path));
            }

            // Get category
            $category = ImageCategory::findOrFail($request->ic_id);
            $categoryFolder = str_replace(' ', '_', strtolower($category->ic_name));

            // Upload path
            $uploadPath = public_path('storage/uploads/'.$categoryFolder);

            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Image naming
            $imageFile = $request->file('image');
            $firstWord = strtolower(strtok($request->image_title, ' '));
            $timestamp = now()->format('Ymd_Hi');
            $extension = $imageFile->getClientOriginalExtension();

            $imageName = $firstWord.'_'.$timestamp.'.'.$extension;

            // Move image
            $imageFile->move($uploadPath, $imageName);

            // Save new path
            $item->image_path = 'storage/uploads/'.$categoryFolder.'/'.$imageName;
        }

        $item->save();

        return redirect()
            ->route('image-items.index')
            ->with('success', 'Item updated successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $item = ImageItem::findOrFail($id);

        $request->validate([
            'status' => 'required|in:active,delete',
        ]);

        $item->status = $request->status;
        $item->save();

        $message = $request->status === 'delete'
            ? 'Item deleted successfully!'
            : 'Item activated successfully!';

        return redirect()->route('image-items.index')->with('success', $message);
    }

    public function destroy($id)
    {
        $item = ImageItem::findOrFail($id);

        return view('image-items.destroy', compact('item'));
    }

    public function show($id)
    {
        $item = ImageItem::with('category')->findOrFail($id);

        return response()->json($item);
    }
}
