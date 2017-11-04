<?php

   class DAL extends DBCONNECT {
      
	  protected function getAllActorRevenue() {
		  
		    $sql = "SELECT ACTOR_NAME, SUM(BASE_AMOUNT) AS BASE_AMOUNT, SUM((CASE WHEN (MOVIE_REVENUE-MOVIE_BUDGET) > 0 
			THEN REVENUE_SHARE * (MOVIE_REVENUE-MOVIE_BUDGET) ELSE 0 END)/100) AS REV_SHARE FROM ACTOR_LIST 
			LEFT JOIN ACTOR_REVENUE_PER_MOVIE ON ACTOR_LIST.ACTOR_ID=ACTOR_REVENUE_PER_MOVIE.ACTOR_ID 
			LEFT JOIN REVENUE_PER_MOVIE ON ACTOR_REVENUE_PER_MOVIE.MOVIE_ID=REVENUE_PER_MOVIE.MOVIE_ID GROUP BY ACTOR_NAME
			ORDER BY BASE_AMOUNT DESC";
			
			return $this->executeQuery($sql);
	  }
	  
	  protected function getProductionCompanyRevenue(){
		  
		 $sql = "SELECT PRODUCTION_COMPANY_NAME, SUM(MOVIE_REVENUE) as Revenue, 
	        SUM(MOVIE_REVENUE)-SUM(MOVIE_BUDGET) as GainorLoss from PRODUCTION_COMPANY 
	        LEFT JOIN REVENUE_PER_MOVIE on PRODUCTION_COMPANY.PRODUCTION_COMPANY_ID = REVENUE_PER_MOVIE.PRODUCTION_COMPANY_ID group 
			by PRODUCTION_COMPANY.PRODUCTION_COMPANY_ID";
			
			return $this->executeQuery($sql);
	  }
	  
      protected function getActorInfo($actor_name){
		  
		$sql ="SELECT ACTOR_LIST.ACTOR_NAME AS ACTOR_NAME, MOVIE_NAME, BASE_AMOUNT from ACTOR_LIST LEFT JOIN 
		      ACTOR_REVENUE_PER_MOVIE
			  ON ACTOR_LIST.ACTOR_ID = ACTOR_REVENUE_PER_MOVIE.ACTOR_ID LEFT JOIN REVENUE_PER_MOVIE ON REVENUE_PER_MOVIE.MOVIE_ID = ACTOR_REVENUE_PER_MOVIE.MOVIE_ID
	          WHERE ACTOR_NAME='$actor_name'";
			  
	    return $this->executeQuery($sql);
		}
		
	  protected function getScriptInfo(){
	   
	   $sql= "SELECT MOVIE_NAME, ACTOR_NAME, CHARACTER_NAME, LINES_IN_THE_MOVIE,
	          (LENGTH(LINES_IN_THE_MOVIE) - LENGTH(replace(LINES_IN_THE_MOVIE, '.', ''))) as NUMBER_OF_LINES,
              LENGTH(LINES_IN_THE_MOVIE) - LENGTH(replace(LINES_IN_THE_MOVIE, ' ', ''))+1 as NUMBER_OF_WORDS
              FROM `MOVIE_SCRIPT` LEFT JOIN REVENUE_PER_MOVIE ON MOVIE_SCRIPT.MOVIE_ID=REVENUE_PER_MOVIE.MOVIE_ID
			  LEFT JOIN MOVIE_CHARACTERS ON MOVIE_SCRIPT.CHARACTER_ID=MOVIE_CHARACTERS.CHARACTER_ID
			  LEFT JOIN ACTOR_LIST ON MOVIE_CHARACTERS.ACTOR_ID=ACTOR_LIST.ACTOR_ID";
	    
	   return $this->executeQuery($sql);
	  }
	  
	  protected function getCharacterReferenceInfo(){
		  
	  $sql= "SELECT MOVIE_NAME, CHARACTER_NAME, SUM(round(CASE WHEN CHARACTER_NAME LIKE '% %' THEN((length(LINES_IN_THE_MOVIE)-
	        LENGTH(replace(LINES_IN_THE_MOVIE, TRIM( SUBSTR(CHARACTER_NAME, LOCATE(' ', CHARACTER_NAME)) ), '')))/
			Length(TRIM( SUBSTR(CHARACTER_NAME, LOCATE(' ', CHARACTER_NAME)) )))
            ELSE((length(LINES_IN_THE_MOVIE)-LENGTH(replace(LINES_IN_THE_MOVIE,CHARACTER_NAME , '')))/
			Length(CHARACTER_NAME))END)) as CHARACTER_REFRENCE
            FROM MOVIE_CHARACTERS LEFT JOIN MOVIE_SCRIPT on MOVIE_SCRIPT.MOVIE_ID = MOVIE_CHARACTERS.MOVIE_ID
			LEFT JOIN REVENUE_PER_MOVIE ON MOVIE_SCRIPT.MOVIE_ID=REVENUE_PER_MOVIE.MOVIE_ID
			WHERE MOVIE_SCRIPT.CHARACTER_ID != MOVIE_CHARACTERS.CHARACTER_ID
			group by MOVIE_SCRIPT.MOVIE_ID,MOVIE_CHARACTERS.CHARACTER_ID";
			
	    return $this->executeQuery($sql);
	  }
	  
	 protected function executeQuery($sql){
		 
		$result = $this->connect()->query($sql);
	    $numRows = $result->num_rows;
	   
	    if($numRows > 0){
	      while($row = $result -> fetch_assoc()){
		      $data[]=$row;
		  }  
	    return $data;
	  }		 
	 }
	 
	 public function addactor($actor_name) {
		    
			$sqltocheck ="SELECT ACTOR_NAME FROM ACTOR_LIST WHERE ACTOR_NAME='$actor_name'";
			$datas = $this->executeQuery($sqltocheck);
			if($datas >0){
				echo 'An Actor with same name already exists in the database. Please try a different name.'. "<br />";
			}else{
		    $sql = "INSERT INTO ACTOR_LIST(ACTOR_NAME) VALUES('$actor_name')";
			$this->connect()->query($sql);
			echo("<script>alert('Data added successfully!')</script>");
            echo("<script>window.location = 'addactor.php';</script>");
			}
	  }
	 public function addmovies($movie_name, $production_company_Id,$movie_budget,$movie_revenue) {
		    
			$sqltocheck ="SELECT PRODUCTION_COMPANY_ID FROM PRODUCTION_COMPANY WHERE PRODUCTION_COMPANY_ID='$production_company_Id'";
			$datas = $this->executeQuery($sqltocheck);
			if($datas ==0){
				echo 'You have entered a wrong Production Company Id<br\>. Please find the menu of Production Company Id and Names'."<br />"."<br />";
				$sqltogetmenu ="SELECT PRODUCTION_COMPANY_ID,PRODUCTION_COMPANY_NAME FROM PRODUCTION_COMPANY";
			    $menu = $this->executeQuery($sqltogetmenu);
				foreach($menu as $data){
				  $prodId = $data['PRODUCTION_COMPANY_ID'];
	              $prodname = $data['PRODUCTION_COMPANY_NAME'];
				  echo $prodId. " ";
				  echo $prodname. "<br />". "<br />";
		        }
			}else{
		    $sql = "INSERT INTO REVENUE_PER_MOVIE(`PRODUCTION_COMPANY_ID`, `MOVIE_NAME`, `MOVIE_BUDGET`, `MOVIE_REVENUE`)
			        VALUES('$production_company_Id','$movie_name','$movie_budget','$movie_revenue')";
			$this->connect()->query($sql);
			echo("<script>alert('Data added successfully!')</script>");
            echo("<script>window.location = 'addmovies.php';</script>");
			
			}
	 }
	 
	 public function addmoviedetails($movie_name,$first,$second,$third,$fourth){
		$sqltocheckmovie ="SELECT MOVIE_ID FROM REVENUE_PER_MOVIE WHERE MOVIE_NAME='$movie_name'";
		$sqltocheckactors ="SELECT ACTOR_NAME FROM ACTOR_LIST";
		$resultmovie = $this->connect()->query($sqltocheckmovie);
		$resultactors = $this->connect()->query($sqltocheckactors);
	    $numRowmovie = $resultmovie->num_rows;
		$numRowactors = $resultactors->num_rows;
	    if($numRowmovie <=0){
		    echo 'Movie Name does not exist. You can add a new movie below'. "<br />";
		    $link_address = 'addmovies.php';
			echo "<a href='".$link_address."'>Click here to Add Movies</a>". "<br />";
		}else if($numRowactors != $first[0] || $numRowactors != $first[1] || $numRowactors != $first[2]  || $numRowactors != $first[3] ){
		    echo 'All/Some actor names are not correct. Please check the actor names. You can add a new actor below'. "<br />";
		    $link_address = 'addactor.php';
			echo "<a href='".$link_address."'>Click here to Add Actor</a>". "<br />";
		}
		else{
		$result = $this->connect()->query($sqltocheckmovie);
		$movieid= $result -> fetch_assoc(); 
        $id= $movieid['MOVIE_ID'];
		for($i=0; $i < 4; $i ++){
		   	 $sqltogetactorid ="SELECT ACTOR_ID FROM ACTOR_LIST WHERE ACTOR_NAME='$first[$i]'";
			 $results = $this->connect()->query($sqltogetactorid);
	         $newnumRow = $results->num_rows;
			 $actorid = $results -> fetch_assoc(); 
			 $actor= $actorid['ACTOR_ID'];
             $sqltoinsertactorrevenuepermovie="INSERT INTO ACTOR_REVENUE_PER_MOVIE( `ACTOR_ID`,`MOVIE_ID`,`BASE_AMOUNT`,`REVENUE_SHARE`) 
			                                  VALUES ('$actor','$id','$third[$i]','$fourth[$i]')";
			 $this->connect()->query($sqltoinsertactorrevenuepermovie);
		    }
            echo("<script>alert('All enteries were added successfully!')</script>");
            echo("<script>window.location = 'addcharactertomovie.php';</script>");
		}
		}
   }
?>