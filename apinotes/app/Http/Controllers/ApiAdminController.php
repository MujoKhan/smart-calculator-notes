<?php

namespace App\Http\Controllers;

use App\Models\ApiAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $valid = $request->validate([
            
            'email'=> 'required|email|exists:api_admins,email',
            'password' => ['required','min:6','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
        ],[
            'password.regex'=>'Password must be 1 capital, 1 small and 1 digit',
            'email.exists'=>'Email is not exists',
        ]);

        $admin = ApiAdmin::where('email',$request->email)->get();
        foreach($admin as $data)
        {
            session()->put('count',Hash::check($request['password'],$data->password));
        }
        
        

        if(($admin->count() == 1))
        {
           if((session()->get('count') == 1))
           {
                if (Auth::guard('apiadmin')->attempt($request->only('email','password')))
                {
                    return redirect()->route('admin.home');
                }
           }
           else
           {
            return redirect()->back()->with('status','Wrong password');
           }           
        }
        else
        {
            return redirect()->back()->with('status','Dear admin, Super admin not allow you');
        }    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApiAdmin  $apiAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(ApiAdmin $apiAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApiAdmin  $apiAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiAdmin $apiAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApiAdmin  $apiAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiAdmin $apiAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApiAdmin  $apiAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiAdmin $apiAdmin)
    {
        //
    }
}
