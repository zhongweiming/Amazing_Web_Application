## Web 应用测试
***
### 单元测试
#### 1. 使用JUNIT  
1. 首先新建一个项目, 我们编写一个类
2. 自定义一个测试基类, 在基类中完成常用的注解配置, 
3. 然后让测试类继承该类, 可以省去很多重复的注解代码  

测试基类代码如下:
```java
import org.junit.runner.RunWith;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.test.context.transaction.TransactionConfiguration;
import org.springframework.transaction.annotation.Transactional;
```
spring 整合 Junit4 单元测试基类, 其他类实现该类可以省略一些注解配置

#### 2. 使用 junit4 进行单元测试
```java
@SuppressWarnings("deprecation")
@RunWith(SpringJUnit4ClassRunner.class)
```
加载配置文件, 可以指定多个配置文件, locations 指定的是一个数组
```java
@ContextConfiguration(locations={"classpath:spring/applicationContext-*.xml", "classpath:spring/springmvc.xml"})
//启动事务控制
@Transactional
```
配置事务管理器, 同时指定自动回滚
```java
@TransactionConfiguration(transactionManager="transactionManager", defaultRollback=true)
public class BaseJunit4Test {
    //进行测试时, 将测试类继承该类
    //注入service对象
    //然后在方法上使用@Test, @RollBack, @Transaction等注解单独修饰
}
```
测试类代码如下:
```java
public class ItemsServiceImplTest extends BaseJunit4Test{
    @Autowired
    private ItemsService itemsService;
    @Test
    public void testFindItemsList() throws Exception {
        List<ItemsCustom> itemsList = itemsService.findItemsList();
        System.out.println(itemsList);
    }
}
```
另一种实现方式: spring4.2 版本提供如下两个抽象类: 
1. `org.springframework.test.context.junit4.AbstractJUnit4SpringContextTests` 与事务无关的类
2. `org.springframework.test.context.junit4.AbstractTransactionalJUnit4SpringContextTests` 可以控制事务的类

将测试类继承上面两个抽象类中的一个 (建议使用第二个) , 可以控制事务, 也可以测试与事务无关的方法  

测试类代码如下: 
```java 
// 测试继承 AbstractTransactionalSpringContextTests 这个类  
// 继承该类, 可以测试进行事务控制, 测试完成后自动回滚
@RunWith(SpringJUnit4ClassRunner.class)
//locations:参数值因配置文件地址来改变
@ContextConfiguration(locations={"classpath:spring/applicationContext-*.xml", "classpath:spring/springmvc.xml"})
public class ItemsServiceImplTest1 extends AbstractTransactionalJUnit4SpringContextTests{
    //注入service对象
    @Autowired
    private ItemsService itemsService;
    @Test
    //还可以加入@RollBack注解 @Transaction注解来对方法进行事务注解
    public void testFindItemsList() throws Exception {
        List<ItemsCustom> itemsList = itemsService.findItemsList();
        System.out.println(itemsList);
    }   
}
```

### 功能测试
>1. 用客户的身份登录网站并实现购买商品  
>2. 操作流程:  
>注册 ==> 登录 ==> 浏览网站商品 ==> 将商品加入收藏夹 ==> 将商品加入购物车 ==> 选择需要购买商品 ==> 结算 ==> 确认收货地址和支付方式, 确认商品信息 ==> 添加备注 ==> 提交订单 ==> 订单完成

1. 链接测试  
链接是 web 应用系统的一个很重要的特征, 主要是用于页面之间切换跳转, 指导用户去一些不知道地址的页面的主要手段, 链接测试一般关注三点:
    1. 链接是否按照既定指示那样, 确实链接到了该链接的界面
    2. 测试该链接所链接的页面是否真的存在
    3. 保证系统中没有单独存在的页面 (即没有链接指向, 只能通过正确的 URL 地址才能访问) 

2. 数据效验
    1. 保存客户端传过来的数据, 如果验证不通过, 把数据返回到客户端, 这样可以保存用户输入, 不需要重新输入 (主要是用来检验输入是否合法, 和输入内容是否正确) 
    2. 验证数据, 以及保存数据对应的错误信息

3. 交互测试  
* 作为测试, 很多时候都要站在用户的角度去思考, 那么, 作为一个用户, 当他访问一个 web 的网站或者系统时, 会怎么去操作呢?  
* 大部分用户都是目的驱动的, 当他访问一个网站, 会很快的浏览系统, 找不到满足自己需求的信息时, 会很快离开, 很少有用户愿意花时间去熟悉系统的结构, 因此, 导航测试 **(就是在不同的页面跳转之间, 或者按钮、对话框、列表以及窗口等)** 就显得很重要, 通过考虑这些因素去判断一个应用是否易于导航: 
    * 是否直观? 
    * 系统的主要模块是否可以通过主页访问或者到达? 
    * 站点是否需要站内地图或者搜索引擎等其他帮助?  
* web系统导航的另外一个重点就是页面结构、导航、菜单、风格等是否一致, 确保用户可以凭借直觉或者简单的判断就可以找到自己想要的内容。

4. 数据库测试
  
    于后台存储信息的数据库也应该进行检验: 
    1. 测试数据库是否完整、数据是否以正确的格式被正确存储
    2. 还应该测试从数据库输出的内容是否以预期的格式表现

