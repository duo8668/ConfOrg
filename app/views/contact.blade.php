@include ('top')
<style type="text/css">
.form-group input,  .form-group textarea {padding: 20px; }
.form-group {margin-bottom: 25px;}
</style>
<!-- Header -->
<div class="jumbotron" style="background-image: url({{asset('img/contact.jpg')}}); background-size:cover;">
  <div style="padding-bottom: 50px;"></div>
  <h1 class="text-center" style="color:#fff;">Questions?</h1>
  <div style="padding-bottom: 30px;"></div>
</div>
    
    
<div id="contact_us" style="background-color: #fff;">
    <div class="container" style="padding-top:70px; padding-bottom:70px;">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h4 class="section-heading">Fill in the form below, or simply drop us an email at <a href="mailto:admin@orafer.com">admin@orafer.com</a></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-success text-center"> @if (Session::has('success')) {{{ Session::get('success') }}} @endif</h4>
                {{ Form::open(array('route' => 'homepage.contact', 'name' => 'sentMessage')) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                              {{ Form::text('name', null, array('class' => 'form-control', 'id' => 'name', 'required' => 'required', 'data-validation-required-message' => 'Please enter your name.', 'placeholder' => 'Your Name *')) }}
                            </div>

                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                              {{ Form::email('email', null, array('class' => 'form-control', 'id' => 'email', 'required' => 'required', 'data-validation-required-message' => 'Please enter your email address.', 'placeholder' => 'Your Email *')) }}
                            </div>

                            <div class="form-group @if ($errors->has('Subject')) has-error @endif">
                              {{ Form::text('subject', null, array('class' => 'form-control', 'id' => 'subject', 'required' => 'required', 'data-validation-required-message' => 'Please enter the subject of your message.', 'placeholder' => 'Subject *')) }}
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if ($errors->has('message')) has-error @endif">
                              {{ Form::textarea('message', null, array('class' => 'form-control', 'id' => 'message', 'required' => 'required', 'data-validation-required-message' => 'Please enter a message.', 'placeholder' => 'Your Message *', 'style' => 'height:177px')) }}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-info btn-lg">Send Message</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

  @include('footer')
