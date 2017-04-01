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
          <a type="button" class="btn btn-sm btn-default" href="{!!Route('admin.menu')!!}"><i class="fa fa-arrow-left"></i> {!!trans('crud.back')!!}</a>
        </div>
      </div>
      <!-- /.box-header -->
      <form method="post" action="{!!route('admin.menu.edit', $m->id)!!}" class="form-horizontal">
        <div class="box-body">
          <div class="form-group col-md-12">
            <label for="name" class="col-sm-2 control-label">菜单名称</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" class="form-control name" placeholder="输入 菜单名称" value="{!!$m->name!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="pid" class="col-sm-2 control-label">父级菜单</label>
            <div class="col-sm-8">
              <select class="select2 form-control pull-right" style="width:100%" name="pid">
                <option value="0">顶级菜单</option>
                @foreach($menus as $menu)
                <option value="{{$menu->id}}" {!!$m->pid == $menu->id ? 'selected' : ''!!}>{{$menu->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="icon" class="col-sm-2 control-label">图标</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bars"></i></span>
                <input type="text" id="icon" name="icon" class="form-control icon" placeholder="输入 图标" value="{!!$m->icon!!}">
              </div>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="slug" class="col-sm-2 control-label">权限</label>
            <div class="col-sm-8">
              <select class="select2" class="form-control" name="slug" id="slug" style="width:100%">
                <option id="none" value="0"></option>
                  @foreach($permissions as $permission)
                  <option value="{!!$permission->slug!!}" {!!$m->slug == $permission->slug ? 'selected' : ''!!}>{!!$permission->slug!!}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="url" class="col-sm-2 control-label">地址</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="url" name="url" class="form-control url" placeholder="输入 地址" value="{!!$m->url!!}">
              </div>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="description" class="col-sm-2 control-label">描述</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="description" name="description" class="form-control description" placeholder="输入 描述" value="{!!$m->description!!}">
              </div>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label for="sort" class="col-sm-2 control-label">排序</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="sort" name="sort" class="form-control sort" placeholder="输入 排序" value="{!!$m->sort!!}">
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
