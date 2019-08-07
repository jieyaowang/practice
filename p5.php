<?php
	/*
	主要以处理数组和字符串为主
	字符串处理函数
		echo
		print() 格式化输出字符串函数
		die() 终止运行

	*/	
	//echo 'hello world';

	//die('aaa');
	//echo 'ccc';

	// %s 字符串 $d 数字 $f 浮点
	//printf('我叫%s,我今年%d,我是%f','edsk','20','188.2');

	/*
	获取字符串的长度 
		strlen(string) 只获取单字节编码字符,得到字符串所占的字节数,并不能得到真实的字符串长度
			utf-8 所有国家编码通用 中文的就是utf-8编码,3个字节
			GBK GB2312的基础上又增加了中文2个字节
		iconv('原编码','转成的编码','字符串') 转换字符串编码
		mb_strlen(字符串,"字符集")获取多字节长度,使用要开启mbstring扩展,指定字符集
			字符集为utf8,中文被当成一个字符,gbk,当成1.5个字符
		mb_internal_encoding() 得到当前PHP使用的内部编码
	*/
	$str1 = 'hhfgdfasdkjdakdjh';
	$str2 = '你好aaaaa';
	echo mb_strlen($str2); // 11 未指定字符集,默认用内部字符编码(单字节)
	echo mb_strlen($str2,"utf8"); //7
	echo mb_strlen($str2,"gbk"); //8
	echo strlen($str1); //utf8字符集为17,gbk,结果为17
	//$s = iconv('utf-8','gbk',$str1);
	//echo strlen($s);
	//var_dump(strlen('akaxxxxmmdidaskdasjenmndlkas'));

	//访问字符串
	$str3 = 'helloworld';
	$str4 = '你好';
	//echo $str3[4]; //o
	//echo $str4[2]; //不会显示,只有0 1 2三个都打印出来才行

	/*
	字符串操作(去掉,填充,重复,打乱,截取,替换,反转,字符串拆分成数组,数组拼装成字符串)
		ltrim(字符串,需要去除的) 去除字符串左侧的空格(默认参数是去掉空格) 
		rtrim()去除右侧的符号
		trim()去除左右的空格
		str_pad(字符串,'填充内容',填充方向) 填充字符串,
			填充内容默认是空格
			填充方向默认是右侧,str_pad_left是左侧,str_pad_both是两侧同时添加
		str_repeat('循环的内容',循环次数) 循环输出字符串
		str_shuffle() 打乱字符串
		str_substr('要截取的字符',从第几个开始,截取几个字符)
		str_replace('需要替换的内容','替换之后的内容','字符串')
		strrev() 字符串反转
		str_split('字符串','几个一组')字符串分割成数组
		explode() 字符串拆分成数组
		implode() 数组拼装成字符串
	*/

	//trim只能去掉左侧和右侧的,中间的去不掉
	$str = '  andreiguodala++';
	echo strlen($str); //17
	$str1 = ltrim($str);
	echo strlen($str1); //15
	$str2 = rtrim($str,'++');
	echo strlen($str2);//15
	$str3 = trim($str,'++');
	echo strlen($str3);

	//填充字符串
	$str4 = 'hello'; //5
	$str5 = str_pad($str4,10);
	echo $str5; //填充的内容默认加的是空格,看不见
	echo strlen($str5); //10
	$str5 = str_pad($str4,10,'=');//指定填充为=,默认添加到右侧
	echo $str5; //hello=====
	echo strlen($str5);
	$str5 = str_pad($str4,10,'=',STR_PAD_LEFT);//添加到左侧
	echo $str5;//=====hello
	$str5 = str_pad($str4,10,'=',STR_PAD_BOTH);//添加到两侧,不会平均添加
	echo $str5; //==hello===

	//字符串重复输出
	echo str_repeat('.',10); //..........
	//打乱字符串
	echo str_shuffle($str4); //随机打乱

	//字符串截取
	$str = 'antetukounumpo';
	$str1 = substr($str,3);//从左往右从第三个字母之后开始截取
	echo $str1; //etukounumpo
	$str2 = substr($str,3,4);//从左往右从第三个字母开始截,长度为4
	echo $str2; //etuk
	$str3 = substr($str,-3); //从右往左截取三个字母
	echo $str3; //mpo
	$str4 = substr($str,-3,2);//从右往左截取三个字母中的两个
	echo $str4; //mp

	//多字节截取,适用于字符串是中英文混合的情况
	$str = '扬尼斯安特托昆博';
	//$str1 = substr($str,3,6);
	$str1 = mb_substr($str,0,1);//把一个汉字看做一个字符,o扬 1尼 2斯
	echo $str1;//扬

	//字符串替换
	$str = 'hello  woeld';
	$count = 1;
	$str2 = str_replace('e','++',$str,$count);
	echo $str2; //h++llo wo++ld
	echo strlen($str);//12
	$str2 = str_replace(' ','',$str);//把空格替换为没有空格
	echo strlen($str2);//10

	//反转字符串reverse
	echo strrev($str); //dleow olleh

	//手写函数反转字符串

	//字符串转化成数组
	$str = 'hello world';
	//强制类型转换
	//var_dump((array)$str); //array(1) { [0]=> string(11) "hello world" }
	$str1 = str_split($str);
	var_dump($str1);
	//array(11) { [0]=> string(1) "h" [1]=> string(1) "e" [2]=> string(1) "l" [3]=> string(1) "l" [4]=> string(1) "o" [5]=> string(1) " " [6]=> string(1) "w" [7]=> string(1) "o" [8]=> string(1) "r" [9]=> string(1) "l" [10]=> string(1) "d" }
	$str2 = str_split($str,2);//两个一组
	var_dump($str2);
	//array(6) { [0]=> string(2) "he" [1]=> string(2) "ll" [2]=> string(2) "o " [3]=> string(2) "wo" [4]=> string(2) "rl" [5]=> string(1) "d" }

	//explode把字符串拆分成数组 爆炸成数组
	$str = 'hello++world++antetu+lekak';
	var_dump(explode('++',$str)); //按照++分割字符串
	//array(4) { [0]=> string(5) "hello" [1]=> string(5) "world" [2]=> string(6) "antetu" [3]=> string(5) "lekak" }

	//implode把数组组合成字符串
	$arr = ['hello','world'];
	var_dump(implode($arr));//string(10) "helloworld"
	var_dump(implode('++',$arr));//tring(12) "hello++world"

	/*
	字符串大小写转换
		常用于验证码
		strtoupper() 小写转大写
		strtolower() 大写转小写
		ucfirst() 首字母大写
		ucwords() 每个单词首字母都大写
	*/

	$str = 'hello world';
	$str1 = 'HELLO WORLD';
	echo strtoupper($str); //HELLO WORLD
	echo strtolower($str1);//hello world
	echo ucfirst($str); //Hello world
	echo ucwords($str); //Hello World

	/*
	字符串加密函数
		用户的密码
		md5()单向加密,不可逆 32位散列值
			www.cmd5.com可以查询加密后对应的原密码
			即使用户输入了简单的密码,也可以在后台在处理一下
		sha1() 加密,40位散列值
	*/

	$password = '123456';
	$str = md5($password);
	echo $str; //e10adc3949ba59abbe56e057f20f883e
	echo strlen($str);//32

	$str1 = sha1($password);
	echo $str1;//327c4a8d09ca3762af61e59520943dc26494f8941b
	echo strlen($str1);//40

	/*
	处理html标签的函数
		nl2br() 插入换行<br/>
		addslashes() 加反斜线
			将单引号'',双引号"",反斜线\,NULL前面都会加上反斜线
			可用于为存储在数据库中的字符串,以及数据库查询语句准备字符串(解决sql注入)
		stripslashes() 去掉反斜线   strip去掉 slashes斜线
		htmlspecialchars() 只转义以下五种字符实体,html特殊的字符串
			解决XSS攻击(提交html非法标签)
			&地址符 转成 &amp
			""      转成 $quot
			''      转成 &#039
			<       转成 $lt
			>       转成 $gt
		htmlentities() 可以转义所有html实体的特殊字符,比如欧元符
		strip_tags() 去掉字符串中所有html标签(解决XSS的一种方式)
	*/

	$str = "first\n second";
	$str1 = 'first\n second';
	echo nl2br($str);//把\n换成html的<br>标签
	echo str_replace('\n','<br/>',$str1);//功能比较多,替换\n \s都行

	$str = 'Giannes"Antetokounumpo"';
	$str1 = 'my name\'s AI';
	$str2 = 'my name\s AI';
	echo addslashes($str); //Giannes\"Antetokounumpo\"
	echo addslashes($str1); //my name\'s AI
	echo addslashes($str2); //my name\\s AI

	$str = 'aaa\"bnmxcbvvvvvvnmbx';
	echo stripslashes($str); //aaa"bnmxcbvvvvvvnmbx

	$str = 'hello&world';
	echo htmlspecialchars($str); //hello&amp;world 查看源代码

	$str = "<script>alert('hello world')</script>";
	echo htmlspecialchars($str); //<script>alert('hello world')</script>

	echo strip_tags($str); //alert('hello world')

	/*
	查找比较字符串
		strcmp($str1,$str2) 区分大小写 ----compare比较
			str1等于str2,返回0
			str1小于str2,返回<0
			str1大于str2,返回>0 
		strcasecmp() 不区分大小写
		strstr($str1,$str2) 判断str2是否包含str1的内容
			返回bool 或者false
		strpos($str1,$str2) 返回str2在str1中的位置 ---position位置
	*/
 
	$str1 = 'hello';
	$str2 = 'Hello';
	$str3 = 'll';
	echo strcmp($str1,$str2); //1
	echo strcasecmp($str1,$str2);//0      

	//全部转成小写,再比较大小
	var_dump(strtolower($str1)==strtolower($str2)); //true

	//ll后面的都打印出来
	echo strstr($str1,$str3); //llo

	if(strstr($str1,$str3)){

		echo $str1.'里有字符串'.$str2;
	}else{

		echo $str1.'里没有字符串'.$str2;
	}

	echo strpos($str1,$str3); //2 0-h 1-e 2-l

	/*
	处理整行和浮点型的函数
		abs()绝对值
			电商支付,交易金额的处理,abs(float())
		decbin()十进制转二进制  ---dec十 ---binary二进制
		bindec()二进制转十进制
		floor() 向下取整
		ceil() 向上取整,用于分页(还可以取余)
		max() 获取最大值,用于数组
		min() 获取最小值
		rand(1000,2000) 随机获取范围内数字,用于验证码
		mt_rand() 推荐用这个获取随机数,效率比rand更快
		round() 四舍五入,处理float
		number_format($string,保留的小数位数默认为0,'.','千分位分割符,') 格式化输出金额
			四个参数都是必填的
	*/

	$balance = 123.56;
	$payment = -23.22;
	$payment = abs((float)$payment);

	echo $balance-$payment; 
	echo floor($balance); //小于等于123.56的最大整数,结果为123
	echo ceil($balance); //124

	$arr = [3,8,10,2,0,6];
	echo max($arr); 
	echo max(3,8,10,2,0,6);

	echo rand(1000,2000);

	echo number_format('233333330000',2,'.',','); //233,333,330,000.00






?>