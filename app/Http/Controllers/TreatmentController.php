<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stylist;
use App\Treatment;

class TreatmentController extends Controller
{
    public function index(){
        
        // get currently logged user
        $user_id=auth()->id();

        //check if it is a Stylist
        $stylist_id=Stylist::findOrFail($user_id)->id;

        //select treatment of the Stylist
        $treatments = Treatment::where('stylist_id', $stylist_id)->get();

        return view('treatment.index',compact(['treatments','stylist_id']));
    }
}
