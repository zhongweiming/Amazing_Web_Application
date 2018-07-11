## Web 工程大作业说明文档
***
### 基础环境
Ubuntu 16.04 LTS, MySQL 8.0, PHP 7.0, ngnix 1.10.3

### 功能说明
#### 1. 管理员
登录、退出、注册、添加分类、添加商品、添加用户等

#### 2. 用户
登录、注册、浏览页面、添加购物车、下单 (待完成) 等


### 文件说明
* `$PROJECT_PATH/` 项目根目录
    * 主要都是前台用户界面
    * *include.php* 设置了项目中要包含的文件 
    * *doAction.php* 核心文件, 都是通过这个文件去找到后台提供给的用户的操作, 实现一个前后台的交互

* `$PROJECT_PATH/configs/` 配置文件夹 
    * *configs.php* 项目基础配置, 主要是数据库的设置

* `$PROJECT_PATH/lib/` 函数库文件夹
    * *common.func.php* 通用的函数, 主要封装了一个报错的函数
    * *image.func.php* 图片相关的函数, 主要用于验证码的生成、 图片水印的添加
    * *mysql.func.php* 数据库相关的函数, 数据库的连接、查询、更新等基本操作
    * *page.func.php* 分页相关的函数, 主要用于分页的展示
    * *string.func.php* 字符串相关的函数, 主要用于随机字符串的生成、添加水印
    * *server.func.php* 服务器相关的函数, 主要用于获取服务器的状态、信息等
    * *upload.func.php* 文件上传相关的函数, 主要是图片的上传

* `$PROJECT_PATH/core` 交互逻辑的文件夹  
**.inc.php* 都是交互对象可以参与的操作, 比如增、删、改、查、登录、注册等

* `$PROJECT_PATH/admin` 管理员相关的文件夹  
    * 大部分都是后台管理员的交互界面
    * *doAdminAction.php* 核心文件, 作用和 *doAction.php* 类似, 只不过这里是查找与管理员相关的操作

* `$PROJECT_PATH/js、script、js` 前台样式相关的文件夹
主要都是调整前台样式的文件

* `$PROJECT_PATH/plugins` 插件相关的文件夹
    * 富文本编辑器的插件 (目前只有这一个)

* `$PROJECT_PATH/uploads` 上传的目录
    * 该目录下的文件都是管理员上传的图片
    * `./avatar` 该目录下的文件都是用户上传的头像图片
    * `./image_*` 该目录下的文件都是上传图片的缩略图, 以满足不同页面需求

* `$PROJECT_PATH/images` 展示图片的文件夹  
主要是前台页面展示、美化页面的图片

* `$PROJECT_PAHT/test*` 测试文件  
只是编写程序时, 对一些函数的测试和检验

### 项目展望
对于这个项目可以有很多值得拓展的地方, 比如丰富用户的功能, 提供在线交易方式 (考虑到是校园交易平台, 可能主要还是以线下交易为主), 让卖家和买家可以即时聊天等, 提升项目的安全性, 可以完善的地方和功能还很多