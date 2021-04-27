# static-php-swoole
Compile A Statically Linked PHP With Swoole and other Extensions
编译纯静态的 PHP Binary 二进制文件，带有各种扩展（CLI 模式，暂不支持 CGI 和 FPM 模式）

[![版本](https://img.shields.io/badge/version-1.1.0-green.svg)]()

## 环境需求
- 目前在 x86_64 平台试验成功，其他架构需自行测试
- 需要 Alpine Linux（测试环境为 3.13 版本，其他版本未测试）系统（也就是说需要 musl）
- WSL2 也是支持的

## 开始
可以直接在旁边的 Release 中下载编译好的二进制，也可以自己编译。
```bash
# 自己编译
./static-compile-php.sh
完事后在 `php-dist/bin/php` 这个二进制文件可以随意拿着去任何一个 Linux 系统运行了！
```

## 包含扩展
- bcmath
- calendar
- ctype
- filter
- openssl
- pcntl
- iconv
- json
- mbstring
- phar
- curl
- pdo
- gd
- pdo_mysql
- mysqlnd
- sockets
- swoole
- redis
- simplexml
- dom
- xml
- xmlwriter
- xmlreader
- posix
- tokenizer

## 运行示例
编译后的状态
![image](https://user-images.githubusercontent.com/20330940/116053556-68a30800-a6ad-11eb-88f8-aba015899e43.png)

在不同系统直接运行 Swoft
![image](https://user-images.githubusercontent.com/20330940/116053161-f16d7400-a6ac-11eb-87b8-e510c6454861.png)

## Todo List
- [X] curl/libcurl 扩展静态编译
- [ ] 可自行选择不需要编译进入的扩展
- [ ] php.ini 内嵌或分发
- [ ] 尝试带进去个 composer（其实自己下完全可以）

## 参考资料
- <https://blog.terrywh.net/post/2019/php-static-openssl/>
- <https://stackoverflow.com/a/37245653>
- <http://blog.gaoyuan.xyz/2014/04/09/statically-compile-php/>
