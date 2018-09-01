<?php
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
    $matchtable = $selected_val . $nospacesdelegation . "teaminfo";
$matchtable = strtolower($matchtable);
    if(!empty($_POST)) {
                if(isset($_POST['Name'],$_POST['Number'],$_POST['Info'])) {
                        $Name = trim($_POST['Name']);
                        $Number = trim($_POST['Number']);
                        $Info = trim($_POST['Info']);
                        $check =  isset($_POST['mech1']) ? "Yes" : "No"; 
                        
                        $insert = $db->prepare("INSERT INTO ".$matchtable." (Name, Number, Info, Mechanism1) VALUES (?,?,?,?)");
                        $insert->bind_param('ssss', $Name, $Number, $Info, $check);
                        
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
                    <a href="competition.php" class="center brand-logo">
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
                            <label for "Name">Name</label>
                            <input type="text" name="Name" id="Name" autocomplete="off"> </div>
                            <div class="field">
                                <label for "Number">Number</label>
                                <input type="text" name="Number" id="Number" autocomplete="off">  </div>
                                <div class="field">
                                    <label for "Name">Info</label>
                                    <input type="text" name="Info" id="Info" autocomplete="off">  </div>
                                <div>
                                      <input name = "mech1" type="checkbox" id="mech1">
                                      <label for="mech1">Mechanism 1</label>
                                 </div>
                                    <input type="submit" class="blue lighten-2 btn waves-effect waves-light" name="submit" value="Add Your Team"> </form>
    
                                </div>
                            </div>
                        </body>
                    </html>