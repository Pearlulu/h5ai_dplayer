<?php 

$cat_user = 'admin';
$cat_password = 'admin';

$cat_salt = 'salt';

//如果cookie空，POST用户名密码不为空
if(isset($_POST['username']) && isset($_POST['password'])) {
    //验证输入密码是否匹配
    if(md5($_POST['username'].$_POST['password'].$cat_salt)===md5($cat_user.$cat_password.$cat_salt)) {
        //设置cookie
        setcookie('verify',md5($cat_user.$cat_password.$cat_salt),time()+86400*30);
        header("location:/");
    } else {
        die('帐号或者密码错误，请返回重试！');
    }
}

//检测cookie
if(empty($_COOKIE['verify']) || $_COOKIE['verify']!=md5($cat_user.$cat_password.$cat_salt)) {
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <style type="text/css">
    * {
        box-sizing: border-box;
    }
    input {
        outline: 0!important;
    }
    button, input, optgroup, select, textarea {
        font-family: sans-serif;
        font-size: 16px;
        line-height: 1.15;
        margin: 0;
    }
    input[type=password], input[type=text], select, textarea {
        padding: .5em 0;
        line-height: 1;
        display: block;
        border: 0;
        border-bottom: 1px solid #ddd;
        transition: border .2s ease;
        width: 100%;
        background: transparent;
    }
    input[type=submit] {
        border: 0;
        padding: .5em 1em;
        border-radius: .1em;
        cursor: pointer;
        background: #2196f3;
        color: #fff;
        border: 1px solid rgba(0,0,0,.05);
        box-shadow: 0 0 5px rgba(0,0,0,.05);
        transition: all .1s ease;
    }
    input[type=submit]:hover {
        background-color: #1e88e5;
    }
    #login {
        background: #fff;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    #login form {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        max-width: 16em;
        width: 90%;
    }
    #login h1 {
        text-align: center;
        font-size: 2.5em;
        margin: -0.4em 0 .67em;
    }
    #login input {
        width: 100%;
        margin: .5em 0 0;
    }
    #login input[type=password], #login input[type=text] {
        padding: .5em 1em;
        border: 1px solid #e9e9e9;
        transition: border .2s ease;
        color: #333;
    }
    #login input[type=password]:focus, #login input[type=password]:hover, #login input[type=text]:focus, #login input[type=text]:hover {
        border-color: #9f9f9f;
    }
    </style>
</head>
<body>
    <div id="login">
        <form action="/" method="post">
            <h1>请登录</h1>
            <input name="username" type="text" placeholder="用户名"> 
            <input name="password" type="password" placeholder="密码">
            <input type="submit" value="登录">
        </form>
    </div>
</body>
</html>
    <?php
    die(1);
}

?>
