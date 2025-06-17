<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        # Set limit value from request or default is 5.
        $limit = $request->input('limit', 5);

        return view('dashboard.admin.tags.index', [
            "title" => "Tag Themes",
            "tags" => Tag::filter(request(['search']))->latest()->paginate($limit)->appends(request()->all()),
            "limit" => $limit,
        ]);
    }

    public function getTags(Request $request)
    {
        # Buat var tags type of array.
        $tags=[];
        # Set var search dengan data input 'nama_tag'.
        $search = $request->nama_tag;

        # Kalau search is not empty.
        if ($search) {
            # Set array tags dengan data model Tags dimana 'nama_tag' seperti search.
            $tags = Tag::where('nama_tag', 'LIKE', "%$search%")->get();
        }

        # return json responses dengan array tags.
        return response()->json($tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin.tags.create', [
            "title" => "Create Tag Theme",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validasi form input.
        $dataValid = $request->validate([
            'nama_tag' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:tags',
        ]);

        # Menyimpan dataValid ke model Tag.
        Tag::create($dataValid);
        
        # Mengalihkan ke halaman admin menu tag-thames dengan success massage.
        return redirect('/admin/tag-themes')->with('success', 'Data Tag Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('dashboard.admin.tags.edit', [
            "title" => "Edit Tag Theme",
            "tag" => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        # Make rules when slug is diferent
        if ($request->slug != $tag->slug) {
            $dataRules['nama_tag'] = 'required|min:3|max:255';
            $dataRules['slug'] = 'required|min:3|max:255|unique:tags';
        }
        # Validasi form input dengan dataRules.
        $dataValid = $request->validate($dataRules);

        # Update data model Tag dengan dataValid.
        Tag::where('id', $tag->id)->update($dataValid);

        # Mengalihkan ke halaman admin menu tag-thames dengan success massage.
        return redirect('/admin/tag-themes')->with('success', 'Data Tag Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        # Delete data from model Tag.
        Tag::destroy($tag->id);

        # Mengalihkan ke halaman admin menu tag-thames dengan success massage.
        return redirect('/admin/tag-themes')->with('success', 'Data Tag Berhasil Dihapus');
    }
}
