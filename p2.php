<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>九九乘法表</title>
	</head>
	<body>
		
		<table style="width:600px;margin:0 auto;text-align:center;border-collapse:collapse">
			<captain>左正三角</captain>
			<?php
				//输出九九乘法表
				//$i控制行,第一行1个式子,第二行2个,第三行3个...第九行9个
				for($i=1;$i<=9;$i++){
					echo '<tr>';
					//$j控制列,第一列是1-9乘以1,第二列是2-9乘以2,第三列是3-9乘以3....第九列是9乘以9
					for($j=1;$j<=$i;$j++){
						echo '<td>'.$i.'*'.$j.'='.$i*$j.'</td>';
					}
					echo '</tr>';
				}
			?>

			<br/>
			<captain>右正三角</captain>
			<?php
				/*
								1*1=1
								...
					   8*8=64...8*1=8	
				9*9=81 9*8=72...9*1=9
				*/
				for($i=1;$i<=9;$i++){
					echo '<tr>';
					//$z为空白,第一行8个空白,第二行7个...第九行0个,第九行时需要跳出该循环
					for($z=0;$z<9-$i;$z++){
						echo '<td></td>';
					}
					//$j依旧是控制列,第一列是9*9=81,因此需要把行数赋值给列
					for($j=$i;$j>=1;$j--){
						echo '<td>'.$i.'*'.$j.'='.$i*$j.'</td>';
					}		
					echo '</tr>';
				}
			?>

			<br/>
			<captain>左倒三角</captain>
			<?php
				
				for($i=9;$i>=1;$i--){
					echo '<tr>';
					
					/*
					9*1=9 9*2=18...9*8=72 9*9=81
					8*1=8 8*2=16...8*8=64 
					7*1=7
					....
					1*1=1
					*/
					for($j=1;$j<=$i;$j++){
						echo '<td>'.$i.'*'.$j.'='.$i*$j.'</td>';
					}		
					echo '</tr>';
				}
			?>

			<br/>
			<captain>右倒三角</captain>
			<?php
				/*
				第一行 9*9=81 9*8=72 9*7=63....9*1=9 
				第二行        8*8=64 8*7=56....8*1=8
				第九行                         1*1=1	
				*/
				for($i=9;$i>=1;$i--){
					echo '<tr>';
					//$z为空白,第一行0个空白,第二行1个...第九行8个
					for($z=0;$z<9-$i;$z++){
						echo '<td></td>';
					}
					//第一行第一列是9*9,因此依旧需要将行值赋值给列
					for($j=$i;$j>=1;$j--){
						echo '<td>'.$i.'*'.$j.'='.$i*$j.'</td>';
					}		
					echo '</tr>';
				}
			?>

		</table>
	</body>
</html>