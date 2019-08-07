<?php
	/*
	自定义一个函数	
		1.实现字符串反转 strrev
		2.分割成数组	str_split()
		3.求最大值和最小值 max min
	*/

	/*
	实现字符串反转hello-----olleh
	01234
	-5-4-3-2-1
		1.从后往前一个个截取,substr($str,-1,1),($str,-2,1)...
		2.从前往后,从最后一个开始截,substr($str,长度-1,1)--->substr($str,4,1),($str,3,1)... 
			接下来获取字符串长度$len =  strlen($str)-1
			循环打印4,3,2,1,0
			for($i=$len;$i>=0;$i--){
				//把循环打印后的字符用.=拼接起来,拼接后的与原字符串相反,命名也可以反过来,当然,首先还要给一个空字符串接受
				$rev_str .= substr($str,$i,1)
			}

		打印之前,最好还是判断一下字符串长度是否大于0
		为了适应字符串是中文的情况,可以考虑用mb_strlen,mb_substr
	*/
	$str = 'hello';
	//$str = '你好啊哈哈哈';

	function mb_str_rev($str){
		
		if(strlen($str)>0){

			//适应中文情况
			$len = mb_strlen($str)-1;
			$rev_str = '';
			for($i=$len;$i>=0;$i--){
				$rev_str .= mb_substr($str,$i,1);
			}

			return $rev_str;
		}else{

			echo '字符串长度不能为空';
		}
	}

	echo mb_str_rev($str);

	/*
	分割成数组
		str_split($str,2) 不传参数$step,默认值就是1,自定义的函数格式,也要与此类似
		首先,还是先算长度,考虑到可能出现2个一组,或者3个一组的情况 
			$len =  mb_strlen($str)
			$index = ceil($len/$step) 类似于分页	
			$i是分割的次数,也就是字符串最终分割成几份
			$step 每次分割几个字符,以$step=2为例
			mb_substr()的第二个参数,是从字符串的哪个位置开始截取
				字符串长度为11,每次取2个,一共取6次	
				第一次 0 1  h e  0*2=0 从位置0开始取 
				第二次 2 3  l l  1*2=2 从位置2开始取
				第三次 4 5  0    2*2=4 从位置4开始取
				第四次 6 7  w o  3*2=6 从位置6开始取
				第五次 8 9  r l  4*2=8 从位置8开始取
				第六次 10   d    5*2=10 从位置10开始取,然后结束循环 
				所以第二个参数应该设置为$i*$step
			for($i=0;$i<$index;$i++){
				$arr[$i] = mb_substr($str,$i*$step,$step)
			}

			return $arr;
	*/
	$str = 'hello world';

	function strSplit($str,$step=1){

		$len = mb_strlen($str);
		$index = ceil($len/$step);

		for($i=0;$i<$index;$i++){

			$arr[$i] = mb_substr($str,$i*$step,$step);
		}

		return $arr;
	}

	var_dump(strSplit($str,2));	
	//array(6) { [0]=> string(2) "he" [1]=> string(2) "ll" [2]=> string(2) "o " [3]=> string(2) "wo" [4]=> string(2) "rl" [5]=> string(1) "d" }
	
	/*
	求最大值,最小值 max min
		比较三个数,可以用三目运算符
	*/

	function arr_max($a,$b,$c){
		return $a>$b?($a>$c?$a:$c):($b>$c?$b:$c);
	}

	echo arr_max(7,10,6);

	function arr_min($a,$b,$c){
		return $a<$b?($a<$c?$a:$c):($b<$c?$b:$c);
	}

	echo arr_min(7,10,6);
?>