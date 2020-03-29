<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stylist;

class StylistController extends Controller
{
    public function index(){
        $stylists = Stylist::all();

        return view('stylist/index',compact('stylists'));
    }

    public function edit($id){
        return 'return from stylist edit';
    }

    public function delete(Request $request){
        return 'return fro stylist delete';
    }
}
