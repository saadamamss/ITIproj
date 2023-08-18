<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{

    public function index()
    {

        $subcatgs = Subcategory::get();
        $catgs = Category::get();

        return view("admin.pages.subcategories")->with(['subcatgs' => $subcatgs, 'catgs' => $catgs]);
    }

    public function addCategory(Request $request)
    {
        if ($request->isMethod('post') && $request->ajax()) {
            $request->validate([
                'name' => 'required|string|max:60',
                'category' => 'required|numeric'
            ]);

            $catg = new Subcategory();

            $catg->name = $request->name;
            $catg->slug = Str::slug($request->name);
            $catg->cat_id = $request->category;

            try {
                $catg->save();
                return response()->json(true);
            } catch (\Throwable $th) {
                return response()->json(false);
            }
        }
    }

    public function editCategory(Request $request)
    {
        if ($request->isMethod('post') && $request->ajax()) {
            $request->validate(
                [
                    'category_id' => 'required|numeric',
                    'name' => 'required|string|max:60',
                    'category' => 'required|numeric'
                ]
            );

            try {
                $catg = Subcategory::findOrFail($request->category_id);

                $catg->name = $request->name;
                $catg->slug = Str::slug($request->name);
                $catg->cat_id = $request->category;

                $catg->save();
                return response()->json(true);
            } catch (\Throwable $th) {
                return response()->json(false);
            }
        }
    }

    public function delCategory(Request $request)
    {
        if ($request->isMethod('delete') && $request->ajax()) {
            $request->validate([
                'id' => "required|numeric"
            ]);

            try {

                Subcategory::findOrFail($request->input('id'))->delete();

                return response()->json(true);
            } catch (\Throwable $th) {
                return response()->json(false);
            }
        }
    }
}
