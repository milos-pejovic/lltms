<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PagesController extends Controller
{
    /**
     *
     * @var type 
     */
    private $validationRules = [
        'name' => ['required', 'min:2'],
        'phone' => ['required', 'regex:/[0-9\s-\/]/mi'],
        'email' => ['required', 'email'],
        // Validate date and tome using regexp validation rules
        'time' => ['required'],
        'date' => ['required']
    ];
    
    /**
     * 
     * @return type
     */
    public function RegisterEventForm() {
        return view('form');
    }
    
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function RegisterEvent(Request $request) {
        $request->flashOnly(['name', 'phone', 'email', 'time', 'date']);
        $this->validate(request(), $this->validationRules);
        
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        /* Combine time and date, possibly using Carbon library. */
        $data['start-time'] = $request->time . ' ' . $request->date; 
        $data['note'] = $request->note;
        
        return \Redirect::route('cal')->with( ['data' => $data] );
    }
}
