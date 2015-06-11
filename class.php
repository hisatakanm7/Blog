<?php


class Database {       	
    	public $tim = array("");
	public $ym = array("");
	public $title = array("");
	public $user = array("");
	public $sentence = array("");
	public $count;
	public $blog_data = array("");
	public $month = array("");
	
	public function conect() {
		try {
			    $dbh2 = new PDO('mysql:host=localhost;dbname=blog_app','dbuser','yuki4416');
			} catch (PDOException $e2) {
			    var_dump($e2->getMessage());
			    exit;
			}
		
				
		$sql2 = "select * from users";
		$stmt2 = $dbh2->query($sql2);
		foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $user) {
		    $this->tim[] = $user["times"];
		    $this->ym[] = $user["timeYM"];
		    $this->title[] = $user['title'];
		    $this->sentence[] = $user['sentence'];
		    $this->count = count($this->tim);
		     }
	   }
	   
	   
		     
	 public function create_title($ymm){
			for($i = 1; $i <= $this->count; $i++){
				if($ymm == $this->ym[$i]){
					$create_time = $this->tim[$i];
					$blog_title = $this->title[$i];
					$this->blog_data[] = '<tr><td>'."$create_time".'</td><td><a href ='. "contents.php".'?ym='."$i".'>'."$blog_title".'</a></td></tr>';
				}
			}
	     }
	     
	     
	     
	     public function create_month($timeStamp){
		     	
			for($i=1; $i<13; $i++){
				$eachMonth = sprintf("%02d",$i);
				$presentYear = date("Y",$timeStamp);
				$eachYM = "$presentYear-$eachMonth";
				if(in_array($eachYM,$this->ym)){
					$this->month[] = '<a href ='. "yearMonth.php".'?ym='."$presentYear-$eachMonth".'>'."$i".'</a>';
				}else{$this->month[] = "$i";
				}
			}
		}

	     
    }
?>
