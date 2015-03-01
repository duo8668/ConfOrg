@include ('top')
<style>
  .desc { font-weight:400;}
  .ellipsis { overflow: hidden; white-space: nowrap; text-overflow: ellipsis; }
</style>
{{ HTML::script('js/searchable-ie.js') }}


<script type="text/javascript">
  $(function () {

    $(document).find('input[name="chkField[]"]').iCheck({
      checkboxClass: 'icheckbox_square-green'
    });

    var chkFields = {{ $items }};

    $.each(chkFields,function(index,value){

      $('#chkField_' + value).iCheck('check');

    });

  });
</script>
<!-- Header -->
<div class="jumbotron" style="background-image: url({{asset('img/conflist-bg.jpg')}}); background-size:cover;">
  <div style="padding-bottom: 50px;"></div>
  <h1 class="text-center" style="color:#fff;">All Conferences</h1>
  <div style="padding-bottom: 30px;"></div>
</div>

<div class="container" id="searchable-container" style="margin-top: 50px; margin-bottom: 50px;">
  @if (Session::has('message'))
  <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:15px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {{{ Session::get('message') }}}
  </div>
  @endif
  {{ Form::open(array('method'=>'POST','id'=>'frmFilterConf', 'class' => 'form-horizontal')) }}
  <div class="form-group">
    <div class="col-md-12">
      @foreach ($fields as $field)
      <div class="checkbox col-md-4">
        <label> 
          {{Form::checkbox('chkField[]', 'chkField_'. $field->id,false ,array('id' => 'chkField_'. $field->id ))}}
          {{Form::label('chkField_'. $field->id, $field->label)}}
        </label>
      </div>
      @endforeach
      <p class="help-block col-md-12">Categorizing your conference will help in making your conference visible in ORAFER search result</p>
    </div>
  </div>
  <!-- Submit Button -->
  <div class="row">  
    <div class="col-md-8 col-md-offset-2">
      {{ Form::submit('Search Conferences', array('class' => 'btn btn-primary btn-md btn-block')) }}

    </div>
  </div>
  {{ Form::close() }}
  
  <hr>
  <div class="clearfix"></div>
  <div class="row">
   @foreach ($datas as $datas)
   <div class="col-md-4 portfolio-item">
    <div class="panel panel-default">
      <div class="panel-body">
        <h4 class="conf_title">
          {{ link_to_route( 'conference.public_detail', $datas->conferences->title, ['id' => $datas->conferences->conf_id] ) }}
        </h4>    
        <p class="desc">{{ $out = strlen($datas->conferences->description) > 70 ? substr($datas->conferences->description,0,70)."..." : $datas->conferences->description }}</p>
        <p class="desc">{{ date("d F Y",strtotime($datas->conferences->begin_date)) }} to {{ date("d F Y",strtotime($datas->conferences->end_date)) }}</p>
        <p class="desc">{{ $datas->rooms->venues->venue_name }}</p>
        {{ link_to_route( 'conference.public_detail', 'More Info', ['id' => $datas->conferences->conf_id], ['class' => 'btn btn-info btn-md pull-right'] ) }}
      </div>
    </div>
  </div>
  @endforeach
</div>
</div>

@include('footer')
