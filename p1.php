<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>输出1-25</title>
	</head>
	<body>
		
		<table style="width:600px;margin:0 auto;text-align:center;border-collapse:collapse">
			<captain>用while循环输出一个表格,从1-25,5行5列,白色和灰色交替出现</captain>

			<?php
				$i = 1;
				while($i<=5){

					//类似某种颜色在两行之间交替出现的场景,首先考虑使用使用行数取余,再结合?:来实现
					$bg_color = ($i%2)?'':'gray';
					echo '<tr style="background-color:'.$bg_color.'">';
					$j = 1;
					while($j<=5){

						//类似某一列开头找规律的场景,可以参考用列数-1,再乘几,再加几的思路
						//第一列开头是1,第二列开头是6,第三列开头是11,(列数-1)*5+1
						echo '<td>'.(($i-1)*5+$j).'</td>';
						$j++;
					}
					echo '</tr>';
					$i++;
				}
			?>
		</table>
	</body>
</html>
