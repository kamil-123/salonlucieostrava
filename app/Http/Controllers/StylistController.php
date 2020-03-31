<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Stylist;
use App\User;

class StylistController extends Controller
{
    public function index(){
        $stylists = Stylist::all();

        return view('stylist/index',compact('stylists'));
    }

    public function edit($id){
        return 'return from stylist edit';
    }

    public function remove(Request $request){
        $stylist = Stylist::findOrFail($request->input('stylist_id'));
        $user = User::findOrFail($stylist->user_id);
        $stylist->delete();
        $user->delete();

        session()->flash('success_message', 'Stylist successfully deleted');
        return redirect(action('StylistController@index'));
    }

    public function create(){
        return view('stylist/create');
    }

    public function store(Request $request){
        $this->validate($request, [             //comment validation
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone'=> 'required|integer',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'photo' => 'required|max:255',
            'job' => 'required|max:255',
            'service' => 'required|max:255',
            'introduction' => 'required|max:255',
            ]);
        
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
            ]);
        
        $stylist = Stylist::create([
            'user_id' => $user->id,
            'profile_photo_url' => $request->input('photo'),
            'job_title' => $request->input('job'),
            'service' => $request->input('service'),
            'introduction' => $request->input('introduction'),
        ]);

        return redirect(action('StylistController@index'));
    }
}
