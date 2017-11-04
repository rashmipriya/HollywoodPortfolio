<?php

class DBCONNECT{

  private $SERVERNAME;
  private $USERNAME;
  private $PASSWORD;
  private $DBNAME;  

  protected function connect(){
     $this->SERVERNAME ="localhost";
	 $this->USERNAME ="root";
	 $this->PASSWORD ="root";
	 $this->DBNAME ="hollywoodportfolio";
	 
	 $conn = new mysqli($this->SERVERNAME, $this->USERNAME,$this->PASSWORD,$this->DBNAME);
	 return $conn;
  }
}