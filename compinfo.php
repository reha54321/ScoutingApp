	<?php 
		session_start(); 
		$db = new mysqli('localhost', 'root', '', 'ftcapp');

	 	if($db->connect_errno) { 
	 		die('Sorry we having some connection problems');
	 	} 
		$records = array();

	 	
    
		

		$matchtable = strtolower(str_replace(' ', '',$_SESSION['conference']) . str_replace(' ', '',$_SESSION['delegation']) . "matches");
        echo $matchtable;
		if($results = $db->query("SELECT * FROM ".$matchtable."")) {
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
		<title></title>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> </head>
            <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <body class="grey lighten-4">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
      
		
			<h3>Delegates</h3>
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
								<td><?php echo $r->RedTeam1; ?></td>
								<td><?php echo $r->RedTeam2; ?></td>
								<td><?php echo $r->BlueTeam1; ?></td>
								<td><?php echo $r->BlueTeam2; ?></td>
								<td><?php echo $r->AutoRedPoints; ?></td>
								<td><?php echo $r->AutoBluePoints; ?></td>
								<td><?php echo $r->TeleOpRedPoints; ?></td>
								<td><?php echo $r->TeleOpBluePoints; ?></td>

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



	</body>
	</html>
