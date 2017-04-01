@extends('_layout.master') 
@section('content') 
@include('shared.errors') 
@include('shared.status')
<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{!! asset("/s/dist/img/user2-160x160.jpg ") !!}" alt="User profile picture">
        <h3 class="profile-username text-center">{!! $user->name !!}</h3>
        <p class="text-muted text-center"></p>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>{!!trans('labels.person.email')!!}</b> <span class="pull-right">{!! $user->email !!}</span>
          </li>
          <li class="list-group-item">
            <b>{!!trans('labels.person.role')!!}</b> <span class="pull-right">{!! $user->roles->lists('description')->first() !!}</span>
          </li>
          <li class="list-group-item">
            <b>{!!trans('labels.person.created_at')!!}</b> <span class="pull-right">{!! $user->created_at !!}</span>
          </li>
          <li class="list-group-item">
            <b>{!!trans('labels.person.updated_at')!!}</b> <span class="pull-right">{!! $user->updated_at !!}</span>
          </li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#edit" data-toggle="tab">{!!trans('labels.person.edit')!!}</a></li>
        <li><a href="#log" data-toggle="tab">{!!trans('labels.person.config')!!}</a></li>
      </ul>
      <div class="tab-content">
        {{--编辑信息--}}
        <div class="tab-pane active" id="edit">
          <form class="form-horizontal" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">{!!trans('labels.person.username')!!}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="{!! $user->name !!}" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="Email" class="col-sm-2 control-label">{!!trans('labels.person.email')!!}</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name='email' id="Email" value="{!! $user->email !!}">
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">{!!trans('labels.person.password')!!}</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="password">
              </div>
            </div>
            <div class="form-group">
              <label for="password_confirmation" class="col-sm-2 control-label">{!!trans('labels.person.confirm_password')!!}</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">{!!trans('crud.submit')!!}</button>
              </div>
            </div>
          </form>
        </div>
        {{--操作记录--}}
        <div class="tab-pane" id="log">
          {{--
          <!-- The timeline -->
          <ul class="timeline timeline-inverse">
            <!-- timeline time label -->
            <li class="time-label">
              <span class="bg-red">
                    10 Feb. 2014
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                </h3>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-comments bg-yellow"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                <div class="timeline-body">
                  Take me to your leader! Switzerland is small and neutral! We are more like Germany, ambitious and misunderstood!
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <li class="time-label">
              <span class="bg-green">
                    3 Jan. 2014
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                <div class="timeline-body">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                  <img src="http://placehold.it/150x100" alt="..." class="margin">
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
          --}}
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
</div>
@endsection
