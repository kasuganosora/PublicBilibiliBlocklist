Public Bilibili Block list
==========================

public comment filter list,use PHP  
原理 http://blog.hcg.im/sora/2013/07/bilibili-%E5%85%B1%E7%94%A8blocklist%E5%B7%A5%E5%85%B7%E6%9E%84%E6%80%9D/

#用途
可以多个用户共享同一份屏蔽列表,且自己添加的规则可以同时同步到Bilibili服务器上

#运行环境
独立IP的主机或者VPS,需要用安装apache2,mod_proxy,php,mysql

#服务器安装方法
把sql里的文件导入数据库之后设置config.php的内容.

#客户端设置

##Hosts方法  
设置 interface.bilibili.tv 到 服务器主机

##SwitchySharp或autoProxy设置方法  
设置以下几个规则到 服务器IP上  
http://interface.bilibili.tv/blocklist  
http://interface.bilibili.tv/dmblock\*  
http://interface.bilibili.tv/dmunblock\*  

### ACFUN屏蔽功能,需要添加以下几条代理规则
\*://static.acfun.tv/player/filter/blacklist.json\*
\*://www.acfun.tv/report.aspx\*
\*://static.acfun.tv/player/filter/ban.json\

*acfun 关键字添加要到管理页面添加,屏蔽用户要在播放器中右键[举报用户], 然后在弹出页面上点击[屏蔽用户]按钮即可,不需要真的举报用户.*
