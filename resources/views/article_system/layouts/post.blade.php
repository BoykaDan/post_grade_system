@extends('article_system.layouts.master', [
  'title' => $post->title,
  'meta_description' => $post->meta_description ?: config('blog.description'),
])

@section('page-header')
  <header class="intro-header"
          style="background-image: url('{{ page_image($post->page_image) }}')">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <div class="post-heading">
            <h1>{{ $post->title }}</h1>
            <h2 class="subheading">{{ $post->subtitle }}</h2>
            <span class="meta">
              发布日期： {{ $post->publish_at->format('F j, Y') }}
              @if ($post->grades->count())
                分类：
                {!! join(', ', $post->gradeLinks()) !!}
              @endif
            </span>
          </div>
        </div>
      </div>
    </div>
  </header>
@stop

@section('content')

  {{-- The Post --}}
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          {!! $post->content_html !!}
        </div>
      </div>
    </div>
  </article>

  {{-- The Pager --}}
  <div class="container">
    <div class="row">
      <ul class="pager">
        @if ($grade && $grade->reverse_direction)
          @if ($post->olderPost($grade))
            <li class="previous">
              <a href="{!! $post->olderPost($grade)->url($grade) !!}">
                <i class="fa fa-long-arrow-left fa-lg"></i>
                先前的 {{ $grade->grade }} 文章
              </a>
            </li>
          @endif
          @if ($post->newerPost($grade))
            <li class="next">
              <a href="{!! $post->newerPost($grade)->url($grade) !!}">
                下一篇 {{ $grade->grade }} 文章
                <i class="fa fa-long-arrow-right"></i>
              </a>
            </li>
          @endif
        @else
          @if ($post->newerPost($grade))
            <li class="previous">
              <a href="{!! $post->newerPost($grade)->url($grade) !!}">
                <i class="fa fa-long-arrow-left fa-lg"></i>
                下一篇 {{ $grade ? $grade->grade : '' }} 新文章
              </a>
            </li>
          @endif
          @if ($post->olderPost($grade))
            <li class="next">
              <a href="{!! $post->olderPost($grade)->url($grade) !!}">
                下一篇 {{ $grade ? $grade->grade : '' }}旧文章
                <i class="fa fa-long-arrow-right"></i>
              </a>
            </li>
          @endif
        @endif
      </ul>
    </div>

  </div>
@stop
