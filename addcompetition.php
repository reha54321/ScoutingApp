<?php 
        session_start(); 
			error_reporting(0);
			$db = new mysqli('localhost', 'root', '', 'ftcapp');
		 	if($db->connect_errno) { 
		 		die('Sorry we having some connection problems');
		 	} 
			$records = array();

		 	$query = "SELECT Number FROM `teams`";

		 	$result2 = mysqli_query($db, $query);

		$options = "";

		while($row2 = mysqli_fetch_array($result2))
		{
		    $options = $options."<option>$row2[0]</option>";
		}

		if(isset($_POST['submit'])){
					$selected_val = $_SESSION['conference'];  // Storing Selected Value In Variable
				echo "You have selected :" .$selected_val;
                $selected_val = str_replace(' ', '', $selected_val);
// Displaying Selected Value
				}
	$competitiontable = $selected_val . "competitions";
			if(!empty($_POST)) {

				if(isset($_POST['Name'],$_POST['Host'])) {

				$Name = trim($_POST['Name']); 
				$Host = trim($_POST['Host']); 
				$nospacesname  = str_replace(' ', '', $Name);

				$individualmatchestable = $selected_val . $nospacesname . "matches"; 
                $teaminfotable = $selected_val . $nospacesname . "teaminfo"; 
                echo $teaminfotable; 
                $insert = $db->prepare("INSERT INTO ".$competitiontable." (name, host) VALUES (?,?)");
				$insert->bind_param('ss', $Name, $Host);
                    //Change this for matches
				$sql = "CREATE TABLE ".$individualmatchestable." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				RedTeam1 TEXT,
				RedTeam2 TEXT,
				BlueTeam1 TEXT,
				BlueTeam2 TEXT,
                AutoRedPoints INT(6),
                AutoBluePoints INT(6),
                TeleOpRedPoints INT(6),
                TeleOpBluePoints INT(6)
				)";
                $sql2 = "CREATE TABLE ".$teaminfotable." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				Name TEXT,
				Number TEXT,
				Info TEXT
				)";
				if ($db->query($sql) === TRUE) {
				    echo "Matches created successfully";
				} else {
				    echo "Error creating table: " . $db->error;
				}
				if ($db->query($sql2) === TRUE) {
				    echo "Team Infos created successfully";
				} else {
				    echo "Error creating table: " . $db->error;
				}
				
				
					if($insert->execute()) {
                echo $individualteamsinfotable; 

					header('Location:competition.php'); 
						die(); 
					}
			
			}

	}
		?>
    <!DOCTYPE html>
    <html>

    <head>
        <title></title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> </head>
            <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <body class="grey lighten-4">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
          <nav>
            <div class="blue lighten-2 nav-wrapper">
                <a href="delegates.php" class="brand-logo">
                    <?php echo $_SESSION['conference']; ?>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="delegates.php"> <?php echo 'Go back to the ' .$_SESSION['conference']. 'page'; ?></a></li>
                    <li><a href="index.php">Other conferences</a></li>
                   
            </div>
        </nav>
          <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <form action="" method="post">
          
            <div class="field">
                <label for "Name"> Name</label>
                <input type="text" name="Name" id="Name" autocomplete="off"> </div>
            <div class="field">
                <label for "Host">Host</label>
                <input type="text" name="Host" id="Host" autocomplete="off"> </div>
          
            <input type="submit" name="submit" value="Insert"> </form> <a href="competition.php">Want to see the other delegations!</a>
        <br> <a href="index.php">Want to see conference details!</a>
        <br> <a href="delegate.php">Want to see the individual delegates!</a> </body>

    </html>