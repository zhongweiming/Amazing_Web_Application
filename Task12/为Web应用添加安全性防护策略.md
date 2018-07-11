## 为 Web 应用添加安全性防护策略
***
### Spring Security
#### 1. 说明
1. spring security 是一在 spring 基础上的框架
通过这个框架可以尽量的避免多种安全问题, 包括客户端服务端已经客户端服务端通信之间的安全问题  

2. Spring Security 对 Web 安全性的支持大量地依赖于 Servlet 过滤器. 这些过滤器拦截进入请求, 并且在应用程序处理该请求之前进行某些安全处理  

3. Spring Security 提供有若干个过滤器, 它们能够拦截 Servlet 请求, 并将这些请求转给认证和访问决策管理器处理, 从而增强安全性  

4. 根据网上的一些教程以及书本上的一些简单的实例进行了登录页面的框架使用, 但是存在了一些问题, 没有实现完全, 所以没有把测试版本进行上传以及应用

#### 2. 测试用例
1. XSS测试用例
```javascript
'><script>alert(document.cookie)</script>
='><script>alert(document.cookie)</script>
<script>alert(document.cookie)</script>
<script>alert(vulnerable)</script>
%3Cscript%3Ealert('XSS')%3C/script%3E
<script>alert('XSS')</script>
<script>alert('Vulnerable');</script> 
<script>alert('Vulnerable')</script> 
?sql_debug=1 
a%5c.aspx 
a.jsp/<script>alert('Vulnerable')</script> 
a/ 
a?<script>alert('Vulnerable')</script> 
"><script>alert('Vulnerable')</script> 
```

2. SQL注入用例：
```php
$sql = "SELECT * FROM users where name='root' and 1=1 #";
$sql .= $_GET["name"]."'";  
$result = mysql_query($sql)
?name=root' and 1=1 #
// 根据获得的#编码来进行以下的操作, 假设#编码是%23
?name=root' order by 5 %23
// 更改5成任意的数字, 知道其中有一个数字时正常, 就得到有多少个表
// 假设有五个表, 那么就可以使用以下语句判断有多少个注入点
?name=root' and 1=2 UNION SELECT 1,2,3,4,5 %23
```
#### 3. AWVS测试后的一些建议
因为时间和技术等问题, 在安全性方面其实是存在很多问题的, 无论是数据库的安全性, 还是在 XSS 以及 SQL 注入等方面多少都存在一些问题. 存在数据库中的数据并没有经过太好的加密, 有更改 cookie 的可能. 所以在安全性方面还需要进一步的完善