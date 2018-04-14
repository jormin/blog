@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('errors._errors')
                @include('errors._success')
                <div class="VivaTimeline">
                    <dl>
                        @foreach($articles as $key => $subarticles)
                            <dt>{{ $key }}</dt>
                            @foreach($subarticles as $subkey => $article)
                                @if($article->index % 2 == 0)
                                    <dd class="pos-left clearfix">
                                @else
                                    <dd class="pos-right clearfix">
                                @endif
                                <div class="circ"></div>
                                    <div class="time">{{ $article->date }}</div>
                                    <div class="events">
                                        <div class="events-header">
                                            @if($article->column)
                                                <span class="article-column">{{ $article->column }}</span>
                                            @endif
                                            <a href="{{ route('articles.show',$article->uuid) }}">
                                                {{ $article->title }}
                                            </a>
                                        </div>
                                        <div class="events-body">
                                            <div class="row">
                                                <div class="events-desc">
                                                    {{ $article->excerpt }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="events-footer">
                                            <span><i class="fa fa-clock-o"></i> {{ date('Y年m月d日 H时i分',strtotime($article->created_at)) }}</span>
                                            <span><i class="fa fa-eye"></i> {{$article->viewnum}}</span>
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
                                </dd>
                            @endforeach
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/timeline/css/jquery.eeyellow.Timeline.css') }}" />
    <style>
        .edit-article-btn{
            margin-right: 10px;
        }
        .article-column{
            border: 1px solid #fff;
            padding: 2px;
            font-size: 14px;
            background: #fff;
            color: #4fc1e9;
            border-radius: 5px;
        }
    </style>
@endpush
