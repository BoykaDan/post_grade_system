@extends('admin.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">修改密码</div>
                <form class="login-form" action="" method="post">
                    @if($errors->first())
                        <div class="alert alert-danger display-hide" style="display: block;">
                            <button class="close" data-close="alert"></button>
                            <span>   </span>
                        </div>
                    @endif
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">原始密码</label>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Old Password" name="oldpassword"> </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">新密码</label>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="New password" name="password"> </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">重复密码</label>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Repeat password" name="password_confirmation"> </div>
                    <div class="form-actions">
                        <button type="submit" id="register-submit-btn" class="btn btn-primary">确定</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
