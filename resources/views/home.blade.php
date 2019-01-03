<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" type="text/css" href="../vendor/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="../vendor/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" type="text/css" href="../vendor/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" type="text/css" href="../vendor/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Google Font -->
  <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!-- jQuery 3 -->
    <script src="../vendor/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
        <script>
        $(document).ready(function () {
            $changeit=false;// per foton kur ta klikojme te ndryshohet vtm nqs eshte true,qe do behet kur te klikohet update
             $('#update').click(function() {
                 //alert( "Handler for .click() called." );
                 Enable();
             });
             $('#cancel').click(function() {
                 //alert( "Handler for .click() called." );
                 FillDefault();
                 Disable();
             });

             Contacts('');
             //Chat();
              $('#all_users').click(function() {
                  //alert("users");
                  Contacts('users');
              });
              $('#conversations').click(function() {
                //alert("convers");
                Contacts('');
             });

             $('#photo').click(function() {
                 if($changeit==true){
                     //alert("ok");
                     $("#upload").click();

                     $(document).on('change', '#upload', function(){//kur ndryshon permbajtja e saj
                        var name = document.getElementById("upload").files[0].name;
                        var form_data = new FormData();
                        var ext = name.split('.').pop().toLowerCase();
                        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
                        {
                            alert("Invalid Image File");
                            $("#upload").val("");
                        }
                        else
                        {
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(document.getElementById("upload").files[0]);
                            var f = document.getElementById("upload").files[0];
                            var fsize = f.size||f.fileSize;
                            if(fsize > 2000000)
                            {
                                alert("Image File Size is very big");
                                $("#upload").val("");   
                            }
                            else
                            {
                                //alert("Ok");
                                $val=$("#upload").val();
                                //alert($val);
                                //$("#photo").attr("src",$val);
                                $("#photo").attr("src",URL.createObjectURL(event.target.files[0]));// i bejme preview fotos para se ta ndryshoje
                                //$("#photo").attr("src",$("#upload").val());
                            }
                        }
                        
                     });
                 }
             });

        });  
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
      
        setInterval(function(){ Chat(); }, 3000);

        function Disable(){
            $('#username').attr("readonly", true);
            $('#name').attr("readonly", true);
            $('#surname').attr("readonly", true);
            $('#address').attr("readonly", true);
            $('#change').css('display','none');//per divin qe mban btn e ruaj dhe cancel
            $('#update').css('display','block');
            $('#save').attr("disabled", true);
            $('#cancel').attr("disabled", true);
            $('#update').attr("disabled", false);
            $changeit=false;
        } 
        function Enable(){
            $('#name').attr("readonly", false);
            $('#surname').attr("readonly", false);
            $('#address').attr("readonly", false);
            $('#change').css('display','block');//per divin qe mban btn e ruaj dhe cancel
            $('#update').css('display','none');
            $('#save').attr("disabled", false);
            $('#cancel').attr("disabled", false);
            $('#update').attr("disabled", false);
            $changeit=true;
        } 
        /*function FillDefault(){
            $('#name').attr("readonly", false);
            $('#surname').attr("readonly", false);
            $('#address').attr("readonly", false);
            $('#name').val(<?php //echo $data['name']; ?>);
            $('#surname').val(<?php //echo $data['surname']; ?>);
            $('#address').val(<?php //echo $data['address']; ?>);
        } */
        
        $(document).on('click', '.kont', function(){
                $user=this.id;
                
                $('#msgbody').text('');
                $('#user_to').val($user);
                Chat();
                //alert($user);
                /*$.ajaxSetup({
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
                                        if($('#msgbody').text()=='')
                                        {
                                            $('#msgbody').text('Start a conversation with '+ $user);
                                        }
                                        $('#user_to').val($user);
                                        
                    }
               });*/
        }); 
        </script>
