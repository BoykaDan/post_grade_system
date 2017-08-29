@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>注意!</strong>
        您输入的内容存在问题。.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif