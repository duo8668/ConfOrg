<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.dashboard.headerdash')
</head>

<body>
   <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-green">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            {{Session::get('message')}} 
                        @endif
                        {{ Form::open(array('route' => 'users-sign-in-post', 'method' => 'post')) }}
                            <fieldset>
                                <div class="form-group @if ($errors->has('email')) has-error @endif">
                                    {{ Form::email('email', '', array('class' => 'form-control', 'placeholder' => 'E-mail', 'autofocus' => 'yes')) }}
                                    <!-- <input type ="email" class="form-control" placeholder="E-mail" name="email" {{Input::old('email') ? ' value="' . e(Input::old('email')) . '"' : ''  }} autofocus> -->
                                    @if($errors->has('email'))
                                        <p class="text-danger">{{  $errors->first('email') }}</p> 
                                    @endif                                     
                                </div>
                                <div class="form-group @if ($errors->has('password')) has-error @endif">
                                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
                                    @if($errors->has('password'))
                                        <p class="text-danger">{{  $errors->first('password') }}</p>
                                    @endif                                    
                                </div>
                                <div class="checkbox">
                                    <label>{{ Form::checkbox('remember', 'remember') }} Remember Me</label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                {{ Form::submit('Sign In', array('class' => 'btn btn-md btn-success btn-block')) }}
                                 <!-- <input type="submit" class="btn btn-md btn-success btn-block" value="Sign In"> -->
                                {{ Form::token() }} 
                                <hr>
                                <a href="{{ URL::route('users-forget-password') }}" class="pull-right">Forget Password?</a>
                                <a href="{{ URL::to('login/fb') }}" class="pull-left" style="margin-top: -8px;"><img src="{{ url() }}/images/fblogin.png" alt="Login with Facebook" width="175"></a>
                                <div class="clearfix"></div>
                                <hr>
                                <div class="text-center"><i class="fa fa-user"></i> Don't have an account yet? <a href="{{ URL::route('users-create') }}" ><span class="text-success">Sign up Here</span></a></div>
                                
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

 @include('layouts.dashboard.footerdash')

</body>
</html>

