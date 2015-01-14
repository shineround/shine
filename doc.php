业务架构:
	一、前台
		1). 模板
			1. 布局
			2. 元素
				1. 样式
				2. 内容
				3. HTML代码
				4. 动态编辑元素
		2). 文章
			1. 分类
			2. 列表
			3. 内容
		3). 搜素
	二、后台
		1). 网站全局配置
		2). 在线sql管理数据库
		3). 网站模板管理
				1. 元素列表
				2. 元素编辑
		4). 文章管理
				1. 分类管理
				2. 添加文章
				3. 文章编辑(标题、内容、分类) 
代码架构:
	--conf
		--site.conf
		--db.conf
	--protected
		--controller
		--model
		--view
			--layouts
			--elements
	--public
		--js
		--css
		--themes
			--layouts
			--elements
			--js
			--css
	--systme
		--db
			--mysql
		--core
			--controller
			--model
			--bootstrap.php
			--route.php
		--utils
			--email
			--url
	--index.php