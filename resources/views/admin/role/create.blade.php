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
          <a type="button" class="btn btn-sm btn-default" href="{!!Route('admin.role')!!}"><i class="fa fa-arrow-left"></i> 返回</a>
        </div>
      </div>
      <!-- /.box-header -->
      <form method="post" action="{!!route('admin.role.store')!!}" class="form-horizontal">
        <div class="box-body">
          <div class="form-group col-md-12">
            <label for="name" class="col-sm-2 control-label">角色名称</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="name" name="name" class="form-control name" placeholder="输入 角色名称" value="{!!old('name')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="slug" class="col-sm-2 control-label">角色</label>
            <div class="col-sm-8">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                <input type="text" id="slug" name="slug" class="form-control slug" placeholder="输入 角色" value="{!!old('slug')!!}">
              </div>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="permission" class="col-sm-2 control-label">权限</label>
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

@section('addon') 
{{--
@include('shared.select2')

<script type="text/javascript">
$(function() {
  $(".select2").select2({allowClear: true});
});
</script>
--}}
@include('shared.duallistbox')

<script type="text/javascript">
$(function() {
  var roles = $('#permissionSelect').bootstrapDualListbox({
    nonSelectedListLabel: '未选',
    selectedListLabel: '已选',
    // preserveSelectionOnMove: 'moved',
    moveOnSelect: false,
    filterPlaceHolder:'过滤',
    moveSelectedLabel:'移动选择',
    moveAllLabel:'移动所有',
    removeSelectedLabel:'移除选择',
    removeAllLabel:'移除所有',
    infoText:'共{0}项',
    infoTextEmpty:'空'
    //nonSelectedFilter: 'ion ([7-9]|[1][0-2])'
  });
});
</script>
@endsection
