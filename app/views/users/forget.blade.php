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
                        <h3 class="panel-title">Recover Password</h3>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            {{Session::get('message')}} 
                        @endif
                        {{ Form::open(array('route' => 'users-forget-password-post', 'method' => 'post')) }}
                            <fieldset>
                                <div class="form-group">
                                    <input type ="email" class="form-control" placeholder="E-mail" name="email" {{Input::old('email') ? ' value="' . e(Input::old('email')) . '"' : ''  }} autofocus>
                                    @if($errors->has('email'))
                                        {{  $errors->first('email')  }} 
                                    @endif                                     
                                </div>
                                
                                <!-- Button -->
                                 <input type="submit" class="btn btn-md btn-success btn-block" value="Recover Password">
                                {{ Form::token() }} 
                                 <hr>
                                <a href="{{ URL::route('users-sign-in') }}" class="pull-right">Back to Login</a>
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