<?php
class viewcounts{
	

	/*
		article view counts class
	*/
	private $table;


	public function __construct($table){

		$this->table = $table;
	}

	public function record_view($counname,$idname,$id,$view){

		
		$sql="select * from $this->table where $idname=$id";
		$result=mysql_query($sql);
		$objresult=mysql_fetch_object($result);
		$count=$objresult->$counname;
		//更新数据库，并反回当前浏览数作为结果
		$count2=$count+1;
		if($view){

		$sql="update $this->table set $counname=$count2 where $idname=$id";
		mysql_query($sql);
		}
		return $count2;

	}
}
/**
 +----------------------------------------------------------------------
    
    $viewcounts= new viewcounts($table); 实例化对象
 +----------------------------------------------------------------------
   
    $viewcounts->record_view($counname,$idname,$id,$view);   
 
 +----------------------------------------------------------------------
 */
?>