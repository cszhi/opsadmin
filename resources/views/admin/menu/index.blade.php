@extends('_layout.master') 

@section('content') 
@include('shared.errors') 
@include('shared.status')
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
        <h4 class="modal-title" id="DeleteModalLabel"></h4>
      </div>
      <div class="modal-footer">
        <form method="post" action="" class="pull-right">
          {!!csrf_field()!!}
          <div class="form-group">
            <div>
              <button type="button" class="btn btn-default" data-dismiss="modal">{!!trans('crud.cancel')!!}</button>
              <button type="submit" class="btn btn-danger">{!!trans('crud.destroy')!!}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /.deletePermissionModal -->
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-th"></i>
        <h3 class="box-title">{!!trans('strings.title.admin.menu.list')!!}</h3>
        <div class="box-tools pull-right">
          <a type="button" class="btn btn-sm btn-primary" href="{!!Route('admin.menu')!!}"><i class="fa fa-refresh"></i> {!!trans('crud.refresh')!!}</a>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="dd">
          <ol class="dd-list">
            @foreach($menus as $menu)
              <li class="dd-item" data-id="{!!$menu->id!!}">
                <div class="dd-handle">
                  <i class="{!!$menu->icon!!}"></i>&nbsp;{!!$menu->name!!}
                  <span class="pull-right dd-nodrag">
                    <a class="fa fa-edit" href="{!!route('admin.menu.edit', $menu->id)!!}"></a>&nbsp;
                    <a class="fa fa-trash" href="#" data-toggle="modal" data-target="#DeleteModal" data-name="{!!$menu->name!!}" data-action="{!!route('admin.menu.destroy', $menu->id)!!}"></a>
                  </span>
                </div>
                @if($menu->submenus)
                  <ol class="dd-list">
                    @foreach($menu->submenus as $submenu)
                    <li class="dd-item" data-id="{!!$submenu->id!!}">
                      <div class="dd-handle">
                      <i class="{!!$submenu->icon!!}"></i>&nbsp;{!!$submenu->name!!}
                        <span class="pull-right dd-nodrag">
                          <a class="fa fa-edit" href="{!!route('admin.menu.edit', $submenu->id)!!}"></a>&nbsp;
                          <a class="fa fa-trash" href="#" data-toggle="modal" data-target="#DeleteModal" data-name="{!!$submenu->name!!}" data-action="{!!route('admin.menu.destroy', $submenu->id)!!}"></a>
                        </span>
                      </div>
                    </li>
                    @endforeach
                  </ol>
                @endif
              </li>
            @endforeach
          </ol>
        </div>
        <!-- /.dd -->
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <i class="fa fa-plus"></i>
        <h3 class="box-title">{!!trans('crud.create')!!}</h3>
      </div>
      <!-- /.box-header -->
      <form method="post" action="{!!route('admin.menu.store')!!}" class="form-horizontal">
        <div class="box-body">
          <div class="form-group col-md-12">
            <label for="name" class="col-sm-3 control-label">{!!trans('labels.menu.name')!!}</label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" class="form-control name" placeholder="{!!trans('labels.menu.name')!!}" value="{!!old('name')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="pid" class="col-sm-3 control-label">{!!trans('labels.menu.pid')!!}</label>
            <div class="col-sm-9">
              <select class="select2 form-control pull-right" style="width:100%" name="pid">
                <option value="0">{!!trans('labels.menuLevel')!!}</option>
                @foreach($menus as $menu)
                <option value="{{$menu->id}}" {!!old('pid') == $menu->id ? 'selected' : ''!!}>{{$menu->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="icon" class="col-sm-3 control-label">{!!trans('labels.menu.icon')!!}</label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                <input type="text" id="icon" name="icon" class="form-control icon" placeholder="{!!trans('labels.menu.icon')!!}" value="{!!old('icon')!!}">
              </div>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="slug" class="col-sm-3 control-label">{!!trans('labels.menu.slug')!!}</label>
            <div class="col-sm-9">
              <select class="select2" class="form-control" name="slug" id="slug" style="width:100%">
                <option id="none" value="0"></option>
                  @foreach($permissions as $permission)
                  <option value="{!!$permission->slug!!}" {!!old('slug') == $permission->slug ? 'selected' : ''!!}>{!!$permission->slug!!}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="url" class="col-sm-3 control-label">{!!trans('labels.menu.url')!!}</label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="url" name="url" class="form-control url" placeholder="{!!trans('labels.menu.url')!!}" value="{!!old('url')!!}">
              </div>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="description" class="col-sm-3 control-label">{!!trans('labels.menu.description')!!}</label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="description" name="description" class="form-control description" placeholder="{!!trans('labels.menu.description')!!}" value="{!!old('description')!!}">
              </div>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="sort" class="col-sm-3 control-label">{!!trans('labels.menu.sort')!!}</label>
            <div class="col-sm-9">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="sort" name="sort" class="form-control sort" placeholder="{!!trans('labels.menu.sort')!!}" value="{!!old('sort')!!}">
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
                <button type="submit" class="btn btn-primary pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">{!!trans('crud.submit')!!}</button>
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
<link href="{{ asset("/s/plugins/select2/select2.min.css")}}" rel="stylesheet" type="text/css" />
@endsection

@section('js') 
<script type="text/javascript" src="{{ asset("/s/plugins/select2/select2.full.min.js") }}"></script>
<script type="text/javascript" src="{!! asset('s/plugins/nestable/jquery.nestable.js') !!}"></script>
<link href="{!! asset('s/plugins/nestable/nestable.css') !!}" rel="stylesheet">
<script type="text/javascript">
$(function() {
  $('.dd').nestable({ /* config options */ });
  $(".select2").select2();
  $('#DeleteModal').on('show.bs.modal', function(event) {
    var a = $(event.relatedTarget) // Button that triggered the modal 当前点击的对象
    var action = a.data('action') //从点击的对象获取属性值
    var name = a.data('name') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-header h4').text("{{trans('alerts.menus.deleteTitle')}}" + name)
    modal.find('.modal-footer form').attr('action', action)
  });
});
</script>
@endsection
