<?php

   class DAL extends DBCONNECT {
      
	  //below function calculates actor revenues.
	  protected function getAllActorRevenue() {
		  
		    $sql = "SELECT ACTOR_NAME, SUM(BASE_AMOUNT) AS BASE_AMOUNT, SUM((CASE WHEN (MOVIE_REVENUE-MOVIE_BUDGET) > 0 
			THEN REVENUE_SHARE * (MOVIE_REVENUE-MOVIE_BUDGET) ELSE 0 END)/100) AS REV_SHARE FROM ACTOR_LIST 
			LEFT JOIN ACTOR_REVENUE_PER_MOVIE ON ACTOR_LIST.ACTOR_ID=ACTOR_REVENUE_PER_MOVIE.ACTOR_ID 
			LEFT JOIN REVENUE_PER_MOVIE ON ACTOR_REVENUE_PER_MOVIE.MOVIE_ID=REVENUE_PER_MOVIE.MOVIE_ID GROUP BY ACTOR_NAME
			ORDER BY BASE_AMOUNT DESC";
			
			return $this->executeQuery($sql);
	  }
	  
	  //below function calculates Production Company Revenue.
	  protected function getProductionCompanyRevenue(){
		  
		 $sql = "SELECT PRODUCTION_COMPANY_NAME, SUM(MOVIE_REVENUE) as Revenue, 
	        SUM(MOVIE_REVENUE)-SUM(MOVIE_BUDGET) as GainorLoss from PRODUCTION_COMPANY 
	        LEFT JOIN REVENUE_PER_MOVIE on PRODUCTION_COMPANY.PRODUCTION_COMPANY_ID = REVENUE_PER_MOVIE.PRODUCTION_COMPANY_ID group 
			by PRODUCTION_COMPANY.PRODUCTION_COMPANY_ID";
				
			return $this->executeQuery($sql);
	  }
	  
	  //below function gets an actor's movies and base amount charged in each.
      protected function getActorInfo($actor_name){
		  
		$sql ="SELECT ACTOR_LIST.ACTOR_NAME AS ACTOR_NAME, MOVIE_NAME, BASE_AMOUNT from ACTOR_LIST LEFT JOIN 
		      ACTOR_REVENUE_PER_MOVIE
			  ON ACTOR_LIST.ACTOR_ID = ACTOR_REVENUE_PER_MOVIE.ACTOR_ID LEFT JOIN REVENUE_PER_MOVIE ON REVENUE_PER_MOVIE.MOVIE_ID = ACTOR_REVENUE_PER_MOVIE.MOVIE_ID
	          WHERE ACTOR_NAME='$actor_name'";
			  
	    return $this->executeQuery($sql);
		}
	
     //below function calculates number of lines and words in a script.	
	  protected function getScriptInfo(){
	   
	   $sql= "SELECT MOVIE_NAME, ACTOR_NAME, CHARACTER_NAME, LINES_IN_THE_MOVIE,
	          (LENGTH(LINES_IN_THE_MOVIE) - LENGTH(replace(LINES_IN_THE_MOVIE, '.', ''))) as NUMBER_OF_LINES,
              LENGTH(LINES_IN_THE_MOVIE) - LENGTH(replace(LINES_IN_THE_MOVIE, ' ', ''))+1 as NUMBER_OF_WORDS
              FROM `MOVIE_SCRIPT` LEFT JOIN REVENUE_PER_MOVIE ON MOVIE_SCRIPT.MOVIE_ID=REVENUE_PER_MOVIE.MOVIE_ID
			  LEFT JOIN MOVIE_CHARACTERS ON MOVIE_SCRIPT.CHARACTER_ID=MOVIE_CHARACTERS.CHARACTER_ID
			  LEFT JOIN ACTOR_LIST ON MOVIE_CHARACTERS.ACTOR_ID=ACTOR_LIST.ACTOR_ID";
	    
	   return $this->executeQuery($sql);
	  }
	  
	  //below function counts number of times a character's reference is made by other character.
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
	 
     //function to execute a select query	 
	 protected function executeQuery($sql){
		 
		if (!$this->connect()) {
         die("Connection failed: " . mysqli_connect_error());
        }
		else{
		$result = $this->connect()->query($sql);
	    $numRows = $result->num_rows;
	   
	    if($numRows > 0){
	      while($row = $result -> fetch_assoc()){
		      $data[]=$row;
		  }  
	    return $data;
	      }
		}	  
	 }
	 
	 //function to add an actor.
	 public function addactor($actor_name) {
		    
			$sqltocheck ="SELECT ACTOR_NAME FROM ACTOR_LIST WHERE ACTOR_NAME='$actor_name'";
			$datas = $this->executeQuery($sqltocheck);
			if($datas >0){
				echo 'An Actor with same name already exists in the database. Please try a different name.'. "<br />";
			}else{
		    $sql = "INSERT INTO ACTOR_LIST(ACTOR_NAME) VALUES('$actor_name')";
			if (!$this->connect()) {
            die("Connection failed: " . mysqli_connect_error());
            }else{
			$this->connect()->query($sql);
			echo("<script>alert('".$actor_name." was added successfully!')</script>");
            echo("<script>window.location = 'addactor.php';</script>");
			}
		}
	  }
	  
	  //function to add movies to the database.
	 public function addmovies($movie_name, $production_company_Id,$movie_budget,$movie_revenue) {
		    
			$sqltocheckproductionid ="SELECT PRODUCTION_COMPANY_ID FROM PRODUCTION_COMPANY WHERE PRODUCTION_COMPANY_ID='$production_company_Id'";
			$sqltocheckmoviename ="SELECT MOVIE_NAME FROM REVENUE_PER_MOVIE WHERE MOVIE_NAME='$movie_name'";
			$productiondata = $this->executeQuery($sqltocheckproductionid);
			$moviedata = $this->executeQuery($sqltocheckmoviename);
			if($productiondata ==0){
				echo 'You have entered a wrong Production Company Id<br\>. Please find the menu of Production Company Id and Names'."<br />"."<br />";
				$sqltogetmenu ="SELECT PRODUCTION_COMPANY_ID,PRODUCTION_COMPANY_NAME FROM PRODUCTION_COMPANY";
			    $menu = $this->executeQuery($sqltogetmenu);
				foreach($menu as $data){
				  $prodId = $data['PRODUCTION_COMPANY_ID'];
	              $prodname = $data['PRODUCTION_COMPANY_NAME'];
				  echo $prodId. " ";
				  echo $prodname. "<br />". "<br />";
		        }
			}else if($moviedata>0){
				echo 'The movie name already exists in the database'."<br />"."<br />";
			}
			else{
		    $sql = "INSERT INTO REVENUE_PER_MOVIE(`PRODUCTION_COMPANY_ID`, `MOVIE_NAME`, `MOVIE_BUDGET`, `MOVIE_REVENUE`)
			        VALUES('$production_company_Id','$movie_name','$movie_budget','$movie_revenue')";
					if (!$this->connect()) {
            die("Connection failed: " . mysqli_connect_error());
            }else{		
			$this->connect()->query($sql);
			echo("<script>alert(' Movie Name: ".$movie_name." Production Id: ".$production_company_Id." Budget: ".$movie_budget." Revenue ".$movie_revenue." added successfully!')</script>");
            echo("<script>window.location = 'addmovies.php';</script>");
			}
			}
	 }
	 
	 //function to add actors, characters, base amounts and revenues to the database.
	 public function addmoviedetails($movie_name,$actors,$characters,$baseamounts,$revenues){
		$sqltocheckmovie ="SELECT MOVIE_ID FROM REVENUE_PER_MOVIE WHERE MOVIE_NAME='$movie_name'";
		$sqltocheckactors ="SELECT ACTOR_NAME FROM ACTOR_LIST WHERE ACTOR_NAME IN ('$actors[0]','$actors[1]','$actors[2]','$actors[3]')";
		$resultmovie = $this->connect()->query($sqltocheckmovie);
		$resultactors = $this->connect()->query($sqltocheckactors);
	    $numRowmovie = $resultmovie->num_rows;
		$numRowactors = $resultactors->num_rows;
	    if($numRowmovie <=0){
		    echo 'Movie Name does not exist. You can add a new movie below'. "<br />";
		    $link_address = 'addmovies.php';
			echo "<a href='".$link_address."'>Click here to Add Movies</a>". "<br />";
		}
		else if($numRowactors < 4){
			echo 'All/Some actor names are not correct. Please check the actor names. You can add a new actor below'. "<br />";
		    $link_address = 'addactor.php';
			echo "<a href='".$link_address."'>Click here to Add Actor</a>". "<br />";
		}
		else{
			$result = $this->connect()->query($sqltocheckmovie);
		    $movieid= $result -> fetch_assoc(); 
            $id= $movieid['MOVIE_ID'];
		    for($i=0; $i < 4; $i ++){
		   	 $sqltogetactorid ="SELECT ACTOR_ID FROM ACTOR_LIST WHERE ACTOR_NAME='$actors[$i]'";
			 $results = $this->connect()->query($sqltogetactorid);
			 $actorid = $results -> fetch_assoc(); 
			 $actor= $actorid['ACTOR_ID'];
             $sqltoinsertactorrevenuepermovie="INSERT INTO ACTOR_REVENUE_PER_MOVIE( `ACTOR_ID`,`MOVIE_ID`,`BASE_AMOUNT`,`REVENUE_SHARE`) 
			                                  VALUES ('$actor','$id','$baseamounts[$i]','$revenues[$i]')";
			if (!$this->connect()) {
            die("Connection failed: " . mysqli_connect_error());
            }else{								  
			 $this->connect()->query($sqltoinsertactorrevenuepermovie);
			}
			$sqltoinsertcharacters="INSERT INTO MOVIE_CHARACTERS( `CHARACTER_NAME`,`ACTOR_ID`,`MOVIE_ID`) 
			                                  VALUES ('$characters[$i]','$actor','$id')";
			if (!$this->connect()) {
            die("Connection failed: " . mysqli_connect_error());
            }else{
			$this->connect()->query($sqltoinsertcharacters);
		    }
			}
			for($i=0; $i < 4; $i ++){
		        $actor_name = $actors[$i];
				$character_name= $characters[$i];
				$base_amount =$baseamounts[$i];
				$revenue= $revenues[$i];
				echo "<tr>";
				echo "<th>$movie_name</th>";
				echo "<th>$actor_name</th>";
				echo "<th>$character_name</th>";
				echo "<th>$base_amount</th>";
				echo "<th>$revenue</th>";
				echo "</tr>";
			}
	        }
            //echo("<script>alert('All enteries were added successfully!')</script>");
            //echo("<script>window.location = 'addcharactertomovie.php';</script>");
		}
   }
?>