5. 特定功能需求测试
    * 这个主要用来检测 web 系统提供信息的准确性、相关性, 比如: 
        1. 商品的价格, 文字描述
        2. 信息的准确性, 是否有拼写错误
        3. 信息的相关性, 比如很多网站的 "相关文章列表, 视频列表等"
    * 还有就是登陆用户是否可以转换为卖家对商品进行销售

### 性能测试
* 速度测试  
    
    让多位测试人员进行登陆, 然后进行搜索, 购买, 销售等多个功能进行测试:
    * 查看响应时间
    * web服务的连接速度如何
    * 每秒的点击数如何
    * Web服务能允许多少个用户同时在线
    * 如果超过了这个数量, 会出现什么
    * Web服务能否处理大量用户对同一个页面的请求
    * 如果web服务崩溃, 是否会自动恢复
    * 系统能否同一时间响应大量用户的请求

* 压力测试  
    
    服务器做压力测试时:
    
    * 可以增加并发操作的用户数量
    * 不停的向服务器发送请求
    * 一次性向服务器发送特别大的数据等   

    看看服务器保持正常运行能达到的最大状态, 比如模拟上万用户从终端同时登录  
    获取系统正确运行的极限, 检查系统在瞬间峰值负荷下正确执行的能力包括: 
    * Spike testing (尖峰冲击测试) : 短时间的极端负载测试
    * Extreme testing (极端测试) : 在过量用户下的负载测试
    * Hammer testing (锤击测试) : 连续执行所有能做的操作

* 大数据量测试
 
    主要是针对对数据库有特殊要求的系统进行的测试: 
    * 实时大数据量: 模拟用户工作是的实时大数据量, 主要目的是测试用户较多或者某些业务产生较大数据量是, 系统能够稳定的运行
    * 极限状态下的测试: 主要是测试系统使用一段时间即系统积累一定量的数据时, 能否正常地运行业务

### 安全性测试
1. Xss漏洞
* 将重要的 cookie 标记为 http only,   这样的话 Javascript 中的 document.cookie 语句就不能获取到 cookie 了, 只允许用户输入我们期望的数据,  例如:　年龄的 textbox 中, 只允许用户输入数字. 而数字之外的字符都过滤掉
* 对数据进行 Html Encode 处理过滤或移除特殊的 Html 标签, 例如: `<script> , <iframe> , < for < , > for >, &quot for`
* 过滤 JavaScript 事件的标签. 例如 "onclick=", "onfocus" 等等
 
2. 防止sqL注入
```java
@Override
public User getUserById(String userid) {
	User u=new User();		
	Connection conn = null;
	Statement st = null;
	ResultSet rs = null;	
	try
	{
		conn = DBOperator.getConnection();
		String sql = "select * from users where userid="+userid;
		st = conn.createStatement();
		rs = st.executeQuery(sql);
		if (rs.next()) {
			u.setUserid(rs.getInt("userid"));
			u.setName(rs.getString("name"));
			u.setSex(rs.getString("sex"));
			u.setAge(rs.getString("age"));
			
		}
	} catch(Exception ex) {
		ex.printStackTrace();			
	} finally {
		DBOperator.close(rs, st, conn);		
	}	
	return u;
}
// 然后是执行这个 Dao 层方法并返回信息给网页的 Servlet :
package cn.edu.hpu.sqlinject.servlet;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import cn.edu.hpu.sqlinject.dao.UserManager;
import cn.edu.hpu.sqlinject.dao.UserManagerImpl;
import cn.edu.hpu.sqlinject.domain.User;

public class GetUser extends HttpServlet {
 
    public void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        doPost(request,response);
	}
 
	public void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		
		request.setCharacterEncoding("utf-8");
		response.setCharacterEncoding("utf-8");
		response.setContentType("text/html;charset=UTF-8");
		
		String userid=(String)request.getParameter("userid");
		
		UserManager um=new UserManagerImpl();
		User u=um.getUserById(userid);
		
		if(u!=null){
			request.setAttribute("u", u);
			request.getRequestDispatcher("/index.jsp").forward(request, response);
		}else{
			response.sendRedirect("error.jsp");
		}
}
```

### WebUI 测试
其中包括图片、动画、边框、颜色、字体、背景、按钮等等, 其中要考虑的几个重点, 做了一个大概的总结: 
1. 图片要有明确的用途, 代表；图片尺寸尽量小, 一般采用 JPG 或者 GIF 压缩
2. 页面整体风格是否和系统的用途一致
3. 背景颜色, 字体, 搭配是否合理

对 UI 测试问题时, 不能很好的恢复到下一条 case 的正确执行场景, 可以通过组织良好的 case , 我们写 Case 的时候倾向于 Case 之间是没有关联的  

我们希望一个 Case 在执行的时候, 它自己能够将初始化和结尾的工作先做好, A Case 和 B Case 不应该有关系, B Case 的成功与失败不应该依赖于 A Case 的成功与失败, 一个好的 Case 应该这样设计  

但是有时候 A Case 做完, 我们需要先添加一个用户, 然后再删除这个用户, 这种情况下, 如果没添加就去删除, 则是失败的, 两者之间存在一种依赖关系.  
在这种设计的情况下, 有一个解决的思路是支持 Case 间的依赖, 你可以定义一个标签去说明某个 Case 依赖于其他的 Case , 这样就先执行被依赖的 Case , 然后再执行这个 Case , 确保了执行的顺序


