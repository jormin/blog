@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12">
                    <div id="content-editormd-view" class="markdown-body editormd-html-preview">
                        <div class="title-wrap text-left">
                            <h1>{{ $article->title }}</h1>
                            <div class="text-left article-count">
                                <span>发布于{{$article->created_at->diffForHumans()}}</span>
                                ⋅
                                <span>{{$article->viewnum}}阅读</span>
                                @if (Auth::user() && Auth::user()->name === 'admin')
                                    <span class="pull-right">
                                        {!! Form::open(['route'=>['articles.destroy',$article->uuid],'method'=>'delete']) !!}
                                            <a href=":;" onclick="event.preventDefault();$(this).closest('form').submit();" title="删除文章">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        {!! Form::close() !!}
                                    </span>
                                    <span class="pull-right edit-article-btn">
                                        <a href="{{ route('articles.edit',$article->uuid) }}">
                                            <i class="fa fa-pencil text-danger"></i>
                                        </a>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {!! $article->content_html !!}
                        @include("common._socialShare")
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/editormd/css/editormd.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/editormd/css/editormd.preview.css') }}">
    <style>
        .edit-article-btn{
            margin-right: 10px;
        }
        #content-editormd-view{
            padding-top: 0;
            background-color: rgba(255,255,255,0.3);
        }
        .article-count{
            color: #aaa;
        }
        .editormd-html-preview h3,h4,h5,h6{
            border-bottom: 0 !important;
        }
        .editormd-html-preview h1,h2{
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .editormd-html-preview code{
            background-color: rgba(255,255,255,0.1);
            border:0;
        }
        .editormd-html-preview blockquote{
            border-left: 4px solid rgba(255, 255, 255, 0.1);
        }
        .editormd-html-preview pre.prettyprint{
            border: 1px solid rgba(255,255,255,0.1);
            background-color: rgba(255,255,255,0.1);
        }
        .editormd-html-preview pre.prettyprint li.L1, li.L3, li.L5, li.L7, li.L9 {
            background-color: transparent;
        }
        .editormd-html-preview img{
            margin: 0 auto;
            display: block;
        }
        .title-wrap{
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .title-wrap h1{
            border:0;
            padding-bottom: 12px;
            margin-bottom: 0;
            border-bottom: 0 !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(function() {
            $("#content-editormd-view").append($(".social-share"));
        });
    </script>
@endpush
