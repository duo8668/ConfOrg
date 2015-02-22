<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.dashboard.headerdash')
</head>

<body>
   <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-green" style="margin-top:20%;">
                    <div class="panel-heading">
                        <h3 class="panel-title">New Resource Provider Registration</h3>
                    </div>
                    <div class="panel-body">
                    @if(Session::has('message'))
                        {{Session::get('message')}} 
                    @endif
                         {{ Form::open(array('route' => 'users-resource-post', 'method' => 'post')) }}

							<div class="form-group">
                                {{Form::label('company','Company')}}<br>
                                {{Form::label('company', $invite->company)}}
								{{Form::hidden('company', $invite->company)}}
                            </div>
                            <div class="form-group">
                                {{Form::label('email','Email')}} <br>
                                {{Form::label('email', $invite->email)}}
								{{Form::hidden('email', $invite->email)}}
                            </div>

                            <div class="form-group">
                                {{Form::label('first_name','First Name')}}
                                {{ Form::text('first_name', '', array('class' => 'form-control')) }}
                                <!-- <input type ="text" name="first_name" {{Input::old('first_name') ? ' value="' . e(Input::old('first_name')) . '"' : ''  }}> -->
                                 @if($errors->has('first_name'))
                                    <p class="text-danger">{{ $errors->first('first_name')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                {{Form::label('last_name','Last Name')}}
                                {{ Form::text('last_name', '', array('class' => 'form-control')) }}
                                <!-- <input type ="text" name="last_name" {{Input::old('last_name') ? ' value="' . e(Input::old('last_name')) . '"' : ''  }}> -->
                                 @if($errors->has('last_name'))
                                    <p class="text-danger">{{ $errors->first('last_name')}}</p>
                                @endif
                            </div>
                           
                            <div class="form-group">
                                {{Form::label('password','Password')}}
                                {{Form::password('password', array('class' => 'form-control'))}}
                                 @if($errors->has('password'))
                                    <p class="text-danger">{{ $errors->first('password')}}</p>
                                @endif
                            </div>

                            <div class="form-group">
                                {{Form::label('password','Confirm Password')}}
                                {{Form::password('confirm_password', array('class' => 'form-control'))}}
                                 @if($errors->has('confirm_password'))
                                    <p class="text-danger">{{ $errors->first('confirm_password')}}</p>
                                @endif
                            </div>
                            <hr>
                            {{ Form::submit('Create Resource Provider Account', array('class' => 'btn btn-md btn-success btn-block')) }}
                            {{Form::token()}}
                        {{ Form::close() }}
                        <hr>
                        <a href="{{ url() }}" class="pull-right"><p class="text-danger"><i class="fa fa-arrow-left"></i> Back</p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

 @include('layouts.dashboard.footerdash')
</body>
</html>
