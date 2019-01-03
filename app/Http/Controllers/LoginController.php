<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
     public function showLogin()
     {
        // show the form
       return view('login');
     }

    
    
     public function doLogin(Request $request)
     {
        // process the form
        // validate the info, create rules for the inputs
        // $rules = array(
        //     'username'    => 'required|max:50', // make sure the email is an actual email
        //     'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        // );
        $validator = \Validator::make($request->all(), [
            'username' => 'required|max:50',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return redirect('login')
                        ->withErrors($validator)
                        ->withInput();
        }
         // create our user data for the authentication
        $userdata = array(
            'username'     => Input::get('username'),
            'password'  => Input::get('password')
        );
        
         // attempt to do the login
        //  $user=User::find(Input::get('username'));
        //  if($user==null)
        //  {
        //     \Redirect::back()->withErrors(['Invalid Username Or Password', 'Please try again']);
        //     return \Redirect::to('login');
        //  }
        // return bcrypt($userdata['password']);
         //return $user->password;
         //if(Hash::check($userdata['password'],$user->password)){
          
            
        //if(password_verify($userdata['password'],$user->password)){
        //if($userdata['password']==$user->password){
        if (\Auth::attempt($userdata)) {

            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)
            // echo 'SUCCESS!';
            session(['username' => $userdata['username']]);
            if (\Auth::user()->role == '1') {
            // if ($user->role == '1') {
                //return "/admin";
                session(['role' => 'admin']);
                return redirect()->route('dashboard');
                //return redirect()->action('UserController@showHomePage');
            }   
                session(['role' => 'user']);
                return redirect()->route('home');
        } 
        else {        

            // validation not successful, send back to form 
            //print_r ($userdata);
            //return \Redirect::to('login');
            \Redirect::back()->withErrors(['Invalid Username Or Password', 'Please try again']);
            return \Redirect::to('login');

        }
     }

     public function doLogout()
    {
        session()->flush(); // destroy sessions
        \Auth::logout(); // log the user out of our application  \para Auth eshte vendosur to let PHP know to load it from the global namespace.
        return \Redirect::to('login'); // redirect the user to the login screen
    }
}
