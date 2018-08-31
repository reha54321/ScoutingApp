<?php
 	$db = new mysqli('localhost', 'root', '', 'ftcapp');

 	if($db->connect_errno) { 
 		die('Sorry we having some connection problems');
 	} 
 ?> 