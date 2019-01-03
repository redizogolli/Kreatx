<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Employee;
use App\Message;

class ChatController extends Controller
{
    //
    public function show() // Conversations
    {
       // $friends=Message::where('user_from','=',session('username'))->orWhere('user_to','=',session('username'))->get();
       $sent=Message::where('user_from','=',session('username'))->get(['user_to']);
       $rec=Message::where('user_to','=',session('username'))->get(['user_from']);
        //return $rec;
        $users=User::whereIn('username',$sent)->orWhereIn('username',$rec)->get();
        //return $users;
        $html='<ul class="contacts-list">';
    

                foreach($users as $user)
                {
                    if($user->username==session('username')){continue;}
                    $username=$user->username;
                    $msg=Message::where(function ($query) use ($username) {
                        $query->where('user_from', '=', session('username'))
                              ->where('user_to', '=', $username);
                    })->orWhere(function ($query) use ($username) {
                        $query->where('user_from', '=', $username)
                              ->where('user_to', '=',session('username'));
                    })->orderBy('Id', 'DESC')->first();

                   //return $msg;
                    if(isset($msg['Id'])&& $msg['Id']!=null)
                    {
                        $data=$msg['insert_time'];
                        $lastmsg=$msg['message'];
                        //return $lastmsg;
                    }
                    else
                    {
                        $data='';
                        $lastmsg='';
                    }
                    
                    if($user->role==1) //admin
                    {
                        $html.='<li id='.$user->username.' class="kont">';
                        $html.='<a href="#" >';
                        $html.='<img class="contacts-list-img" src="avatars/avatar5.png" alt="User Image">';

                        $html.='<div class="contacts-list-info">';
                        $html.='<span class="contacts-list-name">';
                        $html.=$user->username;
                        $html.='<small class="contacts-list-date pull-right">'.$data.'</small>';
                        $html.='</span>';
                        $html.='<span class="contacts-list-msg">'.$lastmsg.'</span>';
                        $html.='</div>';
                       // <!-- /.contacts-list-info -->
                       $html.='</a>';
                       $html.='</li>';
                    }
                    else
                    {
                        $employee=Employee::where('username','=',$user->username)->first();
                        if($employee['photo']!=null){$src="avatars/".$employee['photo'];}else{$src="avatars/avatar5.png";}

                        $html.='<li class="kont" id='.$user->username.'>';
                        $html.='<a href="#" >';
                        $html.='<img class="contacts-list-img" src='.$src.' alt="User Image">';

                        $html.='<div class="contacts-list-info">';
                        $html.='<span class="contacts-list-name">';
                        $html.=$employee['name'].'  '.$employee['surname'];
                        $html.='<small class="contacts-list-date pull-right">'.$data.'</small>';
                        $html.='</span>';
                        $html.='<span class="contacts-list-msg">'.$lastmsg.'</span>';
                        $html.='</div>';
                       // <!-- /.contacts-list-info -->
                       $html.='</a>';
                       $html.='</li>';
                    }
                }
                $html.='</ul>';
         return $html;
    }
    

    public function Contacts()
    {
        $sent=Message::where('user_from','=',session('username'))->get(['user_to']);
        $rec=Message::where('user_to','=',session('username'))->get(['user_from']);
         //return $rec;
         $users=User::whereNotIn('username',$sent)->whereNotIn('username',$rec)->get();
         //return $users;
         $html='<ul class="contacts-list">';
     
 
                 foreach($users as $user)
                 {
                     if($user->username==session('username')){continue;}
                     $username=$user->username;
                     $msg=Message::where(function ($query) use ($username) {
                         $query->where('user_from', '=', session('username'))
                               ->where('user_to', '=', $username);
                     })->orWhere(function ($query) use ($username) {
                         $query->where('user_from', '=', $username)
                               ->where('user_to', '=',session('username'));
                     })->orderBy('Id', 'DESC')->first();
 
                    //return $msg;
                     if(isset($msg['Id'])&& $msg['Id']!=null)
                     {
                         $data=$msg['insert_time'];
                         $lastmsg=$msg['message'];
                         //return $lastmsg;
                     }
                     else
                     {
                         $data='';
                         $lastmsg='';
                     }
                     
                     if($user->role==1) //admin
                     {
                         $html.='<li id='.$user->username.' class="kont">';
                         $html.='<a href="#" >';
                         $html.='<img class="contacts-list-img" src="avatars/avatar5.png" alt="User Image">';
 
                         $html.='<div class="contacts-list-info">';
                         $html.='<span class="contacts-list-name">';
                         $html.=$user->username;
                         $html.='<small class="contacts-list-date pull-right">'.$data.'</small>';
                         $html.='</span>';
                         $html.='<span class="contacts-list-msg">'.$lastmsg.'</span>';
                         $html.='</div>';
                        // <!-- /.contacts-list-info -->
                        $html.='</a>';
                        $html.='</li>';
                     }
                     else
                     {
                         $employee=Employee::where('username','=',$user->username)->first();
                         if($employee['photo']!=null){$src="avatars/".$employee['photo'];}else{$src="avatars/avatar5.png";}
 
                         $html.='<li class="kont" id='.$user->username.'>';
                         $html.='<a href="#" >';
                         $html.='<img class="contacts-list-img" src='.$src.' alt="User Image">';
 
                         $html.='<div class="contacts-list-info">';
                         $html.='<span class="contacts-list-name">';
                         $html.=$employee['name'].'  '.$employee['surname'];
                         $html.='<small class="contacts-list-date pull-right">'.$data.'</small>';
                         $html.='</span>';
                         $html.='<span class="contacts-list-msg">'.$lastmsg.'</span>';
                         $html.='</div>';
                        // <!-- /.contacts-list-info -->
                        $html.='</a>';
                        $html.='</li>';
                     }
                 }
                 $html.='</ul>';
          return $html;
    }

}