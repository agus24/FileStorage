<?php

namespace App\Http\Controllers;

use App\User;
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
        $files = $this->getFiles($email);

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
        if(!Auth::user()->hasRole('superuser')) {
            return redirect("/");
        }

        $files = $this->getFiles($email);

        return view('home', compact('files'));
    }

    public function assignRole($id)
    {
        if(!Auth::user()->hasRole('superuser')) {
            return redirect("/");
        }
        $user = User::find($id);
        $user->assignRole('superuser');
        return redirect()->back();
    }

    public function revokeRole($id)
    {
        if(!Auth::user()->hasRole('revoke')) {
            abort(403);
        }
        $user = User::find($id);
        $user->removeRole('superuser');
        return redirect()->back();
    }

    private function getFiles($email)
    {
        $files = collect(Storage::files($email));
        $files = $files->map(function($value, $key) use($email) {
            return explode($email."/", $value)[1];
        })->sort()->toArray();
        return $files;
    }
}
