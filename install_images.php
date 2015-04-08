<?php
include('mysql_connect.php');

if ($handle = opendir('images')) {

 while (false !== ($file = readdir($handle)))
 {
  if($file!='.' && $file!='..') {
   $images[] = "('".$file."')";
  }
 }
 closedir($handle);
}


$query = "INSERT INTO images (filename) VALUES ".implode(',', $images)." ";
if (!mysqli_query($conn, $query)) {
 print mysql_error();
}
else {
 print "finished installing your images!";
}

?>
