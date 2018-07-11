## Web 应用设计
***
### 内容设计
使用不同的小组件 (插件) 进行内容展示 (组件化) : 
* 轮播组件: 展示收藏数最多的卖品
* 标签组件: 展示卖品数量最多的几个类别
* 展示组件
    * 展示实时交易: 展示实时的成功交易的信息
    * 展示具体类别: 具体地展示几个最热的类别的一些物品信息
    * 网页背景/LOGO: 网站整个的背景页面, 网站的LOGO
* 内容推荐组件: 根据用户的访问习惯, 推荐一些用户可能感兴趣的物品

### 功能设计
登录、注册、交易、聊天等主流功能

### 展示设计
* 首页
    * 顶部
        * 左端: 登陆注册
        * 右端: 基础服务(购物车、收藏夹、商品分类)
        * 下部: 搜索组件
    * 中部
        * 左部: 标签组件
        * 中部: 轮播组件 
        * 右部: 实时交易的展示组件
    * 底部
        * 内容推荐组件
        * 具体类别的展示组件
* 登陆/注册界面
* 评价
    * 富文本编辑器

### 详细设计
1. 内容浏览  
用户可以浏览交易平台交易物品, 包括物品价格、数量、来源、评价单等

2. 登陆与注册  
用户可以填写并提交用户名和密码, 登陆成功后用户可以进行购买、评价已购商品等

3. 出售物品
用户上传商品信息包括图片、价格、总数量、分类、商品描述、来源、退换期限等信息, 等待平台管理员进行审核 (主要审核商品价格合理性、安全性、合法性) , 审核通过后商品上线发布在系统中, 正式成为待购商品。审核完成后, 管理员给用户发送审核结果通知

4. 购买物品
用户选择指定商品, 加入购物车, 完成有效地址、联系电话、交易方式等信息填写生成订单, 用户确认, 订单生成, 在有效时间内完成付款, 订单完成. 否则, 超出指定时长, 订单失效

5. 评价商品
用户在已购商品中选择一项, 填写对该商品的评价, 生成一张评价单, 公布在系统上, 并向上贩卖商品者发送评价单

6. 退货
用户在已购商品中选择一项, 填写指定信息: 退货原因、购买时间、是否接受换货, 生成一张退货单, 管理员进行审核 (审核商品 id 是否有效, 不在退货时限商品不允许退货, 因为该商品 id 已无效) , 审核通过后, 通知贩卖用户与购买用户审核结果

7. 商品管理
管理员可以增加商品、删除商品、更改商品所属分类等

8. 日志管理
记录用户登录日志、购买记录、出售记录等

9. 系统管理
超级管理员可以进行分类管理、用户管理、权限管理、查看系统日志等
所有类及名称方法名:
```
用户 (User) : {
    属性: 
        rank (用户等级分为三种: 普通、会员、超级会员, 该属性值可取0、1、2)
        sex (性别), 
        name (账户名称)
        address (地址)
    
    方法:
        boolean purchase(int i) (购买, 商品 id)
        int sell() (贩卖, 返回商品 id)
        boolean evaluate(int i) (评价, 商品 id)
        void desert(int i)（退货, 商品 id）
        int getPower() (查询用户权限)			
}

管理员 (Administrator) : {
    属性:
        rank (管理员等级分为两级：普通、超级, 该属性值可取0、1)
        id (唯一字符串)
        name (账户名称)
				   
    方法:
        void check(int i) (审核商品, 若审核不通过注销该 id , 参数商品 id)
        boolean add(int i) (添加商品上架)
        boolean delete(int i) (从系统中删除指定 id 商品)
        boolean change(int i) (更改商品信息)
        boolean notify(String name) (通知指定人群某些信息, 如, 审核信息)
}

超级管理员 (SuperAdministrator) : {
    属性:
        rank (管理员等级分为两级: 普通、超级, 该属性值可取0、1)
        name (账户名称)

    方法: 
        void manageKind() (管理商品分类, 包括增删改查)
        void mamageUser() (管理用户, 包括增删改查)
        void managePower() (管理用户权限分配, 改变等)
        boolean viewJourney() (查看系统日志, 包括商品出售信息及新增商品信息、系统盈利等)
}

评价单 (EvalForm) : {
    属性: 
        descriptor (评价字符串)
        id (评价单 id)		
}

订货单(GoodsForm){
    属性:
        address (收货地址)
        id (订货单 id)
        validTime (订单有效时长)
        phoneNumber (联系电话)
        goodsId[] (商品id数组)
        number[] (商品数量数组)
        price (订单价格)
}

退货单 (ReturnForm) : {
    属性:
        address (退货地址)
        id (退货单 id)
        phoneNumber (联系电话)
        goodsId (商品 id)
        number (商品数量)
        price (订单价格)    
    
    方法:
        void getTime() (获取商品购买时长)
}

日志(Journey) : {
    属性:
        date (日志记录时间)
        purItem[] (购买记录)
        sellItem[] (出售记录)
    
    方法:
        boolean update() (更新日志为此时此刻)
        void addPurItem(int id) (添加购买商品记录)
        void addsellItem(int id) (添加出售商品记录)

}

日志集 (JourneySet) : {
    属性:
        Journey[] (所有用户的日志合集)
        date (日志记录时间)
    
    方法:
        boolean update() (更新日志为此时此刻)
        void addJourney(int id) (添加购买商品记录)
		          
}

订单集 (GoodsFormSet) : {
    属性:
        GoodsForm[] (所有用户的订单合集)
 	
    方法:
        boolean update() (更新日志为此时此刻)
        int addGoodsForm(int id) (添加订单, 生成订货单 id)


}

退单集 (ReturnFormSet) : {
    属性: 
        ReturnForm[] (所有用户的订单合集)	 
    
    方法:
        int addReturnForm(int id) (添加退货单, 生成退货单 id)


}

评价单集 (EvalFormSet) : {
    属性: 
        EvalForm[] (所有用户的订单合集)		 
    
    方法:
        int addEvalForm() (添加评价单, 生成对应 id)
}

商品 (Goods) : {
    属性:
        id (唯一整数)
        image (图片)
        price (价格)
        number（数量）
    
    方法:
        boolean getItem(int id) (通过id获取商品实例)
        int getPrice（) (获取商品价格)
        int getRemain() (获取剩余商品数量)
        int setPrice（）(设置商品价格)
}

商品分类集 (GoodsKindSet) : {
    属性:
        Goods[] (同类商品集合)
    
    方法:
        boolean addGoods(int i) (添加指定 id 商品)
        boolean deleteGoods(int i) (删除指定 id 商品)
        int[] getAllId() (获取所有同类商品 id)
        void viewGoods (列出所有同类商品)
}

商品总集 (GoodsCollection) : {
    属性:
        GoodsKindSet[] (所有商品集合)
   
    方法:
        boolean addGoodsKindSet() (添加商品分类集)
        boolean deleteGoodsKindSet() (删除商品分类集)
        int[] getAllId() (获取所有商品 id)
        void viewGoods (列出所有商品)
}
```
