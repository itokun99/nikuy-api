<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserPreneur;

class BisnisMemberController extends Controller
{
    public function index_page()
    {
        $busines = UserPreneur::with(['user'])->paginate(10);
        return view('admin.pages.member.bisnis.index')->with(["userbisnis" => $busines]);
    }


    public function detail_page($id)
    {
        $bisnis = UserPreneur::with(['user', 'province'])->find($id);
        if (!$bisnis) {
            return abort(404);
        }

        return view('admin.pages.member.bisnis.detail', [
            'userbisnis' => $bisnis,
        ]);
    }
}
