<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    //
    public function index_page()
    {
        $rating = Rating::with(['kelas', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.pages.rating.index')->with([
            "ratingkelas" => $rating
        ]);
    }

    public function detail_page($id)
    {

        $rating = Rating::with(['kelas', 'user'])->find($id);

        if (!$rating) {
            return abort(404);
        }

        return view('admin.pages.rating.detail', [
            'rating' => $rating
        ]);
    }
}
