<?php
	//error_reporting(0);
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


$password = $db->query("SELECT * FROM teams WHERE Number=7890"); 


if(isset($_POST['submitconference'])) {
    unset($_SESSION['conference']);
    $_SESSION['conference'] = str_replace(' ', '',$_POST['teamNumber']);  
     header('Location: competition.php');    
}
$conference = $_SESSION['conference'];

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