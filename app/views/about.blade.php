<!-- <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Conference organizer</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body>

<p>Tabs With Dropdown Example</p>
<ul class="nav nav-tabs">
   <li class="active"><a href="#">Home</a></li>
   <li><a href="#">SVN</a></li>
   <li><a href="#">iOS</a></li>
   <li><a href="#">VB.Net</a></li>
   <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
         Java <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
         <li><a href="#">Swing</a></li>
         <li><a href="#">jMeter</a></li>
         <li><a href="#">EJB</a></li>
         <li class="divider"></li>
         <li><a href="#">Separated link</a></li>
      </ul>
   </li>
   <li><a href="#">PHP</a></li>
</ul>

<div id="wrapthis">
<div class="alert alert-success" style="max-width:500px;" role="alert" span3>..wagwagawgwagagwagw.</div>
<div class="alert alert-info" role="alert">...</div>
<div class="alert alert-warning" role="alert">...</div>
<div class="alert alert-danger" role="alert">...</div>
</div>

    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html> -->
<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap Dual Listbox</title>
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
    <link rel="stylesheet" type="text/css" href="../public/src/bootstrap-duallistbox.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    // <script src="/public/main.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>
    <script src="../public/src/jquery.bootstrap-duallistbox.js"></script>
  </head>
  <body class="container">
  {{ Form::open(['data-remote'],array('url' => 'room', 'class' => 'form-horizontal')) }}
    <fieldset>  
    <div>
      <select multiple="multiple" size="10" name="duallistbox_demo2[]">
        <option value="category 1">category 1</option>
        <option value="option2">category 2</option>
        <option value="option3">category 3</option>
        <option value="option4">audio 4</option>
        <option value="option5">audio 5</option>
        <option value="option6">audio 6</option>
        <option value="option7">video 7</option>
        <option value="option8">video 8</option>
        <option value="option9">Others 9</option>
        <option value="option0">Others 10</option>
      </select>  
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-4">           
        
      {{ Form::submit('Create Room!', array('name'=>'Create','class' => 'btn btn-primary')) }}      
      </div>
    </div>
    </fieldset>
    {{ Form::close() }}

  <script>
    var demo2 = $('select[name="duallistbox_demo2[]"]').bootstrapDualListbox();
    $("#demoform").submit(function() {
      alert($('[name="duallistbox_demo2[]"]').val());
      return false;
    });    
  </script>
</body>
</html>