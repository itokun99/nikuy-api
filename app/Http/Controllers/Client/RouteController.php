<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function homepage()
    {
        return view('web.pages.homepage.index');
    }

    public function profile()
    {
        return view('web.pages.profile.index');
    }

    public function business()
    {
        return view('web.pages.business.index');
    }

    public function business_add()
    {
        return view('web.pages.business.index');
    }

    public function event()
    {
        return view('web.pages.event.index');
    }

    public function course()
    {
        return view('web.pages.course.index');
    }

    public function course_detail($id)
    {
        return view('web.pages.course.detail');
    }

    public function forum()
    {
        return view('web.pages.forum.index');
    }

    public function community()
    {
        return view('web.pages.community.index');
    }

    public function membership()
    {
        return view('web.pages.membership.index');
    }

    public function membership_upgrade($id)
    {
        return view('web.pages.membership.upgrade.index');
    }

    public function main()
    {
        return view('web.pages.main.index');
    }
}
