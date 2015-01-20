
        <h2>Register here</h2>

     <form action="{{URL::route('users-create-post')}}" method="post">

         <div class="field">
            Email: <input type ="text" name="email" {{Input::old('email') ? ' value="' . e(Input::old('email')) . '"' : ''  }}>
            @if($errors->has('email'))
                {{ $errors->first('email')}}
            @endif
        </div>

        <div class="field">
            First Name: <input type ="text" name="first_name" {{Input::old('first_name') ? ' value="' . e(Input::old('first_name')) . '"' : ''  }}>
             @if($errors->has('first_name'))
                {{ $errors->first('first_name')}}
            @endif
        </div>

        <div class="field">
            Last Name: <input type ="text" name="last_name" {{Input::old('last_name') ? ' value="' . e(Input::old('last_name')) . '"' : ''  }}>
             @if($errors->has('last_name'))
                {{ $errors->first('last_name')}}
            @endif
        </div>

 
       
        <div class="field">
            {{Form::label('password','Password')}}
            {{Form::password('password',array('class' => 'form-control'))}}
             @if($errors->has('password'))
                {{ $errors->first('password')}}
            @endif
        </div>

        <div class="field">
            {{Form::label('password','Confirm Password')}}
            {{Form::password('confirm_password',array('class' => 'form-control'))}}
             @if($errors->has('confirm_password'))
                {{ $errors->first('confirm_password')}}
            @endif
        </div>

        <input type="submit" value="Create account">
        {{Form::token()}}
    </form>
@if(Session::has('message'))
    {{Session::get('message')}} 
@endif