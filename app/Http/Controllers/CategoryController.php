<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        # Set limit value from request or default is 5.
        $limit = $request->input('limit', 5);
        # Query Select model Category data terbaru dengan filter search dan paginate limit.
        $categories = Category::filter(request(['search']))->latest()->paginate($limit)->appends(request()->all());
        
        return view('dashboard.admin.categories.index', [
            "title" => "Category Themes",
            "categories" => $categories,
            "limit" => $limit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.categories.create', [
            "title" => "Create Category Theme",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        # Validasi form input dengan StoreCategoryRequest.
        $dataValid = $request->validated();

        # Menyimpan data valid ke model Category.
        Category::create($dataValid);

        # Mengalihkan ke halaman menu admin category-themes dengan success massage.
        return redirect('/admin/category-themes')->with('success', 'Data Category Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.admin.categories.edit', [
            "title" => "Edit Category Theme",
            "category" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        # Validasi Data dengan UpdateCategoryRequest.
        $dataValid = $request->validated();

        # Update data model category dengan dataValid.
        Category::where('id', $category->id)->update($dataValid);

        # Mengalihkan ke halaman menu admin category-themes dengan success massage.
        return redirect('/admin/category-themes')->with('success', 'Data Category Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        # Delete data model Category.
        Category::destroy($category->id);

        # Mengalihkan ke halaman Admin menu category-themes dengan success massage.
        return redirect('/admin/category-themes')->with('success', 'Data Category Berhasil Dihapus');
    }
}
