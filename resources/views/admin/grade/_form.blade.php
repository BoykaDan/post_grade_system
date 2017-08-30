<div class="form-group">
    <label for="grade" class="col-md-3 control-label">分类</label>
    <div class="col-md-3">
        <input type="text" class="form-control" name="grade" id="grade" value="{{ $grade }}" autofocus>
    </div>
</div>

<div class="form-group">
    <label for="title" class="col-md-3 control-label">
        标题
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="title" id="title" value="{{ $title }}">
    </div>
</div>

<div class="form-group">
    <label for="subtitle" class="col-md-3 control-label">
        副标题
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $subtitle }}">
    </div>
</div>

<div class="form-group">
    <label for="meta_description" class="col-md-3 control-label">
        内容描述
    </label>
    <div class="col-md-8">
        <textarea class="form-control" id="meta_description" name="meta_description" rows="3">
            {{ $meta_description }}
        </textarea>
    </div>
</div>

<div class="form-group">
    <label for="page_image" class="col-md-3 control-label">
        页面图像
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="page_image" id="page_image" value="{{ $page_image }}">
    </div>
</div>

<div class="form-group">
    <label for="layout" class="col-md-3 control-label">
        布局
    </label>
    <div class="col-md-4">
        <input type="text" class="form-control" name="layout" id="layout" value="{{ $layout }}">
    </div>
</div>
    <div class="form-group">
        <label for="grades" class="col-md-3 control-label">
            父分类:
        </label>
        <div class="col-md-8">
            <select name="father_grade[]"  class="form-control">
                {{--id="father_grade"--}}
            @foreach ($allGrades as $grade)
                    <option @if (in_array($grade, $father_grade)) selected @endif
                    value="{{ $grade }}">
                        {{ $grade }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>



<div class="form-group">
    <label for="reverse_direction" class="col-md-3 control-label">
        排序方式
    </label>
    <div class="col-md-7">
        <label class="radio-inline">
            <input type="radio" name="reverse_direction" id="reverse_direction"
                   @if (! $reverse_direction)
                   checked="checked"
                   @endif
                   value="0">
            顺序
        </label>
        <label class="radio-inline">
            <input type="radio" name="reverse_direction"
                   @if ($reverse_direction)
                   checked="checked"
                   @endif
                   value="1">
            逆序
        </label>
    </div>
</div>