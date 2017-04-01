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
          <a type="button" class="btn btn-sm btn-default" href="{!!Route('admin.role')!!}"><i class="fa fa-arrow-left"></i> {!!trans('crud.back')!!}</a>
        </div>
      </div>
      <!-- /.box-header -->
      <form method="post" action="{!!route('admin.role.store')!!}" class="form-horizontal">
        <div class="box-body">
          <div class="form-group col-md-12">
            <label for="name" class="col-sm-2 control-label">{!!trans('labels.role.name')!!}</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" class="form-control name" placeholder="{!!trans('labels.role.name')!!}" value="{!!old('name')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="slug" class="col-sm-2 control-label">{!!trans('labels.role.slug')!!}</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="slug" name="slug" class="form-control slug" placeholder="{!!trans('labels.role.slug')!!}" value="{!!old('slug')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="permission" class="col-sm-2 control-label">{!!trans('labels.role.permission')!!}</label>
            <div class="col-sm-8">
              <select class="select2 form-control pull-right" id='permissionSelect' style="width:100%;height:200px" name="permission[]" multiple="multiple">
                @foreach($permissions as $permission)
               {{-- <option value="{!!$permission->id!!}" {!! in_array($permission->id, array_merge(['0'], old('permission'))) ? 'selected' : '' !!}>{!!$permission->name!!}</option>--}}
               <option value="{!!$permission->id!!}">{!!$permission->name.' - '.$permission->description!!}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="description" class="col-sm-2 control-label">{!!trans('labels.role.description')!!}</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="description" name="description" class="form-control description" placeholder="{!!trans('labels.role.description')!!}" value="{!!old('description')!!}">
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

@section('css')
<link href="{{ asset("/s/plugins/duallistbox/bootstrap-duallistbox.min.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section('js') 
<script src="{{ asset("/s/plugins/duallistbox/jquery.bootstrap-duallistbox.min.js") }}"></script>
<script src="{{ asset("/backend/js/admin/duallistbox-roles.js") }}"></script>
@endsection
