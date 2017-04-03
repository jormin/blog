@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model($article,['route'=>['articles.update',$article->uuid],'method'=>'patch','class'=>'form-horizontal']) !!}
                    @include('errors._errors')
                    @include('errors._success')
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'请输入文章标题']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div id="content-editormd">
                                {!! Form::textarea('content',null,['class'=>'form-control','style'=>'display:none']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::textarea('content_html',null,['class'=>'form-control','style'=>'display:none']) !!}
                    <div class="form-group">
                        <div class="col-sm-12 text-center">
                            {!! Form::button('保存文章',['class'=>'btn btn-success btn-save']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/editormd/css/editormd.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('vendor/editormd/editormd.min.js') }}"></script>
<script>
    $(function() {
        var content_editormd = editormd("content-editormd", {
            width   : "100%",
            height  : 450,
            path : '{{ asset('vendor/editormd/lib') }}/',
            imageUpload    : true,
            imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : "{{ route('articles.uploadimg') }}",
        });
        $(".btn-save").click(function(){
            $("textarea[name=content_html]").val(content_editormd.getPreviewedHTML());
            $(this).closest('form').submit();
        })
    });
</script>
@endpush