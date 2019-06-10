### m3u8 tree
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
hls_aria2.sh --> 下载完成后复制原始视频流编码自动切片。自行修改下载路径DOWNPATH(注意需要结尾的"/")

##### 通用转换切片文件
hls_general.sh --> 将目录及所有子目录下的全部视频文件切片。自行修改目录绝对路径(注意结尾无"/")。
