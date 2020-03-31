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

    public function remove(Request $request){
        return 'return from stylist remove';
    }

    public function create(){
        return view('stylist/create');
    }

    public function store(Request $request){
        return 'return from stylist store';
    }
}
