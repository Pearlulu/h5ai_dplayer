2020.02.06  
 
更新dplayer到最新dev版本(修复了和flv.js搭配产生的BUG)  
更新hls到最新版本(修复了特殊文件名BUG，总算不用hack了)  
增加flv.js支持播放flv视频  
支持播放自建直播流  
优化了播放器加载逻辑

### 说明

1. 支持hls播放切片视频，flv视频，可播放hls切片直播，flv直播流

2. 支持简单的登录验证，默认用户名密码都是admin。
如果不想要用户名密码，把_h5ai/public/index.php里第二行include 'login.php'注销。
修改用户名密码在_h5ai/public/login.php。

3. 考虑到方便手动管理视频切片文件，会自动按照下面的目录结构播放video.m3u8，如果没有切片则会播放原始视频。
切片文件夹和文件默认都是隐藏的，不会在h5ai中显示，可以手动修改_h5ai/private/conf/options.json配置是否隐藏。
```
├── __abcd.mp4__
│   └── video.m3u8
└── abcd.mp4
```

### 简易自动切片

##### 搭配Aria2
aria2配置文件增加
```
on-download-complete=/data/aria2/hls_aria2.sh
```
hls_aria2.sh --> 下载完成后复制原始视频流编码自动切片。自行修改下载路径DOWNPATH(注意需要结尾的"/")。

##### 通用转换切片文件
hls_general.sh --> 将指定目录及所有子目录下的全部视频文件切片。自行修改目录绝对路径(注意结尾无"/")。

##### ass,srt字幕转vtt字幕
如果存在同视频文件名的vtt字幕，会自动载入字幕文件。
subtovtt.sh --> 将指定目录及所有子目录下的全部字幕文件转换为vtt字幕。自行修改目录绝对路径(注意结尾无"/")。

### 直播流
比较复杂，有需求的人也不多，感兴趣可以自行研究  

可以搭建livego直播服务器，中转播放youtube等国外直播，需要ffmpeg, streamlink/youtube-dl, livego。

若直播流取名为movie
通过ffmpeg推流到livego链接为 rtmp://127.0.0.1:1935/live/movie  

nginx反代 /live 到 127.0.0.1:7001，在h5ai显示的目录下新建movie.live.flv，点击就会播放名为movie的flv直播流(推荐，延迟低，稳定)。

nginx反代 /live 到 127.0.0.1:7002，在h5ai显示的目录下新建movie.live.flv，点击就会播放名为movie的hls切片直播流(20s延迟)。
