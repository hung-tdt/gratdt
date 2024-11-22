@extends('admin.component.main') 

@section('content')
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ $title }}</h2>             
    </div>         
  </div>
  <a href="{{ url()->previous() }}" class="btn btn-primary mt20 mb20">Back</a>

  <form action="" method="POST" enctype="multipart/form-data">
    <div class="card-body pb40">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Role name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="nhập tên">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="display_name">Describe</label>
          <input type="text" name="description" value="{{ old('description') }}" class="form-control" placeholder="nhập mô tả">
        </div>
      </div>
  
      <div class="row mt30">
        <div class="col-md-12  mt10">
          <label>
            <input class="checkall" type="checkbox">
          </label>
          CheckAll
        </div>
        <div class="col-md-12">
          @foreach($permissionsParent as $permissionsParentItem)
          <div class="card border-primary mb-3 col-md-12 mtt30">
            <div class="card-header bggray">
              <label>
                <input class="checkbox_wrapper" type="checkbox">
              </label>
              Module {{$permissionsParentItem->name}}
            </div>
  
            <div class="row">
              @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
              <div class="card-body text-primary col-md-3">
                <label>
                  <input class="checkbox_childrent" type="checkbox" name="permission_id[]" value="{{$permissionsChildrentItem->id}}">
                </label>
                {{$permissionsChildrentItem->name}}
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="card-footer mt20">
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
      @csrf
    </div> 
  </form>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
    $('.checkbox_wrapper').on('click', function () {
      var $checkboxes = $(this).parents('.card').find('.checkbox_childrent');
      $checkboxes.prop('checked', $(this).prop('checked'));
      updateCheckAll($(this), $checkboxes);
    });
  
    $('.checkall').on('click', function () {
      var $checkboxes = $(this).parents().find('.checkbox_childrent');
      $checkboxes.prop('checked', $(this).prop('checked'));
      updateCheckAll($(this), $checkboxes);
    });
  
    $('.checkbox_childrent').on('click', function () {
      var $checkboxes = $(this).parents('.card').find('.checkbox_childrent');
      updateCheckAll($(this), $checkboxes);
    });
  
    function updateCheckAll($triggerCheckbox, $checkboxes) {
      var $wrapperCheckbox = $triggerCheckbox.parents('.card').find('.checkbox_wrapper');
      var isAllChecked = $checkboxes.length === $checkboxes.filter(':checked').length;
      $wrapperCheckbox.prop('checked', isAllChecked);
      updateCheckAllParent($triggerCheckbox.parents('.row'));
    }
  
    function updateCheckAllParent($row) {
      var $wrapperCheckboxes = $row.find('.checkbox_wrapper');
      var $parentRow = $row.parents('.row');
      if ($parentRow.length > 0) {
        var $parentWrapperCheckboxes = $parentRow.find('.checkbox_wrapper');
        var isAllChecked = $parentWrapperCheckboxes.length === $parentWrapperCheckboxes.filter(':checked').length;
        $wrapperCheckboxes.prop('checked', isAllChecked);
        updateCheckAllParent($parentRow);
      }
    }
  </script>
@endsection
