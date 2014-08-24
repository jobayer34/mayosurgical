<?php
/**
 * this class provide the functionalities for teletalk top-up database oprerations.
 * this class require DB configuration . so you should require('classes/db-config.php');
 * 
****/
class DB{
	public $pdo;
	public $lastInsertId;
	public $affected_rows;
	public $pdo_error;
	public $error_msg;

	public function __construct(){
            try{
                    $this->pdo=new PDO('mysql:host='.MARGE_DB_HOST.';dbname='.MARGE_DB_NAME,MARGE_DB_USER,MARGE_DB_PASS);
                    $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

            }catch(PDOException $e)
            {
                    $this->error_msg='<h2>Database Connection Error</h2>';
                    $this->pdo_error=$e->getMessage();
                    $this->error_log($this->pdo_error);
            }
		
	} // end constructor
	
	
	/*****
	@table_name= name of the table
	@data = filed_name => value paired array
	*/
	public function insert($table_name,$data){
		$sql="INSERT INTO `".$table_name."` SET ";
		foreach($data as $field=>$val) {
			$sql .=" `$field`=:$field,";
		}
		$sql=rtrim($sql,',');
		$statement=$this->pdo->prepare($sql);
		foreach($data as $field=>$val) {
			$statement->bindValue(":{$field}",$val);
		}
		try{
			$statement->execute();
			$this->affected_rows=$statement->rowCount();
			$this->lastInsertId=$this->pdo->lastInsertId();
			return true;
			
		}catch(PDOException $e){
			
			$this->error_msg='Insertion Failed';
			$this->pdo_error=$e->getMessage();
			$this->error_log($this->pdo_error);
			return false;
		}
		
		
	} // end insert()
	
	
	/*
	@table_name= name of the table
	@data = filed_name => value paired array
	@where = where clause for update the table
	*/	
	public function update($table_name, $data, $where,$join='OR') {
		$sql="UPDATE `".$table_name."` SET ";
		foreach($data as $field=>$val) {
			$sql .=" `{$field}`=:{$field},";
		}
		$sql=rtrim($sql,',');
		$sql .=' WHERE ';
		foreach($where as $field=>$val) 
		{
			$sql .="`{$field}`=:{$field} {$join}";
		}
		if($join=='OR') $sql =substr($sql,0,-2);
		if($join=='AND') $sql =substr($sql,0,-3);
		  
		$statement=$this->pdo->prepare($sql);
		foreach($where as $field=>$val) 
		{
			$statement->bindValue(":{$field}",$val);
		}
		foreach($data as $field=>$val) 
		{
			$statement->bindValue(":{$field}",$val);
		}
	
		
		try{
			$statement->execute();
			
			$this->affected_rows=$statement->rowCount();			
			return true;
			
		}catch(PDOException $e){
			
			$this->error_msg='update Failed';
			$this->pdo_error=$e->getMessage();
			$this->error_log($this->pdo_error);
			return false;
		}
		
	} // end update()
	
	
	
	/*
	@table_name= name of the table
	@where = where clause for select rows field=>value paired array
	@join = OR  | AND . default is OR
	*/	
	public function select($table_name,$where,$join='OR') {
		$join =strtoupper($join);
		$sql="SELECT * FROM `".$table_name."` WHERE ";
		foreach($where as $field=>$val) 
		{
			$sql .="`{$field}`=:{$field} {$join}";
		}
		if($join=='OR') $sql =substr($sql,0,-2);
		if($join=='AND') $sql =substr($sql,0,-3);
		  
		$statement=$this->pdo->prepare($sql);
		foreach($where as $field=>$val) 
		{
			$statement->bindValue(":{$field}",$val);
		}
		
		try{
			
			if($statement->execute()===TRUE)
			{
			$this->affected_rows=$statement->rowCount();
			return $statement->fetchAll();
			}
			
			
		}catch(PDOException $e){
			
			$this->error_msg='select Failed';
			$this->pdo_error=$e->getMessage();
			$this->error_log($this->pdo_error);
			return false;
		}
		
	} // end update()
		
		
	
	/*
	this function will execute the sql statement receive as parameter
	@sql= sql query of the database
	*/	
	public function query($sql) {
		$statement=null;
		$this->lastInsertId=0;
		$this->affected_rows=0;
	
		try{
			
			$statement=$this->pdo->query($sql);
			if($statement)
			{
				$this->affected_rows=$statement->rowCount();
				$this->lastInsertId=$this->pdo->lastInsertId();
				return $statement;
			}else
			{
				return false;
			}
			
			
			
		}catch(PDOException $e){
			
			$this->error_msg='query Failed';
			$this->pdo_error=$e->getMessage();
			$this->error_log($this->pdo_error);
			return false;
		}
		
	} // end query()
	
	
	public function close(){
	    $this->pdo = NULL;
	}
		
	
	public function error_msg(){
		return $this->error_msg;
	}
	
	
	public function error_log($msg){
		file_put_contents(LOG_DIR."manual_marge_db_errors.log","\r\n\r\n".$msg,FILE_APPEND);
	}
	
	
	public function pdo_error(){
		return $this->pdo_error;
	}
	
	public function lastInsertId(){
		return $this->lastInsertId;
	}
	
	
	public function affected_rows(){
		return $this->affected_rows;
	}
	
}

?>