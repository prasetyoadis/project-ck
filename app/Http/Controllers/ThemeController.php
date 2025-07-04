<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Theme;
use App\Models\Category;
use App\Models\Undangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        //set limit value from request or default is 5
        $limit = $request->input('limit', 5);

        return view('dashboard.admin.themes.index', [
            "title" => "Themes",
            "themes" => Theme::with(['tags', 'category'])->filter(request(['search', 'category', 'tag']))->latest()->paginate($limit)->appends(request()->all()),
            "limit" => $limit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.admin.themes.create', [
            "title" => "Add Themes",
            "categories" => Category::all(),
            "tags" => Tag::all()->pluck('nama_tag', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_tema' => 'required',
            'blade_file' => 'required|file',
            'slug' => 'required|unique:themes',
            'category_id' => 'required|not_in:"-- Pilih Kategori --',
            'tags' => 'required',
        ]);

        $file = $request->file('blade_file');
        // Validasi ekstensi harus .blade.php
        if ($request->file('blade_file')) {
            if (!str_ends_with($file->getClientOriginalName(), '.blade.php')) {
                $validator->getMessageBag()->add(
                    'blade_file', 'File harus berupa berkas berjenis: .blade.php'
                );
            }
        }
        if ($validator->errors()->any()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
 
        $category = Category::where('id', $request->category_id)->first();

        $file = $request->file('blade_file');
        //Jika Terdapat Request file blade.php
        if ($file) {
            $PATH_VIEWS = resource_path('views'). '/tema/'. $category->slug;
            
            // Simpan file jika semua valid
            $file->move($PATH_VIEWS, $request->slug. '.blade.php');
        }

        // Retrieve the validated input...
        $dataValid = $validator->validated();

        $dataTheme['category_id'] =  $dataValid['category_id'];
        $dataTheme['nama_tema'] =  $dataValid['nama_tema'];
        $dataTheme['slug'] =  $dataValid['slug'];
        $dataTheme['isactive'] =  "1";

        $theme = Theme::create($dataTheme);
        // $theme = Theme::firstWhere('slug', $request->slug);
        $theme->tags()->sync($request->input('tags', []));

        return redirect('/admin/themes')->with('success', 'Data Theme Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Theme $theme)
    {
        //
        $theme = Theme::with('category')->where('id', $theme->id)->first();
        $data = Undangan::with('couple')->where('id', '2')->first();

        // return $data;
        return view('dashboard.admin.themes.show', [
            "title" => "Preview Theme ". $theme->nama_tema,
            "undangan" => $data,
            "theme" => $theme,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        //
        $theme = Theme::with(['tags', 'category'])->where('id', $theme->id)->first();
        foreach ($theme->tags as $key => $value) {
            $oldtags[$key] = $value->id;
        }
        // return $oldtags;
        return view('dashboard.admin.themes.edit', [
            "title" => "Edit Theme",
            "theme" => $theme,
            "categories" => Category::all(),
            "tags" => Tag::all()->pluck('nama_tag', 'id'),
            "oldtags" => $oldtags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme)
    {
        //rules of form input
        $theme = Theme::with('category')->firstWhere('id', $theme->id);

        $rules = [
            'nama_tema' => 'required',
            'category_id' => 'required|not_in:"-- Pilih Kategori --',
            'tags' => 'required',
        ];
        if ($request->slug != $theme->slug) $rules['slug'] = 'required|unique:themes';
        if ($request->file('blade_file')) $rules['blade_file'] = 'required|file';

        $validator = Validator::make($request->all(), $rules);
        
        // Validasi ekstensi harus .blade.php
        if ($request->file('blade_file')) {
            if (!str_ends_with($request->file('blade_file')->getClientOriginalName(), '.blade.php')) {
                $validator->getMessageBag()->add(
                    'blade_file', 'File harus berupa berkas berjenis: .blade.php'
                );
            }
        }

        if ($validator->errors()->any()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //ambil kategori slug baru
        $category = Category::where('id', $request->category_id)->first();
        
        $PATH_OLD = resource_path('views'). '/tema/'. $theme->category->slug. '/';
        $old_name = $theme->slug. '.blade.php';

        $file = $request->file('blade_file');

        //Jika Terdapat Request file blade.php
        if ($file) {
            $category_now = ($request->category_id != $theme->category_id) ? $category->slug : $theme->category->slug;

            Storage::disk('public-web')->delete(resource_path('views'). '/tema/'. $theme->category->slug. '/'. $theme->slug. '.blade.php');
            // Simpan file jika semua valid
            $file->move(resource_path('views'). '/tema/'. $category_now. '/', $request->slug. '.blade.php');
        }else {
            //jika tidak ada file baru namun nama slug OR category diganti lakukan rename file.blade.php dengan new category OR slug
            if ($request->category_id != $theme->category_id || $request->slug != $theme->slug) {
                # code...
                $PATH_NEW = resource_path('views'). '/tema/'. $category->slug. '/';

                $new_name = $request->slug. '.blade.php';

                rename($PATH_OLD. $old_name, $PATH_NEW. $new_name);

            }
        }

        // Retrieve the validated input...
        $dataValid = $validator->validated();

        $dataTheme['category_id'] =  $dataValid['category_id'];
        $dataTheme['nama_tema'] =  $dataValid['nama_tema'];
        if ($request->slug != $theme->slug) $dataTheme['slug'] =  $dataValid['slug'];
        
        Theme::where('id', $theme->id)->update($dataTheme);
        if ($request->slug != $theme->slug) $theme = Theme::firstWhere('slug', $request->slug);

        $theme->tags()->sync($request->input('tags', []));
        
        //Redirect Halaman Admin Menu Themes dengan pesan success
        return redirect('/admin/themes')->with('success', 'Data Theme Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        //
    }
}
