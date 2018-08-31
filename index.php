<?php
	//error_reporting(0);
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
	if($results = $db->query("SELECT * FROM teams")) {
		if($results->num_rows) {
			while($row = $results->fetch_object()) { 
				$records[] = $row; 
			}
			$results->free(); 
		}
	}


 	$query = "SELECT Number FROM `teams`";

 	$result2 = mysqli_query($db, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[0]</option>";
}

if(isset($_POST['submitconference'])) {
    unset($_SESSION['conference']);
    $_SESSION['conference'] = str_replace(' ', '',$_POST['teamNumber']);  
     header('Location: competition.php');    
}
$conference = $_SESSION['conference'];
echo $conference; 
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title> </title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> </head>
            <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <body class="grey lighten-4">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
      
     <div class = "container">  <h1>Teams</h1>
            <?php
			if(!count($records)) {

				echo 'no conferences found'; 
				} else {  
		?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Number</th>
                            <th>School</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
				foreach($records as $r){
				?>
                            <tr>
                                <td>
                                    <?php echo $r->Name; ?>
                                </td>
                                <td>
                                    <?php echo $r->Number; ?>
                                </td>
                                <td>
                                    <?php echo $r->School; ?>
                                </td>
                               
                            </tr>
                            <?php
			}
				?>
                    </tbody>
                </table>
                <?php 
					} 
				?>
                    <hr>
                    <h3>Enter a new teams to be shared with everybody! </h3>
                    <hr>
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
                            <input name="Password" id="Password"></input>
                        </div>
                            <input type="submit" class="blue lighten-2 btn waves-effect waves-light" value="Insert"> </div>
                    </form>
        
        <hr> 
        
        <h2>See details of the conference</h2>
        <form action = "" method = "post"> 
        
        <input name="teamNumber" id="teamNumber"></input>
        <input name="teamPassword" id="teamPassword"></input>
    
		<input type="submit" name="submitconference" value="Get Selected Values" />

		</form>
        </div>
            </div>

        </body> 
    </html>