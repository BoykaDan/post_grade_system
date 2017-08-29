@extends('article_system.layouts.master')

@section('page-header')
    <header class="intro-header"
            style="background-image: url('{{ page_image($page_image) }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                {{--分类列表 --}}
                @foreach ($grades as $gradess)

                    <div class="post-preview">
                        <a href="{{ $gradess->url() }}">
                            <h2 class="post-title">{{ $gradess->title }}</h2>
                            @if ($gradess->subtitle)
                                <h3 class="post-subtitle">{{ $gradess->subtitle }}</h3>
                            @endif
                        </a>
                        <p class="post-meta">
                            上传日期： {{ $gradess->updated_at->format('F j  Y') }}

                        </p>
                    </div>
                    <hr>
                @endforeach
                {{-- 分页 --}}
            </div>

        </div>
    </div>
@stop