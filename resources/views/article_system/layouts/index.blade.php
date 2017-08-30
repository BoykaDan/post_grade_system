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
                {{--文章分类列表--}}

                @if($gradesss)
                    @if($gradesss->count())
                    所属的子分类：
                @foreach ($gradesss as $gradess)
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
                    @endif
                @endif


                 {{--文章列表 --}}
                @if($posts)
                    @if($posts->count())
                所属文章：
                    @endif
                @endif
                @foreach ($posts as $post)
                    <div class="post-preview">
                        <a href="{{ $post->url($grade) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            @if ($post->subtitle)
                                <h3 class="post-subtitle">{{ $post->subtitle }}</h3>
                            @endif
                        </a>
                        <p class="post-meta">
                            上传日期： {{ $post->publish_at->format('F j  Y') }}
                            @if ($post->grades->count())
                                分类：
                                {!! join(', ', $post->gradeLinks()) !!}
                            @endif
                        </p>
                    </div>
                    <hr>
                @endforeach
                {{-- 分页 --}}
                <ul class="pager">

                    {{-- Reverse direction --}}
                    @if ($reverse_direction)
                        @if ($posts->currentPage() > 1)
                            <li class="previous">
                                <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
                                    <i class="fa fa-long-arrow-left fa-lg"></i>
                                    先前 {{ $grade->grade }} 的文章
                                </a>
                            </li>
                        @endif
                        @if ($posts->hasMorePages())
                            <li class="next">
                                <a href="{!! $posts->nextPageUrl() !!}">
                                    下一篇 {{ $grade->grade }} 的文章
                                    <i class="fa fa-long-arrow-right"></i>
                                </a>
                            </li>
                        @endif
                    @else
                        @if ($posts->currentPage() > 1)
                            <li class="previous">
                                <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
                                    <i class="fa fa-long-arrow-left fa-lg"></i>
                                    上篇 {{ $grade ? $grade->grade : '' }} 的文章
                                </a>
                            </li>
                        @endif
                        @if ($posts->hasMorePages())
                            <li class="next">
                                <a href="{!! $posts->nextPageUrl() !!}">
                                    下篇 {{ $grade ? $grade->grade : '' }} 的文章
                                    <i class="fa fa-long-arrow-right"></i>
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>

        </div>
    </div>
@stop