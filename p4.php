<?php
	/*
	talk is cheap,show me your code
	函数,把有一定功能的语句整合到一块,是可以在程序中反复使用的语句块
	系统函数 var_dump() print_r() 数组处理
	自定义函数形式一
		function 函数名(){
			函数体
		}

		函数名命名规则(与变量命名的规则基本一样),字母数字下划线,数字不能开头
			驼峰     UserLogin
			帕斯卡   userLogin
			下划线   user_login   
			函数/变量命名方式尽量统一,一定要有意义,不要用拼音,不用系统关键字
			函数名不区分大小写,不能重复定义 
		函数的调用 函数名()
			函数不被调用是不会执行的,调用在函数声明前,声明后,函数中都可以
			堆(数据值)
			栈(变量名)
			数据段(常量)
			代码段(函数)
		php运行机制
			访问php文件时,php解释器先扫一遍整个文件,
			扫语法错误,
			加载函数 类到内存代码段	
			然后从上到下一行一行执行
	定义形式二	
		function 函数名(形参一,形参二,...){ 形参
			函数体
		}

		函数名(实参一,实参二) 实参
		函数的参数要和调用的参数一一对应(值,个数)
		实参变量名和形参变量名没啥关系
	定义形式三 带返回值的	
		function 函数名(){
			return
		}
		有返回值的情况,会把返回值 返回到调用的位置
		return函数后面的语句不会被执行,直接跳出函数
	*/

	/*
	$arr = ['2','3'];

	//封装到函数中,实现格式化输出
	function pre_print($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}

	pre_print($arr);
	

	function sum ($a,$b){
		echo $a+$b;
	}

	$c = 1;
	$d = 2;
	sum($c,$d);
	

	function sum ($a,$b){
		echo 'aaa';
		return $a+$b;
		echo 'bbb'; //bbb不会被执行
	}

	$c = 1;
	$d = 2;
	$result = sum($c,$d);
	echo $result;   ///aaa3
	*/

	//封装九九乘法表
	function print_mul($a){

		for($i=1;$i<=$a;$i++){
			for($j=1;$j<=$i;$j++){
				echo $i.'*'.$j.'='.$i*$j.'&nbsp;&nbsp;&nbsp;';
			}
			echo '</br>';
		}
	}

	print_mul(9);
	echo '</br>';
	echo '</br>';
	echo '</br>';

	/*
	变量的作用域
		全局变量
			作用域从程序开头到结尾,不包括函数内部
		局部变量
			函数内命名的变量
		超全局变量
			全局+局部
	*/

	function test(){
		$a = 1;
		echo $a;
	}

	test(); //1
	echo $a;//函数外部无法调用,局部变量,只能在函数内部使用


	$b = 3;
	function test1(){
		echo $b;
	}

	test1();//函数外声明的变量,函数内无法使用,否则传参就没有意义了

	$b = 3;
	function test2(){
		global $b;//把$b变成了全局变量,不推荐用,容易引发安全问题  discuz中大量使用 
		echo $b;
	}

	test2();//3

	//超全局变量 $GLOBALS,数组,键和值对应 全局+局部
	$abc = 'hello world';
	$b = 5;
	//echo $abc
	//echo $GLOBALS['abc']//访问的结果都是一样的

	function test3(){
		echo $GLOBALS['abc'];//微擎  微信开发开源项目
	}

	test3();

	//常量是超全局的作用域,在函数内部也可以使用
	define('A','hello world');
	const B = 'SSSSSSS';

	function test4(){
		echo A;
		echo B;
	}

	test4();//hello world

	/*
	局部变量两种存储方式
		动态存储(默认)
			函数调用完之后会释放变量
		静态变量 static(用来记数)
			调用完之后不释放,保留上一次状态,与常量存储一起存储到数据段中
	*/
	function test5(){
		$a = 1;
		echo $a;
		$a++;//用完之后就释放了,每次调用都是1
	}

	test5(); //1
	test5(); //1
	test5(); //1

	function test6(){
		static $a = 1;
		echo $a;
		$a++;//静态变量,用完之后不释放,会保留上一次的状态,累加
	}

	test6(); //1
	test6(); //2
	test6(); //3

	//如果传了实参,用实参,不传用默认的
	function test7($a,$b=3){
		echo $a+$b;
	}

	test7(1,2);//3
	test7(6); //9

	/*
	值传递(默认)
		互不影响
	引用传递(与变量的引用传递是一样的)
		引用传递,实参必须是变量,不能是数值
		$a和$b共用一个地址,当$a数值改变的时候,$b也会改变
	*/

	function test8($a){
		$a=100;
		echo $a;
	}
	$b = 5;
	test8($b);//100
	echo $b; //5


	function test9(&$a){
		$a=100;
		echo $a;
	}
	$b = 5;
	test9($b);//100
	echo $b; //100

	//类似实现了return的功能
	function test10(&$a){
		$a=100;
		return $a;
	}
	$b = 5;
	$b = test10($b);
	echo $b; //100

	/*
	可变参数的函数
		func_get_args()获取函数接收到的所有实参,结果为数组
		func_num_args()获取一个函数所接收到的所有实参数据的个数
		func_get_arg(n)获取函数接收到的第n个实参,n从0开始
	*/
	function test11(){
		$arr = func_get_args();
		echo $arr[1]; //5
		//var_dump(func_get_args());
	}

	test11(3,5);//array(2) { [0]=> int(3) [1]=> int(5) }

	/*
	文件加载  引入外部函数 common.php(重点)
		公共的函数库:实现相同功能的代码,分离出来,用的时候再引入
		解决代码冗余,解决代码后期维护,解决架构
		4个加载的语法形式(不是函数)
		include
			引入报错(引入失败,引入不存在的文件)的话,不影响后面代码执行
			引入的文件对后面的代码可有可无
			一般在函数function 类 或if for 等代码块中引入
		require
			引入报错的话,后面的代码不执行,直接退出
			引入的文件对后面的代码是必须的(根据第一个条件推出的)
			一般在文件的头部引用(还是根据第一个条件推出的)
		include_once
			只会引入一次   
   		require_once
   			推荐用_once,多次引用会影响内存
   	绝对路径
   		相对 访问的这个文件的位置 practice/p4.php
   	相对路径(推荐用)
   		文件的全路径 D:\phpStudy\PHPTutorial\WWW\p4.php
	*/
	//include 'practice/p2.php'; //相对路径,相对于p4.php的文件路径,引用函数时需要先引用再调用
	//include_once 'p2.php';
	//require 'p2.php';
	//require_once 'p2.php';

   	/*
   	可变函数
   		变量的值正好是函数名,$a()就可以调用函数
   	*/
   	$a = 'test12';

   	function test12(){
   		echo 'hello world';
   	}

	$a();//hello world

	/*
	回调函数 callback(把函数看成变量,传递到另一个函数中)
		调用函数时不是传递的变量,而是传递的一个函数
		is_callable 判断函数是否是回调
		使用系统函数声明 函数名是字符串形式,参数是一个数组
			call_user_func_array('函数名',参数){
	
			}
	*/
	function test13($a,$b){
		echo $a+$b;
	}

	function test14($a,$b){
		echo $a*$b;
	}

	function cal($fun_name,$c,$d){
		//调用之前先做判断
		if(is_callable($fun_name)){
			$fun_name($c,$d);//test13(3,5)
		}else{
			die ('函数'.$fun_name.'不可被调用');
		}
	}	

	//callable限制类型;PHP弱类型语言, int将数据类型强制转化
	//function cal(callable $fun_name,int $c,$d){
	//	$fun_name($c,$d);//test13(3,5)
	//}	

	//cal('test13','3',5);


	function test15($a,$b){
		echo $a+$b;
	}

	$arr = [3,4];

	call_user_func_array('test15', $arr);


	/*
	闭包函数(匿名函数)
		5.3版本后允许创建一个没有指定名称的函数,经常用作回调函数参数的值
	*/

	//相当于将整个函数赋值给了$a
	$a = function (){
		echo 'ddddd';
	};

	$a();//ddddd

	$a = function ($str){
		echo $str;
	};

	$a('ddd');//ddd
?>