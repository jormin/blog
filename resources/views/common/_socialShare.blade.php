<div class="social-share" data-url="{{ Request::url() }}" data-title="{{ $article->title }}" data-sites="weibo,qq,wechat,qzone,tencent,douban" data-mobile-sites="weibo,qq,qzone,tencent,douban"></div>

@push('styles')
    <link rel="stylesheet" href="{{ asset("vendor/share/css/share.min.css") }}" type="text/css" />
    <style>
        .social-share{
            border-bottom:1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 0;
            margin-top: 30px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset("vendor/share/js/social-share.min.js") }}" type="text/javascript"></script>
@endpush