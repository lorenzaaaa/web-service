<?php
class Api{
	public $conn;
	
	public function __construct(){
		$servername = "localhost:2222";
		$username = "userlocal";
		$password = "adminuser2019";
		$database = "northwind";
		
		try{
			$this->conn = new PDO("mysql:host=$servername;dbname=$database",
								$username,$password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Connection failed : ".$e->getMessage();
		}
	}
	
	public function get ($keyword="",$password,$limit=""){
		$limit = isset($_GET['limit']) ? (int) $_GET['limit']: 0;
		$name = isset($_GET['name']) ? $_GET['name']:'';
		
		$sql_limit = (!empty($limit))? ' LIMIT 0,'.$limit : '';
		$sql_name = (!empty($name))? ' WHERE p.ProductName LIKE \'%'.$name.'%\' ': '';
		
		$sql = "SELECT * FROM products AS p JOIN categories AS c
				ON p.CategoryID=c.CategoryID ".$sql_name." ".$sql_limit;
		$data = $this->conn->prepare($sql);
		$data->execute();
		$products =[];
		while ($row = $data->fetch(PDO::FETCH_OBJ)){
			$products[] = ["ProductID"=> $row->ProductID,
							"ProductName"=> $row->ProductName,
							"CategoryName"=> $row->CategoryName,
							"UnitPrice"=> $row->UnitPrice,
							"UnitsInStock"=> $row->UnitsInStock];
		}
		
		$this->conn = null;
		header('Content-Type: application/json');
		
		$arr = array();
		$arr['info'] = 'success';
		$arr['num'] = count($products);
		$arr['result'] = $products;
		
		return json_encode (array('ITEM'=>$arr),JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
		}
		
		public function post($url,$params){
			$payload = json_encode($params);
			$ch = curl_init($url);
			
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'content-Type: aplplication/json',
				'content-Length: ' . strlen($payload))
			);
			$json_response = curl_exec($ch);
			$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);

			$response = json_decode($json_response, true);

	        return $json_response;

		}
		
		public function put($url,$params){
			$payload = json_encode($params);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'content-Type: aplplication/json',
				'content-Length: ' . strlen($payload))
			);
			$result = curl_exec ($ch);
			curl_close($ch);
			return $result;
		}
		
		public function cancel($url,$params){
			$payload = json_encode($params);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'content-Type: aplplication/json',
				'content-Length: ' . strlen($payload))
			);
			$result = curl_exec ($ch);
			curl_close($ch);
			return $result;
		}
}
?>