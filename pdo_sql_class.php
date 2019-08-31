<?php

class Db{

		//私有的静态属性,存储类的实例化对象
		private static $instance;

		//存储PDO类
		private $pdo;

		//存储PDOStament
		private $stmt;

		//构造函数私有,禁止外部new类
		private function __construct($config,$port=3306,$charset="utf8"){

			//自动连接数据库
			try{
		
				$this->pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].';port='.$port.';charset='.$charset.'',$config['user'],$config['password']);
		
				//开启异常,默认是silent,需要改成exception
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			}catch(PDOException $e){

				echo 'mysql connect error:'.$e->getMessage();
			}

			//var_dump($this->pdo); //object(PDO)#2 (0) { }
		}

		//克隆函数私有,禁止外部克隆对象
		private function __clone(){

		}

		//对外访问的静态方法,实现 类的实例
		public static function getInstance($config){

			
			//判断外部调用是否有实例化,没有 就实例化
			if(!self::$instance instanceof Db){

				//1.实例化的时候就连接数据库
   				self::$instance = new self($config);//相当于new Db;
			}

			//有 直接返回实例化
			return self::$instance;
		}

		//插入一条  数据
		public function insertData($table,$data){

			//拼接插入的字段名
			$columns = implode(',',array_keys($data));

			//拼接占位符
			$values = ':'.implode(',:',array_keys($data));
			//传入的数据处理一下
			$sql = "INSERT INTO $table($columns) VALUES($values)";

			$this->stmt = $this->pdo->prepare($sql);

			//处理插入的数据
			foreach($data as $k=>$v){
				$key = ':'.$k;
				$newData[$key] = $v;
			}

			$this->stmt->execute($newData);

			//判断是否插入成功
			if($this->stmt->errorCode()==00000){
				return $this->pdo->lastInsertId();
			}else{
				return $this->stmt->errorInfo()[2];
			}
		}

		//更新一条数据
		public function updateData($table,$data,$where){

			//调用select,查询 where条件是否在数据表中存在,$where必须有,没有不允许更新
			$res = $this->getOne($table,array_keys($data),$where);

			if(!$res){
				return '不存在你要更新的数据';
			}

			$columns = '';
			//处理更新数据
			foreach($data as $k=>$v){
				$columns.=$k.'=:'.$k.',';
			}

			$columns = trim($columns,',');

			$sql = "UPDATE $table SET $columns $where";

			$this->stmt = $this->pdo->prepare($sql);

			//处理插入的数据
			foreach($data as $k=>$v){
				$key = ':'.$k;
				$newData[$key] = $v;
			}

			$this->stmt->execute($newData);

			//判断是否更新成功
			if($this->stmt->errorCode()==00000){
				return 1;  
			}else{
				return $this->stmt->errorInfo()[2];
			}
		}

		//查询一条数据
		public function getOne($table,$fields,$where){

			//当查询的字段数超过两个,再用,拼接
			if(count($fields)>1){
				$columns = implode(',',array_values($fields));
			}elseif($fields=='*'){
				$columns = '*';
			}else{
				$columns = $fields[0];
			}
		
			$sql = "SELECT $columns FROM $table $where";
			$this->stmt = $this->pdo->prepare($sql);

			$this->stmt->execute();

			if($this->stmt->errorCode()==00000){
				return $this->stmt->fetch(PDO::FETCH_ASSOC);  
			}else{
				return $this->stmt->errorInfo()[2];
			}

		}

		//查询多条数据
		public function getAll($table,$fields,$where){

			//当查询的字段数超过两个,再用,拼接
			if(count($fields)>1){
				$columns = implode(',',array_values($fields));
			}elseif($fields=='*'){
				$columns = '*';
			}else{
				$columns = $fields[0];
			}
		
			$sql = "SELECT $columns FROM $table $where";
			$this->stmt = $this->pdo->prepare($sql);

			$this->stmt->execute();

			if($this->stmt->errorCode()==00000){
				return $this->stmt->fetchAll(PDO::FETCH_ASSOC);  
			}else{
				return $this->stmt->errorInfo()[2];
			}

		}

		//删除一条数据
		public function deleteData($table,$where){

			$sql = "DELETE FROM $table $where";

			$res = $this->getOne($table,['*'],$where);

			if(!$res){
				return '不存在你要删除的数据';
			}

			$this->stmt = $this->pdo->prepare($sql);

			$this->stmt->execute();

			if($this->stmt->errorCode()==00000){
				return 1;  
			}else{
				return $this->stmt->errorInfo()[2];
			}

		}

	}




	

	//连接数据库的格式
	//$config = ['host'=>'127.0.0.1','dbname'=>'lamp','user'=>'root','password'=>'123456'];
	//$db  = Db::getInstance($config);

	//插入一条数据 传入表名和要查询的数据
	//插入多条数据的时候,是二维数组
	//$table = 'user';
	//字段名,字段值一一对应
	//$data = ['username'=>'ak','password'=>'122121','fee'=>'2000'];
	//$db->insertData($table,$data);


	//更新一条数据
	//$table = 'user';
	//$data  = ['username'=>'ooo','password'=>'11111111'];
	//echo $db->updateData($table,$data,'WHERE id=3');

	//查询一条数据
	//$sql = "SELECT username,fee FROM user WHERE id=1/ LIMIT 1";
	//$fields = ['username','fee'];
	//$fields = '*';
	//$table = 'user';
	//var_dump($db->getOne($table,$fields,'LIMIT 1'));

	//查询多条数据
	//$sql = "SELECT username,fee FROM user WHERE id>1/ LIMIT 10";
	//$fields = ['username','fee'];
	//$fields = '*';
	//$table = 'user';
	//var_dump($db->getAll($table,$fields,'LIMIT 10'));

	//删除一条数据
	//echo $db->deleteData('user','WHERE id=12');
?>