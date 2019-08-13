<?php
	/*
	数组
		一维数组
		二维数组
	*/
	
	$arr1 = array(1,2,3,4);
	$arr2 = array('a'=>'abc','b'=>'def','c'=>'hij');
	
	//php5.4之后新加的,推荐用这种
	$arr3 = [1,2,3,4,'abc'];

	//关联数组,键自定义,值,直接赋值了
	$arr4['a']=123;
	$arr4['b']='hello';

	//索引数组,键从0开始递增,值直接一一对应 0->1,1->2,2->3
	$arr5[]=1;
	$arr5[]=2;
	$arr5[]=3; 

	/*
	数组的遍历
		循环打印
		for循环遍历数组
	*/

	$arr = ['a','b','c','d','e','f','g'];
	/*
	count可获取数组长度(有多少键值对),
		长度为7,从0开始,循环到6正好,count()-1,for循环中的i<=$len
		长度为7,从0开始,循环到6,count(),for循环中的$i<$len
	*/
	$len = count($arr)-1;

	for($i=0;$i<=$len;$i++){
		echo $arr[$i];
		echo '<br/>';
	} 

	/*
	for打印二维数组
		类似于会员信息的存储
		for循环只能打印键从0开始递增的,也就是索引数组
	*/
	$users = [
			['name'=>'andre','age'=>20,'position'=>'SG','overall'=>'89'],
			['name'=>'kevin','age'=>23,'position'=>'SF','overall'=>'96'],
			['name'=>'tim','age'=>25,'position'=>'PF','overall'=>'98'],
		   ];
    
    $len = count($users);

    for($i=0;$i<$len;$i++){

    	echo $users[$i]['name'].'==='.$users[$i]['age'];
    	echo '<br/>';
    }


    $users = [
    			[1,2,3,4],
    			[5,6,7],
    			[9,10]
    		];

    $len = count($users);
    for($i=0;$i<$len;$i++){

    	//echo $users[$i][0].$users[$i][1].$users[$i][2].$users[$i][3];
    	//你会发现,$i也是从0,1,2,3递增的,那还可以写个循环
    	//如果一维数组的长度,不都是一样的,每次循环的时候,就要计算一下循环到的数组长度
    	$len_len = count($users[$i]);

    	for($j=0;$j<$len_len;$j++){

    		echo $users[$i][$j]; //12345678910 		
    	}
    }

    /*
	foreach()遍历关联数组和索引数组,推荐用
		foreach($arr as $key=>$value)
				(要循环的数组 as 键=>值),默认的就是打印值
    */
    $users = ['name'=>'andre','age'=>20,'position'=>'SG','overall'=>'89'];

    foreach($users as $k=>$v){

    	echo $k.'==='.$v; //name===andr eage===20 position===SG overall===89
    }

    //默认只打印值
    foreach($users as $v){
    	echo $v; //andre 20 SG 89
    }

    //打印二维数组
    $users = [
			['name'=>'andre','age'=>20,'position'=>'SG','overall'=>'89'],
			['name'=>'kevin','age'=>23,'position'=>'SF','overall'=>'96'],
			['name'=>'tim','age'=>25,'position'=>'PF','overall'=>'98'],
		   ];
    
    foreach($users as $user){

    	//echo $user['age']; //20 23 25
    	foreach($user as $k=>$v){
    		echo $k.'==='.$v;
    		//echo '<br/>';写在里面,就是每打印一个,就换行
    	}

    	echo '<br/>';//每个一维数组打印完,再换行
    }

    /*
	each list while循环数组
		each() 
			传入一个数组,第一次返回第一个 键值对,带有4个元素的关联和索引数组的混合
			第二次返回数组的第二个 直到数组的最后一个返回false结束
		list()
			数组中索引的值从0开始
    */

     $users = ['name'=>'andre','age'=>20,'position'=>'SG','overall'=>'89'];
     var_dump(each($users)); 
    /*
		array(4) {
  			[1]=>
  			string(5) "andre"
  			["value"]=>
 			string(5) "andre"
  			[0]=>
  			string(4) "name"
  			["key"]=>
  			string(4) "name"
		}
    */
	var_dump(each($users)); 
	/*
		array(4) {
  			[1]=>
  			int(20)
  			["value"]=>
  			int(20)
  			[0]=>
  			string(3) "age"
 			["key"]=>
  			string(3) "age"
		}
	*/
	//            $users = ['name'=>'andre','age'=>20,'SG','89'];
	//list($position,$overall) = $users;//SG 89 一一对应
	//echo $position.'==='.$overall; //SG===89

	//while(list($key,$value) = each($user)){

	//	echo $value;
	//}

?>