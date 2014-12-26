<!DOCTYPE html>
<html lang="en">

<head>
  @include('layouts.dashboard.headerdash')
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('route' => 'sessions.store')) }}
                            <fieldset>
                                <div class="form-group">
									 {{ Form::email('email', '', array('placeholder' => 'Your Email', 'class' => 'form-control input-md')) }}
                                    
                                </div>
                                <div class="form-group">									
                                	{{ Form::password('password', array('placeholder' => 'Your Password', 'class' => 'form-control input-md')) }}
                                </div>
                                {{ Form::submit('Login', array('class' => 'btn btn-lg btn-success btn-block')) }}
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- /#wrapper -->
@include('layouts.dashboard.footerdash')
</body>

</html>