</head>
<body class="skin-blue" data-spy="scroll" data-target="#scrollspy">
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
        <aside class="main-sidebar" >
        <!-- sidebar: style can be found in sidebar.less -->
            <div class="sidebar" id="scrollspy">
                <ul class="nav sidebar-menu" >
                    <li class="header">MENU</li>
                    <li class="active" ><a href="#myprofile"><i class="fa fa-circle-o"></i> MyProfile</a></li>
                    <li><a href="../public/logout"><i class="fa fa-circle-o"></i> Logout</a></li>
                </ul>
            </div>
        <!-- /.sidebar -->
        </aside>

         <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content body col-lg-12">
                <section id="introduction">
                    <h2 class="page-header"><a href="#myprofile" class="profileHeader">MyProfile</a></h2>
                  
                    @if($userinfo!=null)
                        <?php
                            $data = json_decode(json_encode($userinfo), true);
                            //print_r($data); 
                            //echo  $data['ssn'];
                           
                        ?>
                        <!-- <div class="col-md-3" > -->
                        <!-- Profile Image -->
                        <div class="col-lg-12">
                        <div class="col-lg-8">
                        {{ Form::open(array('url' => 'home','files' => true)) }}
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img id="photo" class="profile-user-img img-responsive img-circle" src=<?php if(isset($data['photo']) && $data['photo']!=null ){ echo "avatars/".$data['photo'];}else{echo "avatars/avatar5.png";}  ?> alt="User profile picture" disabled>

                                <h3 class="profile-username text-center"><?php echo $data['name']."  "; echo $data['surname'];?></h3>

                                <p class="text-muted text-center">Employee</p>

                                <div class="list-group list-group-unbordered">

                                     {{ Form::label('username', null,array('class'=>'list-group-item','value' => 'Username','id'=>'lblusername')) }}   
                                     <div class="wrap-input100 validate-input m-b-16">
                                        <!-- {{ Form::label('username', 'Username') }} -->
                                        
                                        {{ Form::text('username', isset($data['username']) ? $data['username'] : '', array('class'=>'input100','required' => 'required','id'=>'username','readonly'=>'readonly'))  }}
                                        <span class="focus-input100"></span>
                                    </div>
                                    <!-- <p class="list-group-item">
                                    <b>Following</b> <a class="pull-right">543</a>
                                    </p>
                                    <p class="list-group-item">
                                    <b>Friends</b> <a class="pull-right">13,287</a>
                                    </p> -->
                                    {{ Form::label('name', null,array('class'=>'list-group-item','value' => 'Emri','id'=>'lblname')) }}   
                                     <div class="wrap-input100 validate-input m-b-16">
                                        <!-- {{ Form::label('username', 'Username') }} -->
                                        
                                        {{ Form::text('name', isset($data['name']) ? $data['name'] : '', array('class'=>'input100','required' => 'required','id'=>'name','readonly'=>'readonly'))  }}
                                        <span class="focus-input100"></span>
                                    </div>
                                    {{ Form::label('surname', null,array('class'=>'list-group-item','value' => 'Emri','id'=>'lblsurname')) }}   
                                     <div class="wrap-input100 validate-input m-b-16">
                                        <!-- {{ Form::label('username', 'Username') }} -->
                                        
                                        {{ Form::text('surname', isset($data['surname']) ? $data['surname'] : '', array('class'=>'input100','required' => 'required','id'=>'surname','readonly'=>'readonly'))  }}
                                        <span class="focus-input100"></span>
                                    </div>
                                    {{ Form::label('address', null,array('class'=>'list-group-item','value' => 'Emri','id'=>'lbladdress')) }}   
                                     <div class="wrap-input100 validate-input m-b-16">
                                        <!-- {{ Form::label('username', 'Username') }} -->
                                        
                                        {{ Form::text('address', isset($data['address']) ? $data['address'] : '', array('class'=>'input100','required' => 'required','id'=>'address','readonly'=>'readonly'))  }}
                                        <span class="focus-input100"></span>
                                    </div>
                                </div>

                                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                                <Button type="button" id="update" class="login100-form-btn" ><b>UpdateProfile</b></Button>

                                <div class="container-login100-form-btn" id="change" style="display:none">
                                    {{ Form::submit('SaveChanges',array('class'=>'login100-form-btn','disabled'=>'disabled','id'=>'save')) }}
                                    </br>
                                    {{ Form::button('Cancel',array('class'=>'login100-form-btn','disabled'=>'disabled','id'=>'cancel')) }}
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                     </div>
                        <!-- /.box -->
                    <!-- </div> -->
                    {{ Form::file('upload',array('id'=>'upload','style'=>'display:none')) }}
                    {{ Form::close() }}

                    <!-- Chati <div class="col-lg-4"> -->
                <!-- <div class="row"> -->
                    <div class="col-lg-3">
                                             <!-- DIRECT CHAT PRIMARY -->
                            <div class="box box-primary direct-chat direct-chat-primary" style="width:300px;">
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
                                <div class="box-body" style="">
                                    <input type="text" id="user_to" style="display:none;">
                                     <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages" id="msgbody" style="height: 540px;width:300px;">


                                    </div>
                                    <!-- /.direct-chat-pane -->
                                    <!-- </div> -->
                                    <div class="direct-chat-contacts" id="contacts" style="height: 650px;width:300px;">
                                        
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
                    <!-- </div> -->
                 </div>
                    @endif
                    
                </section><!-- /#introduction -->
                
            </div>
        </div>
    </div>


<script>
      function FillDefault(){
            $name="<?php if(isset($data['name'])){echo $data['name']; }?>";
            $surname="<?php if(isset($data['surname'])){echo $data['surname']; }?>";
            $address="<?php if(isset($data['address'])){echo $data['address']; }?>";
            $photo="<?php if(isset($data['photo'])){echo "avatars/".$data['photo']; }?>";
            //alert($name);
            $('#name').val($name);
            $('#surname').val($surname);
            $('#address').val($address);
            $('#photo').attr("src",$photo);
            $("#upload").val(""); 
        }

      
</script>
</body>
</html>
