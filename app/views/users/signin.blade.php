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
                                <div class="form-group">
                                    <input type ="email" class="form-control" placeholder="E-mail" name="email" {{Input::old('email') ? ' value="' . e(Input::old('email')) . '"' : ''  }} autofocus>
                                    @if($errors->has('email'))
                                        {{  $errors->first('email')  }} 
                                    @endif                                     
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    @if($errors->has('password'))
                                        {{  $errors->first('password')  }} 
                                    @endif                                    
                                </div>
                                <div class="checkbox">
                                    <label>{{ Form::checkbox('remember', 'remember') }} Remember Me</label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                 <input type="submit" class="btn btn-md btn-success btn-block" value="Sign In">
                                {{ Form::token() }} 
                                <hr>
                                <a href="{{ URL::route('users-forget-password') }}" class="pull-right">Forget Password?</a>
                                <a href="{{ URL::to('login/fb') }}" class="pull-left">Login with Facebook</a>
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

