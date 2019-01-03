<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Storage;
use App\Employee;

class UserController extends Controller
{
    public function showHomePage()
     {
       if(session('username')!=null)
       {
          if (session('role')== 'user') { 
            // show the form
            $userinfo = DB::table('employees')->where('username',session('username'))->first();
            //print_r($userinfo);
            //return view('home');
            return View('home')->with('userinfo', $userinfo)->with('home', \Auth::user());
          }
          return \Redirect::to('dashboard'); //admini
       }
        return \Redirect::to('login');
     }

     public function updateData(Request $request)
     {
       
       //Storage::putFileAs('photos', new File('../vendor/dist/img'), $_POST['upload']);
       //$contents = Storage::get($_POST['upload']);

       if(isset($request->upload))
       {
        $photoName = time().'.'.$request->upload->getClientOriginalExtension();

        /*
        talk the select file and move it public directory and make avatars
        folder if doesn't exsit then give it that unique name.
        */
        $request->upload->move(public_path('/avatars'), $photoName);
        //update ne tabelen
        $updateDetails=array(
          'name' => $request->name,
          'surname' => $request->surname,
          'address' => $request->address,
          'photo' => $photoName
        );
        
       }

      else
      {
        //$photoName=$data['photo'];
         //update ne tabelen
         $updateDetails=array(
          'name' => $request->name,
          'surname' => $request->surname,
          'address' => $request->address,
        );
           
      }
      DB::table('employees')
          ->where('username', session('username'))
            ->update($updateDetails);
       //print_r ($request->surname);
       //print_r ($request->address);
       return \Redirect::to('home');
     }
}
