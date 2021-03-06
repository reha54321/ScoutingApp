<?php
session_start(); 
	error_reporting(0);
	$db = new mysqli('localhost', 'root', '', 'ftcapp');

 	if($db->connect_errno) { 
 		die('Sorry we having some connection problems');
 	} 
	$records = array();
    $selected_val = $_SESSION['conference'];  // Storing Selected Value In Variable
     // Displaying Selected Value
    $selected_val = str_replace(' ', '', $selected_val);
    $competitiondatabase = $selected_val . "competitions"; 
    $query = "SELECT name FROM ".$competitiondatabase."";

 	$result2 = mysqli_query($db, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[0]</option>";
}

if(isset($_POST['submit'])){
			unset($_SESSION['delegation']);
            $_SESSION['delegation'] = str_replace(' ', '',$_POST['delegation']);
            echo $_SESSION['delegation'];
        header('Location: compinfo.php');    

		}


$competitiontable = $selected_val . "competitions";
if($results = $db->query("SELECT * FROM ".$competitiontable."")) {
		if($results->num_rows) {
			while($row = $results->fetch_object()) { 
				$records[] = $row; 
			}
			$results->free(); 
		}
	}


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
        <nav>
            <div class="blue lighten-2 nav-wrapper">
                <a href="competition.php" class="center brand-logo">
                    <?php echo $selected_val; ?>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="addcompetition.php">Add a new competition</a></li>
                    <li><a href="index.php">Other teams</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class ="card-panel">
            <h3>Competitions</h3>
            <p>Add your competitions that your team is participating in!</p>
            <?php
					if(!count($records)) {

						echo 'no competitions found'; 
						} else {  
				?>
                <table class="responsive-table striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Host</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						foreach($records as $r){
						?>
                            <tr>
                                <td>
                                    <?php echo $r->name; ?>
                                </td>
                                <td>
                                    <?php echo $r->host; ?>
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
                 <div class = "card-panel">
                    <h4>Competitions</h4>
                    <h6>Select a competition to view the matches and team info saved for each competition</h6>
                    <form action="" method="post">
                        <select name="delegation" class="browser-default">
                            <?php echo $options;?>
                        </select>
                        <input type="submit" name="submit" class="blue lighten-2 btn waves-effect waves-light" value="Competition Dashboard" /> </form>
                    </div></div>
    </body>

    </html>