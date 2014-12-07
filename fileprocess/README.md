精弘文档-文件处理部分
==============================
需要环境
------------------------------
系统：CentOS-6.5
用到的工具：-Openoffice 4.1.1
			-Openoffice SDK 4.1.1
			-Swftools
			-Jodconverter
配置环境
---------------------------------
>安装openoffice，去官网下载openoffice安装包（Apache_OpenOffice_4.1.1_Linux_x86-64_install-rpm_zh-CN.tar.gz）
>解压，rpm安装
>后台启动服务
>再去官网下载，安装相同版本的openoffice SDK（Apache_OpenOffice-SDK_4.1.1_Linux_x86-64_install-rpm_en-US.tar.gz）
>下载jodconverter
>解压,复制到一个目录里面去，调用里面的`/lib/jodconverter-cli-2.2.2.jar`
>可以直接运行命令测试
>
``` bash
java -jar /var/www/html/convert/jodconverter-cli-2.2.2.jar 1.doc 1.pdf
```
>安装swftools：
>swftools安装需要几个类库支持
-freetype: http://www.freetype.org
-jpeglib: http://www.ijg.org/files/
-xpdf: http://www.foolabs.com/xpdf/
-zlib: http://www.zlib.net
``` bash
$wget http://nchc.dl.sourceforge.net/project/freetype/freetype2/2.4.8/freetype-2.4.8.tar.bz2
$tar xvf freetype-2.4.8.tar.bz2
$cd freetype-2.4.8
$./configure
$make&&sudo make install
```
>安装jpeglib
``` bash
$wget http://www.ijg.org/files/jpegsrc.v8d.tar.gz
$tar xvf jpegsrc.v8d.tar.gz
$cd jpegsrc.v8d
$./configure
$sudo make&&sudo make install
```
>安装zlib
``` bash
$wget http://nchc.dl.sourceforge.net/project/libpng/zlib/1.2.6/zlib-1.2.6.tar.gz
$tar xvf zlib-1.2.6.tar.gz
$cd zlib-1.2.6
$./configure
$make&&sudo make install
```
>配置swftools安装程序并安装
``` bash
$cd swftools/lib/pdf
$wget ftp://ftp.foolabs.com/pub/xpdf/xpdf-3.03.tar.gz
$cd ../../
$./configure
make&&sudo make install
```
文件结构
-------------------------------------------------------
selectfile.html 				前端上传页面
upload.php 						后台上传页面
convert.php 					文件格式转化页面
注意：
-------------------------------------------------------
convert.php需要调用exec函数，请确认php.ini中是否禁用，系统是否给予apache运行权限。
pdf2swf的调用需要改为绝对路径或者提前声明。
更新
-------------------------------------------------------
###2014/12/7
-本地配置了所有需要的文件
-建立了最基础的上传与处理页面。