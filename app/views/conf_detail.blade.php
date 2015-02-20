@include ('top')
<style>
    .desc { font-weight:400; margin-bottom:40px;}
</style>
    <!-- Header -->
    <div class="jumbotron" style="background-image: url({{asset('img/conflist-bg.jpg')}}); background-size:cover;">
      <div style="padding-bottom: 50px;"></div>
      <h2 class="text-center" style="color:#fff;">Conference Name Here</h2>
      <div style="padding-bottom: 30px;"></div>
    </div>
    
    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <!-- BREADCRUMB -->
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('/conference_list') }}" style="color:#777;"><i class="fa fa-arrow-left"></i> Back to Conference List</a></li>
        </ol>
        <hr>
        
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-md-10">
                    <input type="email" class="form-control" id="search_conf" placeholder="Search conference" >
                </div>
              <button type="submit" class="btn btn-primary col-md-2">Search Conference</button>
            </div>
        </form>
        <hr>
        
        <div class="row">
            <div class="col-md-12" style="margin-bottom:50px;">
               
                <h2 class="text-center"><u>Information Technology Conference 2015 </u></h2>
                <h3 class="text-center"> Singapore Expo  </h3>
                <h3 class="text-center"> 20 - 25 May 2015</h3>

                <!-- SUBMIT PAPER BUTTON  -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                        <a href="#" class="btn btn-primary btn-block" role="button">Submit Paper</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3" style="margin-top:1em;">
                        <a href="#" class="btn btn-success btn-block" role="button">Purchase Tickets</a>
                    </div>
                </div>

            </div>
            <div style="clearfix"></div>

            <div class="col-md-10 col-md-offset-1">
                <legend>About the Conference</legend>
                <p class="desc">
                    In ornare libero eget neque condimentum pellentesque. Proin nunc augue, iaculis quis lobortis et, gravida ut nisl. Aenean gravida dolor nec maximus pulvinar. Morbi ac tempus ipsum. Donec iaculis sapien eget viverra vulputate. Sed urna erat, ultricies sed lacus a, pharetra lacinia quam. Curabitur ut blandit arcu. Maecenas vel odio sed mi pharetra vehicula a nec sapien. Vivamus tempus accumsan neque, non consectetur est malesuada vitae. Sed arcu eros, vestibulum a tellus at, bibendum mollis mauris. Morbi eget neque dolor. Curabitur a consequat justo, vitae placerat augue. Maecenas malesuada porttitor dictum. Aliquam blandit commodo lorem eu egestas. Maecenas consectetur tincidunt urna, eu egestas metus ultricies non.

                    In hac habitasse platea dictumst. Nam tempus nunc sit amet mauris commodo, non convallis tortor luctus. Ut ultricies est vitae justo vulputate, in dapibus mi euismod. Ut quis condimentum augue. Aenean cursus eget enim eu elementum. Vivamus vitae eros in justo efficitur tincidunt eu ac odio. Aliquam sed sapien vestibulum, tincidunt tortor quis, venenatis eros. Nullam sagittis dui eros, vitae euismod dui ultricies id. Pellentesque et lacus sagittis, tempor neque quis, vehicula mi.
                </p>
                <legend>Topics</legend>
                    <ol>
                        <li>Topic 1</li>
                        <li>Topic 2</li>
                        <li>Topic 3</li>
                        <li>Topic 4</li>
                        <li>Topic 5</li>
                        <li>Topic 6</li>
                        <li>Topic 7</li>
                    </ol>
                    <p class="desc">The paper submitted may cover more than 1 topics.</p>
                <legend>Schedule</legend>
                 <p class="desc">Click here to download the schedule</p>

                 <legend>Contact</legend>
                 <p class="desc">For further enquiry regarding this conference, please contact [CHAIR EMAIL HERE]</p>
            </div>

        </div>
    </div>
  @include('footer')
