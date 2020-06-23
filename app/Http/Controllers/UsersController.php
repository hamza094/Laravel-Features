<?php

namespace App\Http\Controllers;

use Request;

use Illuminate\Support\Facades\Hash;

use App\User;

use Session;

use Auth;

use Illuminate\Support\Facades\Input;

 use Validator;



class UsersController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('users.index',compact('users'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users=User::find($id);
        return view('users.profile')->with('user',$users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile=Auth::user()->find($id);
        return view('users.edit')->with('user',$profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     $user = Auth::user();
    
    $user->name = Request::input('name');
    $user->email = Request::input('email');
    $user->img = Request::input('img');


    if ( ! Request::input('password') == '')
    {
        $user->password = bcrypt(Request::input('password'));
    }

    $user->save();



        
        Session::flash('success','Your profile updated successfully');
        return redirect()->route('users.show',['id'=>$user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        Session::flash('info','Profile Deleted successfully');
        return redirect()->route('welcome');
    }
    
    public function admin($id){
        $user=User::find($id);
        $user->admin=1;
        $user->save();
        Session::flash('success','User role changed to admin');
        return redirect()->back(); 
    }
    
    public function unadmin($id){
         $user=User::find($id);
        $user->admin=0;
        $user->save();
        Session::flash('info','User admin role reverted');
        return redirect()->back();
    }
    
}
