<?php

namespace App\Http\Controllers;

use App\Models\ImageCategory;
use Illuminate\Http\Request;

class ImageCategoryController extends Controller
{
    public function index()
    {
        $categories = ImageCategory::withCount('items')
            ->orderBy('ic_id', 'asc')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function getGalleryCategoriesForAPI()
    {
        $categories = ImageCategory::where('status', 'active')
            ->orderBy('ic_id', 'asc')->get(['ic_id', 'ic_name', 'description']);

        return response()->json([
            'success' => true,
            'msg' => 'Gallery categories retrieved successfully',
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ic_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,delete',
        ]);

        ImageCategory::create([
            'ic_name' => $request->ic_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ic_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,delete',
        ]);

        $category = ImageCategory::findOrFail($id);

        $category->update([
            'ic_name' => $request->ic_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $category = ImageCategory::withCount('items')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:active,delete',
        ]);

        if ($request->status === 'delete' && $category->items_count > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'This category cannot be deleted because it still contains associated items.');
        }

        $category->status = $request->status;
        $category->save();

        $message = $request->status === 'delete'
            ? 'Category deleted successfully.'
            : 'Category activated successfully.';

        return redirect()->route('categories.index')->with('success', $message);
    }


    public function destroy($id)
    {
        $category = ImageCategory::findOrFail($id);
        return view('categories.destroy', compact('category'));
    }

}