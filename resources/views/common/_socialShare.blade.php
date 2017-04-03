<div class="social-share" data-url="{{ Request::url() }}" data-title="{{ $article->title }}" data-sites="weibo,qq,wechat,qzone,tencent,douban" data-mobile-sites="weibo,qq,qzone,tencent,douban"></div>

@push('styles')
    <link rel="stylesheet" href="{{ asset("vendor/share/css/share.min.css") }}" type="text/css" />
    <style>
        .social-share{
            border-top:1px dashed #ddd;
            padding: 15px 0 0 15px;
            margin-top: 30px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset("vendor/share/js/social-share.min.js") }}" type="text/javascript"></script>
@endpush