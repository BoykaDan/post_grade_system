@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>分类 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="/admin/grade/create" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新的分类
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('admin.partials.errors')
                @include('admin.partials.success')

                <table id="grades-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>分类</th>
                        <th>标题</th>
                        <th class="hidden-sm">副标题</th>
                        <th class="hidden-md">页面图像</th>
                        <th class="hidden-md">内容描述</th>
                        <th class="hidden-md">布局</th>
                        <th class="hidden-sm">排序方式</th>
                        <th data-sortable="false">行为</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $grade->grade }}</td>
                            <td>{{ $grade->title }}</td>
                            <td class="hidden-sm">{{ $grade->subtitle }}</td>
                            <td class="hidden-md">{{ $grade->page_image }}</td>
                            <td class="hidden-md">{{ $grade->meta_description }}</td>
                            <td class="hidden-md">{{ $grade->layout }}</td>
                            <td class="hidden-sm">
                                @if ($grade->reverse_direction)
                                    倒序
                                @else
                                    正序
                                @endif
                            </td>
                            <td>
                                <a href="/admin/grade/{{ $grade->id }}/edit" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 修改
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {
            $("#grades-table").DataTable({
            });
        });
    </script>
@stop