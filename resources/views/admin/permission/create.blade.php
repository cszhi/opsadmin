@extends('_layout.master') 
@section('content') 
@include('shared.errors') 
@include('shared.status')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">{!!$sub_title or " "!!}</h3>
        <div class="box-tools pull-right">
          <a type="button" class="btn btn-sm btn-default" href="{!!Route('admin.permission')!!}"><i class="fa fa-arrow-left"></i> 返回</a>
        </div>
      </div>
      <!-- /.box-header -->
      <form method="post" action="{!!route('admin.permission.store')!!}" class="form-horizontal">
        <div class="box-body">
          <div class="form-group col-md-12">
            <label for="name" class="col-sm-2 control-label">权限名称</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" class="form-control name" placeholder="输入 权限名称" value="{!!old('name')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="slug" class="col-sm-2 control-label">权限</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="slug" name="slug" class="form-control slug" placeholder="输入 权限" value="{!!old('slug')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="description" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="description" name="description" class="form-control description" placeholder="输入 描述" value="{!!old('description')!!}">
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
