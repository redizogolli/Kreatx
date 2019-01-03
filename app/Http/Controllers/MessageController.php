<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Message;

class MessageController extends Controller
{
    //Chat i pergjithshem
public function show(Request $request)
{
//         //echo "Ok";
            
            $username=$request->user;
            $texts=Message::where(function ($query) use ($username) {
                    $query->where('user_from', '=', session('username'))
                        ->where('user_to', '=', $username);
                        })->orWhere(function ($query) use ($username) {
                            $query->where('user_from', '=', $username)
                                ->where('user_to', '=',session('username'));
                        })->orderBy('Id', 'ASC')->get();
            //return $msg;
            $html="";
               foreach($texts as $text)
                {
                    $photo_from=Employee::where('username','=', $text->user_from)->select('photo')->first();
                    $photo_to=Employee::where('username','=', $text->user_to)->select('photo')->first();
                    
                    if(isset($photo_from['photo'])&& $photo_from['photo']!=null)
                     {
                        
                        $src_from="avatars/".$photo_from['photo'];
                      }
                     else{
                      $src_from="avatars/avatar5.png";
                       
                     }
                     if(isset($photo_to['photo'])&& $photo_to['photo']!=null)
                     {
                        
                        $src_to="avatars/".$photo_to['photo'];
                      }
                     else{
                      $src="avatars/avatar5.png";
                       
                     }
                   
                     if($text->user_from==session('username'))
                    {
                        //<!-- Message to the right -->
                         $html.='<div class="direct-chat-msg right">';
                         $html.='<div class="direct-chat-info clearfix">';
                         $html.='<span class="direct-chat-name pull-right">'.$text->user_from.'</span>';
                         $html.='<span class="direct-chat-timestamp pull-left">'.date('H:i', strtotime($text->insert_time)).'</span>';
                         $html.='</div>';
//                          // <!-- /.direct-chat-info -->
                       

                          $html.='<img class="direct-chat-img" src='.$src_from.' alt="Message User Image">';//<!-- /.direct-chat-img -->
                          $html.='<div class="direct-chat-text">';
                          $html.=$text->message;
                          $html.='</div>';
                          // <!-- /.direct-chat-text -->
                          $html.='</div>';
//                         //<!-- /.direct-chat-msg -->
                     }
                     else
                     {
                         $html.='<div class="direct-chat-msg">';
                         $html.='<div class="direct-chat-info clearfix">';
                         $html.='<span class="direct-chat-name pull-left">'.$text->user_from.'</span>';
                         $html.='<span class="direct-chat-timestamp pull-right">'.date('H:i', strtotime($text->insert_time)).'</span>';
                         $html.='</div>';
                         //<!-- /.direct-chat-info -->
                         if($text->user_from!=session('username'))
                         {
                            $html.='<img class="direct-chat-img" src='.$src_from.' alt="Message User Image">';//<!-- /.direct-chat-img -->
                         }
                         else
                         {
                            $html.='<img class="direct-chat-img" src='.$src_to.' alt="Message User Image">';//<!-- /.direct-chat-img -->
                         }
                         $html.='<div class="direct-chat-text">';
                         $html.=$text->message;
                         $html.='</div>';
//                         //<!-- /.direct-chat-text -->
                         $html.='</div>';
//                         //<!-- /.direct-chat-msg -->

                        
                     }
                 }

          return $html;
     }


     public function store(Request $request)
     {
         $message = new Message;
         $message->user_from=session('username');
         $message->user_to=$request->user_to;
         $message->message=$request->msg;
         $message->save();
     }
}






//Chat i pergjithshem
// public function show()
//     {
//         //echo "Ok";
//         $texts=Chat::all();
//         $html="";
        
//                 foreach($texts as $text)
//                 {
//                     $photo=Employee::where('username','=', $text->username)->select('photo')->first();
                   
//                     if(isset($photo['photo'])&& $photo['photo']!=null)
//                     {
                        
//                         $src="avatars/".$photo['photo'];
//                      }
//                     else{
//                        $src="avatars/avatar5.png";
                       
//                     }
                     
//                     if($text->username==session('username'))
//                     {
//                         //<!-- Message to the right -->
//                         $html.='<div class="direct-chat-msg right">';
//                         $html.='<div class="direct-chat-info clearfix">';
//                         $html.='<span class="direct-chat-name pull-right">'.$text->username.'</span>';
//                         $html.='<span class="direct-chat-timestamp pull-left">'.date('H:i', strtotime($text->insertime)).'</span>';
//                         $html.='</div>';
//                          // <!-- /.direct-chat-info -->
                       

//                          $html.='<img class="direct-chat-img" src='.$src.' alt="Message User Image">';//<!-- /.direct-chat-img -->
//                          $html.='<div class="direct-chat-text">';
//                          $html.=$text->comment;
//                          $html.='</div>';
//                          // <!-- /.direct-chat-text -->
//                          $html.='</div>';
//                         //<!-- /.direct-chat-msg -->
//                     }
//                     else
//                     {
//                         $html.='<div class="direct-chat-msg">';
//                         $html.='<div class="direct-chat-info clearfix">';
//                         $html.='<span class="direct-chat-name pull-left">'.$text->username.'</span>';
//                         $html.='<span class="direct-chat-timestamp pull-right">'.$text->insertime.'</span>';
//                         $html.='</div>';
//                         //<!-- /.direct-chat-info -->
//                         $html.='<img class="direct-chat-img" src='.$src.' alt="Message User Image">';//<!-- /.direct-chat-img -->
//                         $html.='<div class="direct-chat-text">';
//                         $html.=$text->comment;
//                         $html.='</div>';
//                         //<!-- /.direct-chat-text -->
//                         $html.='</div>';
//                         //<!-- /.direct-chat-msg -->

                        
//                     }
//                 }

//          return $html;
//     }
    



