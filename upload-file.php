<?php
$uploaddir = $_GET['dir'].$_GET['cId']; // print_r($uploaddir); die;
if(!is_dir($uploaddir)){ mkdir($uploaddir,0755,TRUE); } 
$ext = pathinfo($_FILES['media']['name'], PATHINFO_EXTENSION);
$fileName   =   time().'.'.$ext;
$file = $uploaddir.'/' . basename($fileName); 
 
if (move_uploaded_file($_FILES['media']['tmp_name'], $file)) { 
    $resp = array('status'=>'success','file'=>$fileName); echo json_encode($resp); 
} else { echo json_encode(array('status'=>'error')); }
?>