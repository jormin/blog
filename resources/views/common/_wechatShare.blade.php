@push('scripts')
<script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $wechatjs->config(array('onMenuShareAppMessage', 'onMenuShareTimeline','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone'), false) ?>);
    wx.ready(function(){
        //分享
        var shareoption = {
            title: "{!! $wx["title"] !!}", // 分享标题
            desc: "{!! $wx["desc"] !!} ", // 分享描述
            link: "{{$wx["link"]}}", // 分享链接
            imgUrl: "{{ $wx["imgUrl"] }}", // 分享图标
        };
        wx.onMenuShareTimeline(shareoption);
        wx.onMenuShareAppMessage(shareoption);
        wx.onMenuShareQQ(shareoption);
        wx.onMenuShareWeibo(shareoption);
        wx.onMenuShareQZone(shareoption);
    });
</script>
@endpush