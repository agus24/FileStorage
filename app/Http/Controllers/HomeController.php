<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = Auth::user()->email;
        $files = collect(Storage::files($email));
        $files = $files->map(function($value, $key) use($email) {
            return explode($email."/", $value)[1];
        })->toArray();

        return view('home', compact('files'));
    }

    public function download(Request $request ,$file)
    {
        $email = Auth::user()->email;
        return Storage::download("$email/$file");
    }

    public function upload(Request $request)
    {
        $email = Auth::user()->email;
        $file = $request->file('upload_item')
                        ->storeAs($email, $request->file('upload_item')->getClientOriginalName());
        return redirect()->back();
    }

    public function files($email)
    {
        if(!Auth::user()->hasRole('superuser'))
        {
            abort(403);
        }

        $files = collect(Storage::files($email));
        $files = $files->map(function($value, $key) use($email) {
            return explode($email."/", $value)[1];
        })->toArray();

        return view('home', compact('files'));
    }
}
