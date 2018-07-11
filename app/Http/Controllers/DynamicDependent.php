<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\State;

class DynamicDependent extends Controller
{
    function index()
    {
     
    // $state_list = DB::table('states')
      //   ->distinct()->select('State')->orderBy('State')
      //   ->get();
    //dd($country_list);
      $state_list =State::distinct()->select('State')->orderBy('State') 
      ->get();
     return view('dynamic_dependent')->with('state_list', $state_list);
    
    }

    function fetch(Request $request)
    {
     /*$select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');
     $data = DB::table('State')
       ->where($select, $value)
       ->groupBy($dependent)
       ->get();
     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
     }
     echo $output;
     */
    $state =$request->get('state');
    $state_list = State::where('State',$state)->select('LGA')->orderBy('LGA')->get();
    //echo $state_list;
    return response()->json($state_list);
   
    }
}

