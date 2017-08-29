{{-- Create Folder Modal --}}
<div class="modal fade" id="modal-folder-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="/admin/upload/folder"
            class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="folder" value="{{ $folder }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title">新建文件夹</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="new_folder_name" class="col-sm-3 control-label">
              文件夹命名
            </label>
            <div class="col-sm-8">
              <input type="text" id="new_folder_name" name="new_folder"
                     class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">
            取消
          </button>
          <button type="submit" class="btn btn-primary">
            新建文件夹
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Delete File Modal --}}
<div class="modal fade" id="modal-file-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p class="lead">
          <i class="fa fa-question-circle fa-lg"></i> &nbsp;
          确定要删除
          <kbd><span id="delete-file-name1">文件</span></kbd>
          这个文件?
        </p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="/admin/upload/file">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="folder" value="{{ $folder }}">
          <input type="hidden" name="del_file" id="delete-file-name2">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            取消
          </button>
          <button type="submit" class="btn btn-danger">
            删除文件
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Delete Folder Modal --}}
<div class="modal fade" id="modal-folder-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">Please Confirm</h4>
      </div>
      <div class="modal-body">
        <p class="lead">
          <i class="fa fa-question-circle fa-lg"></i> &nbsp;
          确认要删除
          <kbd><span id="delete-folder-name1">文件夹</span></kbd>
          这个文件夹吗?
        </p>
      </div>
      <div class="modal-footer">
        <form method="POST" action="/admin/upload/folder">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="folder" value="{{ $folder }}">
          <input type="hidden" name="del_folder" id="delete-folder-name2">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            取消
          </button>
          <button type="submit" class="btn btn-danger">
            删除文件夹
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Upload File Modal --}}
<div class="modal fade" id="modal-file-upload">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="/admin/upload/file"
            class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="folder" value="{{ $folder }}">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title">上传新的文件</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="file" class="col-sm-3 control-label">
              文件
            </label>
            <div class="col-sm-8">
              <input type="file" id="file" name="file">
            </div>
          </div>
          <div class="form-group">
            <label for="file_name" class="col-sm-3 control-label">
              选择上传到的文件夹/命名并上传或直接命名并上传
            </label>
            <div class="col-sm-4">
              <input type="text" id="file_name" name="file_name"
                     class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            取消
          </button>
          <button type="submit" class="btn btn-primary">
            上传文件
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- View Image Modal --}}
<div class="modal fade" id="modal-image-view">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title">图片预览</h4>
      </div>
      <div class="modal-body">
        <img id="preview-image"  class="img-responsive">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          取消
        </button>
      </div>
    </div>
  </div>
</div>