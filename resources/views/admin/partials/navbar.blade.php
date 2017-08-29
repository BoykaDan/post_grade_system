
<ul class="nav navbar-nav">
    <li><a href="/">文章系统-主页</a></li>
    @if (Auth::check())
        <li @if (Request::is('admin/post*')) class="active" @endif>
            <a href="/admin/post">文章</a>
        </li>
        <li @if (Request::is('admin/grade*')) class="active" @endif>
            <a href="/admin/grade">分类</a>
        </li>
        <li @if (Request::is('admin/upload*')) class="active" @endif>
            <a href="/admin/upload">上传</a>
        </li>
    @endif
</ul>

<ul class="nav navbar-nav navbar-right">
    @if (Auth::guest())
        {{--<li><a href="/auth/login">Login</a></li>--}}
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-expanded="false">
                {{ Auth::user()->name }}
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="/auth/reset">修改密码</a></li>
                <li><a href="/auth/logout">退出</a></li>

            </ul>
        </li>
    @endif
</ul>
