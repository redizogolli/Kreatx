<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap 3.3.7 -->
      <!-- <link rel="stylesheet" type="text/css" href="../vendor/bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../vendor/bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" type="text/css" href="../vendor/bower_components/Ionicons/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" type="text/css" href="../vendor/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" type="text/css" href="../vendor/dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" href="http://demo.expertphp.in/css/jquery.treeview.css" />
      <link href="http://www.expertphp.in/css/bootstrap.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
      <!-- Google Font -->
      <link rel="stylesheet" type="text/css"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      <!-- jQuery 3 -->
      <script src="../vendor/bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <!-- <script src="../vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
      <!-- FastClick -->
      <!-- <script src="../vendor/plugins/fastclick/fastclick.min.js"></script> -->
      <!-- AdminLTE App -->
      <script src="../vendor/dist/js/adminlte.min.js"></script>
      <!-- SlimScroll -->
      <script src="../vendor/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
      <!-- <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script> -->
      <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
      <!-- <script src="docs.js"></script> -->
      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
      <link rel="stylesheet" type="text/css" href="css/main.css">
      <!-- <link rel="stylesheet" type="text/css" href="http://datatables.net/dev/editor-bootstrap/editor.bootstrap.css">
         <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
         <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
         <script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script> -->
      <link href="http://www.expertphp.in/css/bootstrap.css" rel="stylesheet">
      <link rel="stylesheet" href="http://demo.expertphp.in/css/jquery.treeview.css" />
      <script src="http://demo.expertphp.in/js/jquery.js"></script>   
      <script src="http://demo.expertphp.in/js/jquery-treeview.js"></script>
      <script type="text/javascript" src="http://demo.expertphp.in/js/demo.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

      <script>
         $(document).ready(function () {
             //$changeit=false;// per foton kur ta klikojme te ndryshohet vtm nqs eshte true,qe do behet kur te klikohet update
            
             $('#myform').submit(function() {
                 //alert($('#myform').attr('method'));
                  if($('$prevusername').val()!='')
                     {
                       $("#password").removeAttr('required');
                    }
                  else
                    {
                       $("#password").attr('required',true);
                    }
                    alert($('$prevusername').val());
                  
             });
           
         
              $('#cancel').click(function() {
                  //alert( "Handler for .click() called." );
                  FillDefault();
                  Disable();
              });
              $( "#roli" ).change(function() { //shfaq te dhenat e punonjesit
         
                 if($('#roli').find(":selected").text()=='Administrator')
                 {
                     $('#employee').css('display','none');
                     Disable();
                 }
                 else
                 {
                     $('#employee').css('display','block');
                     Enable();
                     
                 }
                 
             });
             
             Contacts('');
             $('#all_users').click(function() {
                  //alert("users");
                
                  Contacts('users');
              });
              $('#conversations').click(function() {
                //alert("convers");
                Contacts('');
             });
             // $('#employeetable').find('tr').click( function(){
             //     alert('You clicked row '+ ($(this).index()+1) );
             // });
             Chat();
         
              $('#employeetable tbody').on('click','.Update',function() {
                 $row=$(this).closest('tr');
                 $username=$row.find('td:eq(0)').text();
                 $ssn=$row.find('td:eq(1)').text();
                 $name=$row.find('td:eq(2)').text();
                 $surname=$row.find('td:eq(3)').text();
                 $address=$row.find('td:eq(4)').text();
                 $depid=$row.find('td:eq(5)').attr('id');
         
                 //$result = "username ="+ $usernname +"  ssn ="+ $ssn +"  name ="+ $name + "  surname ="+ $surname + "  address ="+ $address + "  depid ="+ $depid
         
                 $("#hiddenmethod").val('PUT');
                 $('#password').val('');
                 $('#prevusername').val($username);
                 $('#username').val($username);
                 $('#roli').val(2);//punonjes
                 $('#ssn').val($ssn);
                 $('#name').val($name);
                 $('#surname').val($surname);
                 $('#address').val($address);
                 $('#departament').val($depid);
                 $('#employee').css('display','block');
                 Enable();
                 //alert($('#myform').attr('method'));
                 //$('#username').val(this.id);
             });
         
             // $('.Update').click(function() {
             //     //FillDefault();
             //     $('#username').val(this.id);
             // });
                 // $('#press').click(function(){
                 //     //alert("button pressed");
                 //     $.ajaxSetup({
                 //         headers: {
                 //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 //         }
                 //     });
                 //     $.ajax({ url: '../public/chat',
                 //             type: 'POST',
                 //              success: function(output) {
                 //                          alert("ok");
                 //                      }
                 //     });
                 // });
         
              $('#ADD').click(function() {
                  $('#hiddenmethod').val('');
                  $('#employee').css('display','none');
                 Disable();
                 FillDefault();
             });
         
             $('#search').on("input", function() {
                 $search=this.value;
                //alert($search);
                $(location).attr('href', '../public/dashboard?user='+ $search);
             });
         
              
         });   
          
         
         function Disable(){
             
             $('#ssn').attr("readonly", true);
             $('#name').attr("readonly", true);
             $('#surname').attr("readonly", true);
             $('#address').attr("readonly", true);
         } 
         function Enable(){
             $('#ssn').attr("readonly", false);
             $('#name').attr("readonly", false);
             $('#surname').attr("readonly", false);
             $('#address').attr("readonly", false);
         } 
         function FillDefault(){
            
            $('#prevusername').val('');
            $('#username').val('');
            $('#password').val('');
            $('#ssn').val('');
            $('#name').val('');
            $('#surname').val('');
            $('#address').val('');
            //$('#photo').attr("src",$photo);
            $("#upload").val(""); 
         }
         
        function Contacts($type){
        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    if($type=="")
                    {
                        $.ajax({ url: '../public/conversations',
                            type: 'GET',
                             success: function(output) {
                                        
                                         $('#contacts').html(output);
                                         //$('#msgbody').animate({scrollTop: $('#msgbody')[0].scrollHeight}, "slow");
                                     }
                            });
                    }
                    else
                    {
                        $.ajax({ url: '../public/contacts',
                            type: 'GET',
                             success: function(output) {
                                        
                                         $('#contacts').html(output);
                                         //$('#msgbody').animate({scrollTop: $('#msgbody')[0].scrollHeight}, "slow");
                                     }
                            });
                    }
       } 
         
       function Chat(){
            $user=$('#user_to').val();
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                     $.ajax({ url: '../public/message',
                            data: {user:$user},
                            type: 'GET',
                              success: function(output) {
                                        $('#msgbody').html(output);
                //                         
                                        if($('#msgbody').text()=='' && $user!="")
                                        {
                                            $('#msgbody').text('Say Hi to  '+ $user);
                                            $('#user_to').val($user);
                                        }
                                        else if($('#msgbody').text()=='' && $user=="")
                                        {
                                            $('#msgbody').text('Start a conversation with somebody from the list');
                                        }
               
                    }
               });
        }
        function Send(){
           $msg=$('#msg').val();
           $user_to=$('#user_to').val();
          if($msg!="" && $user_to!="")
          {
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({ url: '../public/message',
                            data:{msg:$msg,user_to:$user_to},
                            type: 'POST',
                             success: function(output) {
                                        $('#msg').val('');
                                        Chat();
                                     }
                    });
          }
        }
         
         $(document).keyup(function(e)
         {
             if(e.keyCode==13)
             {
                 Send();
             }
         });
         $(document).on('click', '.kont', function(){
                $user=this.id;
                
                $('#msgbody').text('');
                $('#user_to').val($user);
                Chat();
                
        });
         
         setInterval(function(){ Chat(); }, 3000);
      </script>
   </head>
   <body class="skin-blue" data-spy="scroll" data-target="#scrollspy">
   <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                              <!-- <h2 class="page-header"><a href="#myprofile">MyProfile</a></h2> -->
                              <!-- @if (count($errors))
                                 <ul class="error login100-form-title p-b-51" >
                                     @foreach($errors->all() as $error)
                                         <li>{{ $error }}</li>
                                     @endforeach
                                 </ul>
                                 <br><br>
                                  @endif     -->
                              <!-- ok me dive -->
                              {{ Form::open(array('url' => 'dashboard','id'=>'myform','method'=>'post')) }}
                              <input id="hiddenmethod" type="hidden" name="_method" value="">
                              <div class="box box-primary">
                                 <div class="box-body box-profile">
                                    <img id="photo" class="profile-user-img img-responsive img-circle" src=<?php if(isset($data['photo']) && $data['photo']!=null ){ echo "avatars/".$data['photo'];}else{echo "avatars/avatar5.png";}  ?> alt="User profile picture" disabled>
                                    <h3 class="profile-username text-center"><?php echo $data[0]['username'];?></h3>
                                    <p class="text-muted text-center">Admin</p>
                                    <div class="list-group list-group-unbordered">
                                       {{ Form::text('prevusername',null,array('class'=>'list-group-item','id'=>'prevusername','style'=>'display:none')) }}
                                       {{ Form::label('username', null,array('class'=>'list-group-item','value' => 'Username','id'=>'lblusername')) }}   
                                       <div class="wrap-input100 validate-input m-b-16">
                                          <!-- {{ Form::label('username', 'Username') }} -->
                                          {{ Form::text('username', null, array('class'=>'input100','required' => 'required','id'=>'username'))  }}
                                          <span class="focus-input100"></span>
                                       </div>
                                       {{ Form::label('password', null,array('class'=>'list-group-item','value' => 'Username','id'=>'lblpassword')) }}   
                                       <div class="wrap-input100 validate-input m-b-16">
                                          <!-- {{ Form::label('username', 'Username') }} -->
                                          {{ Form::password('password', array('class'=>'input100','id'=>'password'))  }}
                                          <span class="focus-input100"></span>
                                       </div>
                                       {{ Form::label('role', null,array('class'=>'list-group-item','value' => 'Roli','id'=>'lblroli')) }}   
                                       <div class="wrap-input100 validate-input m-b-16">
                                          <!-- {{ Form::label('username', 'Username') }} -->
                                          <select id="roli" name="roli" class="form-control" required style="background-color:#e6e6e6;height: 62px;color:#403866;text-transform:uppercase;" >
                                             @foreach($roles as $roli)
                                             <!-- <option value="1">Administrator</option>
                                                <option value="2">Punonjes</option> -->
                                             <option value="{{ $roli->Roleid }}">{{$roli->Description}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                       <div id="employee" style="display:none">
                                          {{ Form::label('ssn', null,array('class'=>'list-group-item','value' => 'Username','id'=>'lblssn')) }}   
                                          <div class="wrap-input100 validate-input m-b-16">
                                             <!-- {{ Form::label('username', 'Username') }} -->
                                             {{ Form::text('ssn', null, array('class'=>'input100','required' => 'required','id'=>'ssn','readonly'=>'readonly'))  }}
                                             <span class="focus-input100"></span>
                                          </div>
                                          {{ Form::label('name', null,array('class'=>'list-group-item','value' => 'Username','id'=>'lblname')) }}   
                                          <div class="wrap-input100 validate-input m-b-16">
                                             <!-- {{ Form::label('username', 'Username') }} -->
                                             {{ Form::text('name', null, array('class'=>'input100','required' => 'required','id'=>'name','readonly'=>'readonly'))  }}
                                             <span class="focus-input100"></span>
                                          </div>
                                          {{ Form::label('surname', null,array('class'=>'list-group-item','value' => 'Username','id'=>'lblsurname')) }}   
                                          <div class="wrap-input100 validate-input m-b-16">
                                             <!-- {{ Form::label('username', 'Username') }} -->
                                             {{ Form::text('surname', null, array('class'=>'input100','required' => 'required','id'=>'surname','readonly'=>'readonly'))  }}
                                             <span class="focus-input100"></span>
                                          </div>
                                          {{ Form::label('address', null,array('class'=>'list-group-item','value' => 'Username','id'=>'lbladdress')) }}   
                                          <div class="wrap-input100 validate-input m-b-16">
                                             <!-- {{ Form::label('username', 'Username') }} -->
                                             {{ Form::text('address', null , array('class'=>'input100','required' => 'required','id'=>'address','readonly'=>'readonly'))  }}
                                             <span class="focus-input100"></span>
                                          </div>
                                          {{ Form::label('departament', null,array('class'=>'list-group-item','value' => 'deparatement','id'=>'lbldepartament')) }}   
                                          <div class="wrap-input100 validate-input m-b-16">
                                             <!-- {{ Form::label('username', 'Username') }} -->
                                             <select id="departament" name="departament" class="form-control" required style="background-color:#e6e6e6;height: 62px;color:#403866;text-transform:uppercase;" >
                                                @foreach($departaments as $departament)
                                                <option value="{{ $departament->DepartamentId }}">{{$departament->Name}}</option>
                                                @endforeach
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                                    <!-- <Button type="button" id="update" class="login100-form-btn" ><b>UpdateProfile</b></Button> -->
                                    <div class="container-login100-form-btn" id="change">
                                       {{ Form::submit('Save',array('class'=>'login100-form-btn','id'=>'save')) }}
                                       </br></br>
                                       {{ Form::button('Cancel',array('class'=>'login100-form-btn','id'=>'cancel')) }}
                                    </div>
                                 </div>
                                 <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                              <!-- </div> -->
                              <!-- {{ Form::file('upload',array('id'=>'upload','style'=>'display:none')) }} -->
                              {{ Form::close() }}

                           <!-- /#introduction -->
                        </div>
                        <!-- modal -->
                     </div>
                     <!-- modal -->
                  </div>
                  <!-- modal -->
               </div>
               <!-- modal -->
      <div class="wrapper">
         <header class="main-header" >
            <!-- Logo -->
            <a href="../public/home" class="logo" style="background-color:#827ffe">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>K</b><b>X</b></span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>KREAT</b><b>X</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation" style="background-color:#827ffe">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="background-color:#827ffe">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <!-- Navbar Right Menu -->
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- <li><a href="https://adminlte.io">Almsaeed Studio</a></li>
                        <li><a href="https://adminlte.io/premium">Premium Templates</a></li> -->
                  </ul>
               </div>
            </nav>
         </header>
         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <div class="sidebar" id="scrollspy" >
               <ul class="nav sidebar-menu" >
                  <li class="header">MENU</li>
                  <!-- <li class="active" style="background-color:#403866"><a href="#AdminPanel"><i class="fa fa-circle-o" data-toggle="modal" data-target="#myModal"></i> AdminPanel</a></li> -->
                  <!-- <li class="active" style="background-color:#403866"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button></li> -->
                  <li class="active"><a id="ADD" data-toggle="modal" data-target="#myModal"><i class="fa fa-circle-o" ></i>Shto Punonjes</a></li>
                  <li><a href="#employees"><i class="fa fa-circle-o"></i> Lista e Punonjesve</a></li>
                  <li><a href="../public/logout"><i class="fa fa-circle-o"></i> Logout</a></li>
                  @if($tree != null)
                  <li><a><?php echo $tree; ?></a></li>
                  @endif                    
               </ul>
            </div>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Main content -->
            <div class="content body">
               @if (count($errors))
               <ul class="error login100-form-title p-b-51" >
                  @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
               <br><br>
               @endif    
               <!-- Modal Trying -->
              
               <!-- <br><br> -->
               <section id="employees">
                  <div class="box-body">
                     <div class="col-sm-6" style="margin-left: -20px;">
                        <div id="example1_filter" class="dataTables_filter">
                           <label>Search:<input type="search" style="width: 306%;" value='<?php echo $search; ?>' id="search" class="form-control input-sm" placeholder="" aria-controls="example1" ></label>
                        </div>
                     </div>
                     <div class="hero-callout"></div>
                     <div id="employeetable-wrapper" class="col-lg-9 dataTables_wrapper form-inline dt-bootstrap">
                        <table id="employeetable" class="table table-bordered table-striped" style="margin-left: -20px;">
                           <thead>
                              <tr>
                                 <th>USERNAME</th>
                                 <th>SSN</th>
                                 <th>NAME</th>
                                 <th>SURNAME</th>
                                 <th>ADDRESS</th>
                                 <th>DEPARTAMENT</th>
                                 <th>COMMANDS</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($employees as $employee)
                              <tr>
                                 <td>{{$employee->username}}</td>
                                 <td>{{$employee->ssn}}</td>
                                 <td>{{$employee->name}}</td>
                                 <td>{{$employee->surname}}</td>
                                 <td>{{$employee->address}}</td>
                                 <td id='{{$employee->DepartamentId}}'>{{$employee->Name}}</td>
                                 <!--emri Dep -->
                                 <!-- <td><input type='button' Value='Update' id='{{$employee->username}}' class='btn btn-block btn-primary Update' name='{{$employee->username}}'>
                                    <input type='button' Value='Delete' id='{{$employee->username}}' class='btn btn-block btn-primary Delete' name='{{$employee->username}}' onclick='delete({{$employee->username}})'> -->
                                 <td>
                                    {{ Form::open(array('url' => 'dashboard','method'=>'DELETE')) }}
                                    <input type="hidden" name="deluser" value="{{$employee->username}}" />
                                    {{ Form::submit('Delete',array('class'=>'btn btn-block btn-primary')) }}
                                    {{ Form::close() }}
                                    <input type='button' Value='Update' id='{{$employee->username}}'  data-toggle="modal" data-target="#myModal" class='btn btn-block btn-primary Update' name='{{$employee->username}}'>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                        <div style="margin-left: 550px;">
                            {{ $employees->links() }}
                        </div>                    
                     </div>
                         <!-- CHATI -->
                         <div class="col-lg-3">
                                             <!-- DIRECT CHAT PRIMARY -->
                            <div class="box box-primary direct-chat direct-chat-primary" >
                                <div class="box-header with-border">
                                    <h3 class="box-title">Chat</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    
                                        <button type="button" id="conversations" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Conversations">
                                                     <i class="fa fa-comments"></i></button>
                                        
                                        <button type="button" id="all_users" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="All Users">
                                        <i class="glyphicon glyphicon-user"></i></button>

                                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                    </div>
                                </div>
                                  <!-- /.box-header -->
                                <div class="box-body" >
                                    <input type="text" id="user_to" style="display:none;">
                                     <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages" id="msgbody" style="height: 687px;width:400px;">


                                    </div>
                                    <!-- /.direct-chat-pane -->
                                    <!-- </div> -->
                                    <div class="direct-chat-contacts" id="contacts" style="height: 685px;width:400px;">
                                        
                                        <!-- /.contatcts-list -->
                                    </div>
                                    <!-- /.direct-chat-pane -->
                                </div>
                                             <!-- /.box-body -->
                                <div class="box-footer" >
                                        <!-- <form action="#" method="post"> -->
                                    <div class="input-group">
                                        <input type="text" id="msg" name="message" placeholder="Type Message ..." class="form-control">
                                        <span class="input-group-btn">
                                        <button type="button" id="sendbtn" class="btn btn-primary btn-flat" onclick="Send();">Send</button>
                                        </span>
                                    </div>
                                            <!-- </form> -->
                                </div>
                                                <!-- /.box-footer-->
                            </div>
                                         <!--/.direct-chat -->
                        </div>                        
                        <!-- pjesa e chatit -->
                  </div>
            </div>
         </div>
         </section><!-- /#employees -->
         <!-- <section id="TreeDepartaments" >
            //echo $tree; 
            </section> -->
         <!-- <section id="chat1">
            <!-- <button id="press" type="button">BUTTON</button>
            <a href="../public/chat">Click</a> -->
         <!-- </section> --> 
         
      </div>
      </div>
      <!--</div> -->

      
   </body>
</html>