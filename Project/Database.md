## 数据库表结构
***
### 商品表 product
| 字段名称 | 数据类型 | 默认值 | 允许非空 | 自动递增 | 备注 |
| :-: | :-: | :-: | :-: | :-: | :-: |
| id | Int unsigned |  | NO | YES | 主键 |
| pName | Varchar(50) |  | NO |  | 商品名称 |
| pStyleID | Varchar(50) |  | NO |  | 商品货号 |
| pNum | Smallint | 0 | NO |  | 商品数量 |
| marketPrice | Decimal(10, 2) |  | NO |  | 市场价 |
| internetPrice | Decimal(10, 2) |  | NO |  | 二手价 |
| pDesc | text | NULL | NO |  | 商品简介 |
| publishTime | Int unsigned |  | NO |  | 商品上架时间 |
| isShow | Tinyint(1) unsigned | 1 | NO |  | 商品是否上架 |
| isHot | Tinyint(1) unsigned | 0 | NO |  | 销量好的商品 |
| cId | Int |  | NO |  | 所属分类ID |

### 管理员表 administrator
>默认超级管理员 (*username*, *password*) => (*lukace*, *lukace*)

| 字段名称 | 数据类型 | 默认值 | 允许非空 | 自动递增 | 备注 |
| :-: | :-: | :-: | :-: | :-: | :-: |
| id | Tinyint unsigned |  | NO | YES | 主键 |
| username | Varchar(20) |  | NO |  | 管理员名称, 唯一 |
| password | Varchar(32) |  | NO |  | 管理员密码 |
| email | Varchar(50) |  | NO |  | 邮箱 | 

### 分类表 cate
| 字段名称 | 数据类型 | 默认值 | 允许非空 | 自动递增 | 备注 |
| :-: | :-: | :-: | :-: | :-: | :-: |
| id | Smallint unsigned |  | NO | YES | 主键 |
| cName | Varchar(30) |  | NO |  | 分类名称 |

### 用户表 user
| 字段名称 | 数据类型 | 默认值 | 允许非空 | 自动递增 | 备注 |
| :-: | :-: | :-: | :-: | :-: | :-: |
| id | Int unsigned |  | NO | YES | 主键 |
| username | Varchar(20) unique |  | NO |  | 用户名 |
| password | Char(32) |  | NO |  | 密码 |
| sex | Enum("男", "女", "保密") | 0 | NO |  | 性别 |
| avatar | Varchar(255) |  | NO |  | 头像 |
| regTime | Int unsigned |  | NO |  | 注册时间 |

### 相册表 album
| 字段名称 | 数据类型 | 默认值 | 允许非空 | 自动递增 | 备注 |
| :-: | :-: | :-: | :-: | :-: | :-: |
| id | Int |  | NO | YES | 主键 |
| pId | Int |  | NO |  | 商品的ID |
| albumPasswd | Varchar(50) |  | NO |  | 图片路径 | 

### 购物车表 shoppingCart
| 字段名称 | 数据类型 | 默认值 | 允许非空 | 自动递增 | 备注 |
| :-: | :-: | :-: | :-: | :-: | :-: |
| userId | Int |  | NOT NULL |  | 用户ID |
| productId | Int |  | NOT NULL |  | 商品ID |
| quantity | Int |  | 0 |  | 商品数量 |