<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index(): View
    {

        $reviews = Review::get();
        return view('admin.pages.reviews')->with(['reviews' => $reviews]);
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('delete') && $request->ajax()) {
            try {
                Review::findOrFail($request->id)->delete();

                return response()->json(true);
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json(false);
            }
        }
    }
}
