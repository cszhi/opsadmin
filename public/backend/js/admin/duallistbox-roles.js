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