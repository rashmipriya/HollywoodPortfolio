<?php

   class DATAVIEWER extends DAL {

    public function showAllActorRevenue(){
   
       $datas = $this->getAllActorRevenue();
	   if($datas>0){
	   foreach($datas as $data){
	    $actor= $data["ACTOR_NAME"];
		$actorrevenue =0;
		$BaseAmount = $data["BASE_AMOUNT"];
		$RevenueShare = $data["REV_SHARE"];
		$actorrevenue = $BaseAmount + $RevenueShare;
		 echo "<tr>";
		   echo "<th>$actor</th>";
		   echo "<th>$actorrevenue</th>";
		  echo "</tr>";
	   }
	   }
	}
   
    public function showProductionCompanyRevenue(){
		 
	  $datas = $this->getProductionCompanyRevenue();
	  if($datas>0){
	  foreach($datas as $data){
	    $ProductionCompanyName= $data["PRODUCTION_COMPANY_NAME"];
		$Revenue = $data["Revenue"];
		$GainorLoss = $data["GainorLoss"];
		   echo "<tr>";
		   echo "<th>$ProductionCompanyName</th>";
		   echo "<th>$Revenue</th>";
		   echo "<th>$GainorLoss</th>";
		   echo "</tr>";
		 }	 
	  }
	}
	
	public function showActorInfo($actor_name){
	
       $datas = $this->getActorInfo($actor_name);
	   if(empty($datas)){
		   echo 'Actor was not found in the database';
	   }else{
	   foreach($datas as $data){
		  $actor_name = $data['ACTOR_NAME'];
		  $movie_name= $data['MOVIE_NAME'];
		  $base_amount= $data['BASE_AMOUNT'];
		  echo "<tr>";
	      echo "<th>$actor_name</th>";
	      echo "<th>$movie_name</th>";
		  echo "<th>$base_amount</th>";
		  echo "</tr>";
	   }}
	   }
	  
	public function showScriptInfo(){
	
     $datas = $this->getScriptInfo();
	 if($datas >0){
	   foreach($datas as $data){
		  $movie_name= $data['MOVIE_NAME'];
		  $actor_name = $data['ACTOR_NAME'];
		  $character_name = $data['CHARACTER_NAME'];
		  $a = $data['LINES_IN_THE_MOVIE'];
		  $number_of_lines = $data['NUMBER_OF_LINES'];
		  $number_of_words = $data['NUMBER_OF_WORDS'];
		  echo "<tr>";
		  echo "<th>$movie_name</th>";
	      echo "<th>$actor_name</th>";
	      echo "<th>$character_name</th>";
		  echo "<th>$a</th>";
		  echo "<th>$number_of_lines</th>";
		  echo "<th>$number_of_words</th>";
		  echo "</tr>";
	   }
	 }	   
	}
	
	public function showCharacterReferenceInfo(){
		$datas = $this->getCharacterReferenceInfo();
		if($datas >0){
	   foreach($datas as $data){
		  $movie_name= $data['MOVIE_NAME'];
		  $character_name = $data['CHARACTER_NAME'];
		  $character_refrence = $data['CHARACTER_REFRENCE'];
		  echo "<tr>";
		  echo "<th>$movie_name</th>";
	      echo "<th>$character_name</th>";
		  echo "<th>$character_refrence</th>";
		  echo "</tr>";
	   }
	  }	   
	}
   }
?>