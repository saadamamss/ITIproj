<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {


        $catgs = DB::table('categories')->get();

        return view("admin.pages.categories")->with(['categories' => $catgs]);
    }

    public function addCategory(Request $request)
    {
        if ($request->isMethod('post') && $request->ajax()) {
            $request->validate(['name' => 'required|string|max:60']);

            $catg = new Category();

            $catg->name = $request->name;
            $catg->slug = Str::slug($request->name);

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
                    'name' => 'required|string|max:60'

                ]
            );

            try {
                $catg = Category::findOrFail($request->category_id);

                $catg->name = $request->name;
                $catg->slug = Str::slug($request->name);

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

                Category::findOrFail($request->input('id'))->delete();

                return response()->json(true);
            } catch (\Throwable $th) {
                return response()->json(false);
            }
        }
    }
}
