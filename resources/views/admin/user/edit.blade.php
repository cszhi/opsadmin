@extends('_layout.master') 

@section('css')
<link href="{{ asset("/s/plugins/select2/select2.min.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section('content') 
@include('shared.errors') 
@include('shared.status')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{!!$sub_title or " "!!}</h3>
        <div class="box-tools pull-right">
          <a type="button" class="btn btn-sm btn-default" href="{!!Route('admin.user')!!}"><i class="fa fa-arrow-left"></i> 返回</a>
        </div>
      </div>
      <!-- /.box-header -->
      <form method="post" action="{!!route('admin.user.update', $user->id)!!}" class="form-horizontal">
        <div class="box-body">
          <div class="form-group col-md-12">
            <label for="name" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" value="{!!$user->name!!}" class="form-control name" placeholder="输入 用户名" disabled>
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="email" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" id="email" name="email" value="{!!$user->email!!}" class="form-control email" placeholder="输入 邮箱">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="role" class="col-sm-2 control-label">角色</label>
            <div class="col-sm-8">
              <select class="select2 form-control pull-right" style="width:100%" name="role">
                <option></option>
                @foreach($roles as $role)
                <option value="{!!$role->id!!}" {!! $user->role->lists('id')->first() == $role->id ? 'selected' : ''!!}>{!!$role->name.' - '.$role->description!!}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="password" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                <input type="password" id="password" name="password" value="" class="form-control password" placeholder="输入 密码">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="password_confirmation" class="col-sm-2 control-label">确认密码</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                <input type="password" id="password_confirmation" name="password_confirmation" value="" class="form-control password_confirmation" placeholder="输入 确认密码">
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="form-group col-md-12">
            {{csrf_field()}}
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="btn-group pull-right">
                <button type="submit" class="btn btn-primary pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> 提交">提交</button>
              </div>
              <div class="btn-group pull-left">
                <button type="reset" class="btn btn-warning">撤销</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-footer -->
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>
@endsection 

@section('js') 
<script src="{{ asset("/s/plugins/select2/select2.full.min.js") }}"></script>
<script type="text/javascript">
$(function() {
  $(".select2").select2();
});
</script>
@endsection
