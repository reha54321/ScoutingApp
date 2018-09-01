<?php
	error_reporting(0);
session_start(); 
	require 'db/connect.php';

	
	if($results = $db->query("SELECT * FROM teams")) {
		if($results->num_rows) {
			while($row = $results->fetch_object()) { 
				$records[] = $row; 
			}
			$results->free(); 
		}
	}


if(isset($_POST['submitconference'])) {
    
    $number = $_POST['teamNumber']; 
    $sql = "SELECT Password FROM teams WHERE Number='$number' limit 1";
    $result = $db->query($sql);
    $value = mysqli_fetch_object($result);
    $Password = $value->Password;
    $submittedPassword = $_POST['teamPassword']; 
    if ($submittedPassword == $Password) {  
        unset($_SESSION['conference']);
        $_SESSION['conference'] = str_replace(' ', '',$_POST['teamNumber']);  
        header('Location: competition.php');
        
        }
    else { 
        echo "Incorrect PAssword"; 
    }
}
$conference = $_SESSION['conference'];

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>FTC Scouting App</title>
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
                <li><a href="addTeam.php">Add A Team</a></li>

      </ul>
    </div>
  </nav>
             
     <div class = "container">    <div class="card-panel" style="padding:20px"> <h1>Teams</h1>
            <?php
			if(!count($records)) {

				echo 'no teams found'; 
				} else {  
		?>
         
      
                <table style = "" class="responsive-table striped">
                    <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Team Number</th>
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
         </div> 

<div class="card-panel">
    <h2>Team Dashboard</h2>
         
    <p>Enter your team number and the team password. If you don't see your team, create it!</p>
    <form action="" method="post">
        <div class="field">
            <label for "teamNumber">Team Number</label>
            <input name="teamNumber" id="teamNumber"></input>
        </div>
        <div class="field">
            <label for "teamPassword">Password</label>
            <input name="teamPassword" id="teamPassword"></input>
        </div>
        <input type="submit" class="blue lighten-2 btn waves-effect waves-light" name="submitconference" value="Submit" /> </form>
    </div>
    </div>
</div> 
    </body>

    </html>