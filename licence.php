<?php

$dbhost = "localhost"; $dbuser = "estrrado_swim"; $dbpass = "swim@321#"; $db = "estrrado_swim";
$db = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
$query  =   $db->query("SELECT * FROM `sw_licences` WHERE `domain` = '".$_POST['domain']."' AND `licence_key` = '".$_POST['licence']."'");
if($query->num_rows    >   0){ echo 'success'; }else{ echo 'error'; }
//  print_r($_POST);