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
          <a type="button" class="btn btn-sm btn-default" href="{!!Route('admin.permission')!!}"><i class="fa fa-arrow-left"></i> {!!trans('crud.back')!!}</a>
        </div>
      </div>
      <!-- /.box-header -->
      <form method="post" action="{!!route('admin.permission.update', $permission->id)!!}" class="form-horizontal">
        <div class="box-body">
          <div class="form-group col-md-12">
            <label for="name" class="col-sm-2 control-label">{!!trans('labels.permission.name')!!}</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" value="{!!$permission->name!!}" class="form-control name" placeholder="{!!trans('labels.permission.name')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="slug" class="col-sm-2 control-label">{!!trans('labels.permission.slug')!!}</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="slug" name="slug" value="{!!$permission->slug!!}" class="form-control slug" placeholder="{!!trans('labels.permission.slug')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="description" class="col-sm-2 control-label">{!!trans('labels.permission.description')!!}</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="description" name="description" value="{!!$permission->description!!}" class="form-control description" placeholder="{!!trans('labels.permission.description')!!}">
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
                <button type="submit" class="btn btn-primary pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">{!!trans('crud.submit')!!}</button>
              </div>
              <div class="btn-group pull-left">
                <button type="reset" class="btn btn-warning">{!!trans('crud.reset')!!}</button>
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
