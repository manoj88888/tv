<?php

namespace App\Http\Controllers;

use App\SocialIcon;
use Illuminate\Http\Request;

class SocialIconController extends Controller
{
    public function get()
    {
        $si = SocialIcon::first();
        return view('admin.landing-page.si', compact('si'));
    }

    public function post(Request $request)
    {
        $si = SocialIcon::first();

        $input = $request->all();

        $si->update($input);
        return back()->with('updated', 'Social Icon url has been updated !');
    }
}
