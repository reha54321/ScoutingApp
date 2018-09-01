<?php 
    error_reporting(0); 
	session_start();

	$selected_val= $_SESSION['conference']; 
	$selected_delegation = $_SESSION['delegation']; 

	$db = new mysqli('localhost', 'root', '', 'ftcapp');

	 	if($db->connect_errno) { 
	 		die('Sorry we having some connection problems');
	 	} 
		$records = array();

	$nospacesdelegation  = str_replace(' ', '', $selected_delegation);
    $selected_val = str_replace(' ', '', $selected_val);
	$matchtable = $selected_val . $nospacesdelegation . "matches";
    $matchtable = strtolower($matchtable);
	if(!empty($_POST)) {
				if(isset($_POST['RedTeam1'],$_POST['RedTeam2'],$_POST['BlueTeam1'],$_POST['BlueTeam2'],$_POST['AutoRedPoints'],$_POST['AutoBluePoints'],$_POST['TeleOpRedPoints'],$_POST['TeleOpBluePoints'])) {

						$RedTeam1 = trim($_POST['RedTeam1']); 
						$RedTeam2 = trim($_POST['RedTeam2']); 
						$BlueTeam1 = trim($_POST['BlueTeam1']); 
						$BlueTeam2 = trim($_POST['BlueTeam2']);
                    	$AutoRedPoints = trim($_POST['AutoRedPoints']); 
						$AutoBluePoints = trim($_POST['AutoBluePoints']); 
						$TeleOpRedPoints = trim($_POST['TeleOpRedPoints']); 
						$TeleOpBluePoints = trim($_POST['TeleOpBluePoints']); 
						
						$insert = $db->prepare("INSERT INTO ".$matchtable." (RedTeam1, RedTeam2, BlueTeam1, BlueTeam2, AutoRedPoints, AutoBluePoints, TeleOpRedPoints, TeleOpBluePoints) VALUES (?,?,?,?,?,?,?,?)");
						$insert->bind_param('ssssssss', $RedTeam1, $RedTeam2, $BlueTeam1, $BlueTeam2, $AutoRedPoints, $AutoBluePoints, $TeleOpRedPoints, $TeleOpBluePoints);
						
							if($insert->execute()) {

								header('Location:compinfo.php'); 
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

    <body class="grey lighten-4">
          <nav>
            <div class="blue lighten-2 nav-wrapper">
                <a href="delegates.php" class="center brand-logo">
                    <?php echo $selected_val; ?>
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="addmatch.php">Add a new match</a></li>
                    <li><a href="addTeamInfo.php">Add a new team</a></li>
                    <li><a href="competition.php">Team Dashboard</a></li>
                    <li><a href="index.php">Other teams</a></li>
                </ul>
            </div>
        </nav>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <div class = "container">
             <div class = "card-panel">
        <form action="" method="post">
            <div class="field">
                <label for "Name">Team Red 1 Name</label>
                <input type="text" name="RedTeam1" id="RedTeam1" autocomplete="off"> </div>
             <div class="field">
                <label for "Name">Team Red 2 Name</label>
                <input type="text" name="RedTeam2" id="RedTeam2" autocomplete="off"> </div>
             <div class="field">
                <label for "Name">Team Blue 1 Name</label>
                <input type="text" name="BlueTeam1" id="BlueTeam1" autocomplete="off"> </div>
             <div class="field">
                <label for "Name">Team Blue 2 Name</label>
                <input type="text" name="BlueTeam2" id="BlueTeam2" autocomplete="off"> </div>
              <div class="field">
                <label for "Name">Auto Red Points</label>
                <input type="text" name="AutoRedPoints" id="AutoRedPoints" autocomplete="off"> </div>
              <div class="field">
                <label for "Name">Auto Blue Points</label>
                <input type="text" name="AutoBluePoints" id="AutoBluePoints" autocomplete="off"> </div>
              <div class="field">
                <label for "Name">TeleOp Red Points</label>
                <input type="text" name="TeleOpRedPoints" id="TeleOpRedPoints" autocomplete="off"> </div>
              <div class="field">
                <label for "Name">TeleOp Blue Points</label>
                <input type="text" name="TeleOpBluePoints" id="TeleOpBluePoints" autocomplete="off"> </div>
            
            <input type="submit" class="blue lighten-2 btn waves-effect waves-light" name="submit" value="Add Your Match"> </form>
                 </div>
            </div>
    </body>

    </html>