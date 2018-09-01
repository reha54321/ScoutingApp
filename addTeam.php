<?php
session_start(); 
	require 'db/connect.php';
$records = array();
	if(!empty($_POST)) {
		if(isset($_POST['Name'],$_POST['School'],$_POST['Password'],$_POST['Number'])) {

				$Name = trim($_POST['Name']); 
				$School = trim($_POST['School']); 
				$Password = trim($_POST['Password']); 
				$Number = trim($_POST['Number']); 


				
				$insert = $db->prepare("INSERT INTO teams (Name, Number, Password, School) VALUES (?,?,?,?)");
				$insert->bind_param('ssss', $Name, $Number, $Password, $School);
				$teamDatabaseName = $Number . "competitions"; 
                $teamDatabaseName  = str_replace(' ', '', $teamDatabaseName);
				$sql = "CREATE TABLE ".$teamDatabaseName." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				name TEXT,
				host TEXT
				)";
				if ($db->query($sql) === TRUE) {
				    echo "Table MyGuests created successfully";
				} else {
				    echo "Error creating table: " . $db->error;
				}
					if($insert->execute()) {

						header('Location:index.php'); 
						die(); 
					}
			
			}

	}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Add A Team!</title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> </head>
            <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <body class="grey lighten-4">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        
        <nav>
    <div class="nav-wrapper blue lighten-2">
      <a href="index.php" class="brand-logo center">FTC Scouting App</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php">Other Teams</a></li>

      </ul>
    </div>
  </nav>
        <div class ="container"> 
            <div class ="card-panel">
         <h3>Enter you team's details </h3>
                <p>A password will be needed to enter your team's dashboard, please share it with your teammates</p>
                    <form action="" method="post">
                        <div class="field">
                            <label for "Name">Team Name</label>
                            <input type="text" name="Name" id="Name" autocomplete="off"> </div>
                        <div class="field">
                            <label for "School">Team School</label>
                            <input type="text" name="School" id="School" autocomplete="off"> </div>
                        
                         <div class="field">
                            <label for "Number">Team Number</label>
                            <input type="text" name="Number" id="Number" autocomplete="off"> </div>
                        <div class="field">
                            <label for "Password">Team Password</label>
                            <input type="password" name="Password" id="Password" class="validate"></input>
                        </div>
                            <input type="submit" class="blue lighten-2 btn waves-effect waves-light" value="Add Your Team"> </div>
                    </form>
        </div> 
        </div>
        </body>