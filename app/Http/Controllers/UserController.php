<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index()
    {	
       $users = User::all();
       return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   	//User::create($request->all());

    	if(trim($request->password) == '') {
    		$input = $request->except('password');
    	} else {
    		$input = $request->all();
    		$input['password']=bcrypt($request->password);
    	}
   
    	$input['password'] = bcrypt($request->password);
		
			$input=array_filter($input);
		
    	User::create($input);
  	
    	return redirect('user/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user) {
    		$user = User::findOrFail($user);
    		
		//	$request_only = $request->all();
		//	$requests_without_null_fields =  array_filter($request_only);
	

	
    		if(trim($request->password) == '') {
	    		$input = $request->except('password');
	    	} else {
	    		if($request->password==$request->password_confirmation) {
	    		$input = $request->all();
	    		$input['password']=bcrypt($request->password);	    			
	    		}

	    	}
    		
    	$input=array_filter($input);
    	$user->name=$input['name'];
    	$user->email=$input['email'];
    	$user->password=$input['password'];
    	$user->save();
    	return redirect('user/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
