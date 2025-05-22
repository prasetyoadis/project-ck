<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard.admin.categories.index', [
            "title" => "Category Themes",
            "categories" => Category::latest()->paginate(5)->appends(request()->all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.admin.categories.create', [
            "title" => "Create Category Theme",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataValid = $request->validate([
            'nama_category' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories',
        ]);

        Category::create($dataValid);

        return redirect('/admin/category-themes')->with('success', 'Data Category Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('dashboard.admin.categories.edit', [
            "title" => "Edit Category Theme",
            "category" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
         //make rules when slug is diferent
         if ($request->slug != $category->slug) {
            $dataRules['nama_category'] = 'required|min:3|max:255';
            $dataRules['slug'] = 'required|min:3|max:255|unique:categories';
        }

        //Validasi Data dengan dataRules
        $dataValid = $request->validate($dataRules);

        Category::where('id', $category->id)->update($dataValid);

        return redirect('/admin/category-themes')->with('success', 'Data Category Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        Category::destroy($category->id);

        return redirect('/admin/category-themes')->with('success', 'Data Category Berhasil Dihapus');
    }
}
