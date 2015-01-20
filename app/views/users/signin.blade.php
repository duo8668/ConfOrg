<html>
<body>
                        <form action = "{{URL::route('users-sign-in-post')}}" method = "post">
                            <div class = "field">
                            Email: <input type ="text" name="email" {{Input::old('email') ? ' value="' . e(Input::old('email')) . '"' : ''  }}>
                                @if($errors->has('email'))
                                    {{  $errors->first('email')  }} 
                                @endif     
                            </div>

                            <div class = "field">
                                Password: <input type="password" name="password">
                                @if($errors->has('password'))
                                    {{  $errors->first('password')  }} 
                                @endif         
                            </div> 
                            <div>
                              {{Form::checkbox('remember', 'remember')}}
                              {{ Form::label('remember', 'Remember Me')}}
                            </div>                                
                            <input type="submit" value="Sign In">
                            {{ Form::token() }}                       
                        </form>
            <a href="{{ URL::route('users-forget-password') }}">Forget Password?</a></li>
@if(Session::has('message'))
    {{Session::get('message')}} 
@endif
</body>

</html>
