<!DOCTYPE html>
<html lang="ch">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="description" content="颠覆吧NG">
    <meta name="keywords" content="颠覆吧NG">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <title>颠覆吧NG</title>
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if (deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
    <style>
        article,body,footer,h1,h2,h3,h4,h5,h6,header,html,li,p,section,ul{padding:0;margin:0}
        ul{list-style:none;}
        a{text-decoration:none;}
        em,i{font-style:normal}
        body{
            background: url({{asset('public/img/share/homebg.png')}}) no-repeat;
            background-size: cover;
            font-size: .28rem;
            line-height: 1.8;
            text-align: center;
        }
        .bubble {
            width: 3.9rem;
            height: 0.1rem;
            margin: 1rem auto 0 .5rem;
            padding: .5rem .2rem .5rem;
            {{--background: url({{asset('public/img/share/paopao.png')}}) no-repeat;--}}
            background-size: 100% auto;
            color: #fff;
        }
        .bubble p {
            line-height: 1.3rem;
        }
        .bubble img {
            width: 2.4rem;
            vertical-align: middle;
        }
        .bubble em {
            color: #f39b39;
            text-shadow: 0 .01rem #937046, .01rem 0 #937046, -.01rem 0 #937046, 0 -.01rem #937046;
        }
        .title {
            display:block;
            border:none;
            width: 5.35rem;
            margin: -.4rem auto 0;
        }
        .userInfo {
            color: #937046;
        }
        .userPhoto {
            display:block;
            width: 1.2rem;
            height: 1.2rem;
            margin: auto;
            border: .03rem solid #fff;
            border-radius: .1rem;

        }
        .userName {
            font-size: .36rem;
            font-weight: 700;
        }
        .level {
            margin-bottom: .5rem;
        }
        .start img {
            display:block;
            border:none;
            width: 3.7rem;
            margin: auto;
        }
        .btn {
            display: block;
            color: #fff;
            width: 2rem;
            height: .8rem;
            margin: 0 auto .2rem;
            background: #00c073;
            line-height: .8rem;
            border-radius: .4rem;
        }
    </style>

</head>

<body id="body">
<div class="bubble">
    <p>
    </p>
</div>
<img class="title" src="{{asset('public/img/share/logo1.png')}}" alt="" />
<div class="userInfo">
    <img class="userPhoto" src="{{$info['avatar']}}" alt="" />
    <p class="userName">{{$info['nickname']}}</p>
    <p class="level">实力星级<em>{{$info['current_level']}}</em>星</p>
</div>


    <a class="btn" href="#" id="click_href">添加好友</a>

    <a class="btn android" href="{{env('APP_URL')}}/public/download/dianfuba_0912.apk">安卓下载</a>

    <a class="btn ios" href="https://itunes.apple.com/us/app/颠覆吧ng/id1236015707?l=zh&ls=1&mt=8">IOS下载</a>

<script>
    var ios_click = "https://www.dianfubang.com/home?uid={{$info['uid'] or 0}}&nickname={{$info['nickname'] or '无'}}";
    var android_click = "dianfuba://home?uid={{$info['uid'] or 0}}&nickname={{$info['nickname'] or '无'}}";
    if (/ipad|iphone|mac/i.test(navigator.userAgent)){
        window.onload=function(){
            document.getElementById('click_href').setAttribute('href',ios_click);
            document.getElementById('click_href').onclick=function () {
                setTimeout(function(){
                    window.location.href="https://itunes.apple.com/us/app/颠覆吧ng/id1236015707?l=zh&ls=1&mt=8";
                },5000);
            };

        }
    }else if(/android/i.test(navigator.userAgent)){
        window.onload=function(){
            document.getElementById('click_href').setAttribute('href',android_click);

            document.getElementById('click_href').onclick=function () {
                setTimeout(function(){
                    window.location.href="{{env('APP_URL')}}/public/download/dianfuba_0912.apk";
                },5000);
            };

        }
    }
</script>
</body>
</html>

