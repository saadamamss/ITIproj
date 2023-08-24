<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class GalleryController extends Controller
{
    public function index()
    {

        $galleries = DB::table('galleries')->orderBy('id', 'DESC')->paginate(12);

        return view('admin.pages.gallery')->with(['galleries' => $galleries]);

    }
    public function getfiles($dir)
    {
        $dirs = Storage::disk('upload')->directories();

        if (in_array($dir, $dirs)) {
            $files = Storage::disk('upload')->files($dir);
        } else {
        }
        return view('admin.pages.gallery')->with(['files' => $files]);
    }
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'nullable|string',
            'folding' => 'required|string',
            'head' => 'required|string',
            'paragraph' => 'required|string',
            'image' => 'required|image'
        ]);


        try {
            if (!$request->title) {
                $title = NULL;
            } else {
                $title = $request->title;
            }

            $imgName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs($request->folding, $imgName, 'upload');

            $gallery = new Gallery;
            $gallery->title = $title;
            $gallery->head = $request->head;
            $gallery->paragraph = $request->paragraph;
            $gallery->path =  'assets/imgs/' . $request->folding;
            $gallery->image = $imgName;

            $gallery->save();

            return redirect()->route('gallery.index');
        } catch (\Throwable $th) {
            return false;
        }
    }
    public function edit()
    {
    }
    public function update(Request $request)
    {
        $request->validate([
            'gallery_id' => 'required|numeric',
            'title' => 'nullable|string',
            'head' => 'required|string',
            'paragraph' => 'required|string',
            'folding' => 'required|string',
            'image' => 'nullable|image'
        ]);


        try {
            $gallery = Gallery::findOrFail($request->gallery_id);

            if (!$request->title) {
                $title = NULL;
            } else {
                $title = $request->title;
            }

            $gallery->title = $title;
            $gallery->head = $request->head;
            $gallery->paragraph = $request->paragraph;
            $gallery->path =  'assets/imgs/' . $request->folding;

            if ($request->file('image')) {
                $imgName = $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs($request->folding, $imgName, 'upload');
                $gallery->image = $imgName;
            }


            $gallery->save();


            return redirect()->route('gallery.index');
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('delete') && $request->ajax()) {
            $request->validate([
                'id' => 'required|numeric'
            ]);

            try {
                $gallery = Gallery::findOrFail($request->input('id'));
                $file = $gallery->path . '/' . $gallery->image;


                if (Storage::disk('assets')->exists($file)) {
                    Storage::disk('assets')->delete($file);
                }

                $gallery->delete();

                return response()->json(true);
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(false);
            }
        }
    }
    public function multidestroy(Request $request)
    {
        if ($request->isMethod('delete') && $request->ajax()) {
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'numeric'
            ]);

            try {
                foreach ($request->ids as $key => $value) {

                    $gallery = Gallery::findOrFail($value);
                    $file = $gallery->path . '/' . $gallery->image;

                    if (Storage::disk('assets')->exists($file)) {
                        Storage::disk('assets')->delete($file);
                    }

                    $gallery->delete();
                }

                return response()->json(true);
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(false);
            }
        }
    }
}
