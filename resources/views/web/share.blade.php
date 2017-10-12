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
            background: url('images/homebg.png') no-repeat;
            background-size: cover;
            font-size: .28rem;
            line-height: 1.8;
            text-align: center;
        }
        .bubble {
            width: 3.9rem;
            height: 1.3rem;
            margin: 1rem auto 0 .5rem;
            padding: .5rem .2rem .5rem;
            background: url('images/paopao.png') no-repeat;
            background-size: 100% auto;
            color: #fff;
        }
        .bubble img {
            width: 2.4rem;
            vertical-align: bottom;
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
    </style>

</head>

<body id="body">
<div class="bubble">
    <p>
        我在<img src="images/logo2.png" alt="" /><br />
        超越了<em>{{$info['beyond_rate'] or '0%'}}</em>的小伙伴！
    </p>
</div>
<img class="title" src="images/logo1.png" alt="" />
<div class="userInfo">
    <img class="userPhoto" src="{{$info['avatar']}}" alt="" />
    <p class="userName">{{$info['nickname']}}</p>
    <p class="level">第{{$info['current_level']}}关</p>
</div>
<a href="dianfuba://home?uid={{$info['uid'] or 0}}&nickname={{$info['nickname'] or '无'}}" class="start">
    <img src="images/start.png" alt="" />
</a>

</body>
</html>

