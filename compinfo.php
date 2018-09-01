	<?php 
		session_start(); 
		$db = new mysqli('localhost', 'root', '', 'ftcapp');

	 	if($db->connect_errno) { 
	 		die('Sorry we having some connection problems');
	 	} 
		$records = array();

	 	$teamrecords = array(); 
    
		    $selected_val = $_SESSION['conference'];  // Storing Selected Value In Variable


		$matchtable = strtolower(str_replace(' ', '',$_SESSION['conference']) . str_replace(' ', '',$_SESSION['delegation']) . "matches");
        $teaminfotable = strtolower(str_replace(' ', '',$_SESSION['conference']) . str_replace(' ', '',$_SESSION['delegation']) . "teaminfo");

        if($results = $db->query("SELECT * FROM ".$matchtable."")) {
			if($results->num_rows) {
				while($row = $results->fetch_object()) { 
					$records[] = $row; 
				}
				$results->free(); 
			}
		}

          if($results3 = $db->query("SELECT * FROM ".$teaminfotable."")) {
			if($results3->num_rows) {
				while($row2 = $results3->fetch_object()) { 
					$teamrecords[] = $row2; 
				}
				$results3->free(); 
			}
		}
           $query = "SELECT id FROM ".$matchtable."";

            $result2 = mysqli_query($db, $query);

        $options = "";

        while($row2 = mysqli_fetch_array($result2))
        {
            $options = $options."<option>$row2[0]</option>";
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
		<div class = "container">
            <div class= "card-panel">
			<h3>Scouted Teams</h3>
					<?php
						if(!count($teamrecords)) {

							echo 'no teams added so far'; 
							} else {  
					?>
					<table> 
						<thead><tr> 
							<th>Team Name</th>
							<th>Team Number</th>
							<th>Team Info</th>
						
							</tr>
							</thead>
						<tbody>
						<?php
							foreach($teamrecords as $r){
							?>
							<tr>
								<td><?php echo $r->Name; ?></td>
								<td><?php echo $r->Number; ?></td>
								<td><?php echo $r->Info; ?></td>
							

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
            <div class ="card-panel">
			<h3>Matches</h3>
					<?php
						if(!count($records)) {

							echo 'no delegates found'; 
							} else {  
					?>
					<table> 
						<thead><tr> 
							<th>Match Number</th>
							<th>Red Team 1</th>
							<th>Red Team 2</th>
							<th>Blue Team 1</th>
							<th>Blue Team 2</th>
                            <th>Auto Red Points</th>
							<th>Auto Blue Points</th>
							<th>TeleOp Red Points</th>
							<th>TeleOp Blue Points</th>
							</tr>
							</thead>
						<tbody>
						<?php
							foreach($records as $r){
							?>
							<tr>
								<td><?php echo $r->id; ?></td>
								<td class = "red-text"><?php echo $r->RedTeam1; ?></td>
								<td class = "red-text"><?php echo $r->RedTeam2; ?></td>
								<td class = "blue-text"><?php echo $r->BlueTeam1; ?></td>
								<td class = "blue-text"><?php echo $r->BlueTeam2; ?></td>
								<td class = "red-text"><?php echo $r->AutoRedPoints; ?></td>
								<td class = "blue-text"><?php echo $r->AutoBluePoints; ?></td>
								<td class = "red-text"><?php echo $r->TeleOpRedPoints; ?></td>
								<td class = "blue-text"><?php echo $r->TeleOpBluePoints; ?></td>

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
            </div>
	</body>
	</html>
