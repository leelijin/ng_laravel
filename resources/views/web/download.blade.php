<!DOCTYPE html>
<html lang="ch">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta name="screen-orientation" content="portrait">
    <meta name="x5-orientation" content="portrait">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <link rel="Shortcut Icon" href="images/favicon.ico" >
    <title>颠覆吧NG</title>
    <style>
        article,body,footer,h1,h2,h3,h4,h5,h6,header,html,li,p,section,ul{padding:0;margin:0}
        a{text-decoration:none;}
        img{display:block;border:0 none;}
        body,html{height:100%;font-size: 62.5%; font-family:Tahoma,Arial,Roboto,"Droid Sans","Helvetica Neue","Droid Sans Fallback",Microsoft YaHei,"Heiti SC","Hiragino Sans GB",Simsun,sans-self;}
        body{position: relative;margin: auto;cursor:pointer;background: #000;}
        .wp{position:absolute;left:0;right:0;top:0;bottom:0;background: url('{{asset('public/img')}}/bg.png') no-repeat;background-size: cover;line-height: 2;color:#fff;}

        .header{position:relative;padding-top: 200px;}
        .header img{ width: 89%;margin: auto;position: absolute;top: -50px;left: 5.5%;}
        .title{font-size: 3rem;font-weight: normal;text-align: center;}
        .title2{font-size: 1.4rem;text-align: center;}

        .footer{padding-bottom: 40px;width: 100%;position: absolute;bottom: 0;left: 0;}
        .tips{font-size: 1.4rem;text-align: center;}
        .btn img{width: 52%;margin: 20px auto;}

    </style>

    <script type="text/javascript">
        /*判断系统*/
        if (/android|ipad|iphone|mac/i.test(navigator.userAgent)){
            window.onload=function(){
                setTimeout(function(){
                    //window.location.href="http://a.app.qq.com/o/simple.jsp?pkgname=com.huaxi100.cdfaner";
                },2000);
            }
        }

    </script>
</head>
<body id="body">
<div class="wp" id="wp">
    <div class="header">
        <img src="{{asset('public/img')}}/logo.png" alt="颠覆吧NG">
        <h1 class="title">颠覆吧NG</h1>
        <p class="title2">颠覆吧，颠覆你的游戏体验！</p>
    </div>

    <div class="footer" id="footer">
        <a class="btn" href=""><img src="{{asset('public/img')}}/btnAnd.png" alt="颠覆吧NG"></a>
        <a class="btn" href=""><img src="{{asset('public/img')}}/btnIos.png" alt="颠覆吧NG"></a>
        <p class="tips">请在浏览器中打开此页面，将自动跳转至下载市场</p>
    </div>
</div>

</body>
</html>
