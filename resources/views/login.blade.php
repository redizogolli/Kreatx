<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kreatx</title>

         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!--JQuery Script -->
        <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

           
            <style>
                .error {
                    width: 100%;
                    position: relative;
                    background-color: #fff;
                    border: 1px solid transparent;
                    border-radius: 3px;
                    font-family: Ubuntu-Bold;
                    color: red;
                    line-height: 1.2;
                    font-size: 18px;
                }

            </style>
    </head>
    <body>
        <div class="limiter">
		    <div class="container-login100">
                <div class="wrap-login100 p-t-50 p-b-90">

                    {{ Form::open(array('url' => 'login')) }}
                    <!-- <h1>Kreatx Login</h1> -->
                    <span class="login100-form-title p-b-51">Kreatx Login</span>

                
                    @if (count($errors))
                        <ul class="error login100-form-title p-b-51" >
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <br><br>
                    @endif    
                    
                    <div class="wrap-input100 validate-input m-b-16">
                        <!-- {{ Form::label('username', 'Username') }} -->
                        {{ Form::text('username', null, array('class'=>'input100','required' => 'required', 'placeholder'=>'Username','id'=>'username'))  }}
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16">
                        <!-- {{ Form::label('password', 'Password') }} -->
                        {{ Form::password('password', array('class'=>'input100','required' => 'required','placeholder'=>'Password','id'=>'password')) }}
                        <span class="focus-input100"></span>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        {{ Form::submit('Login',array('class'=>'login100-form-btn')) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </body>
</html>
