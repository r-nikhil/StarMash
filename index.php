<?php

  // Performance  = [(Total of opponents' ratings + 400 * (Wins - Losses)) / score].

include('mysql_connect.php');
include('functions.php');

// Get random 2

$query="SELECT * FROM images ORDER BY RAND() LIMIT 0,2";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_object($result)) {
 $images[] = (object) $row;
}

// now we have the 2 images in consideration as an array object

// Get the top10
$query="SELECT * , ROUND(score/(1+(losses/wins))) AS performance FROM images ORDER BY ROUND(score/(1+(losses/wins))) DESC LIMIT 0,5";
$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_object($result)) {
  $top_ratings[] = (object) $row;
  }
// var_dump($top_ratings);
// this is used to check whether the query works.
// Close the connection
 // var_dump($top_ratings[9]);
mysqli_close($conn);
?>

<html>
<head>
<title>StarMash</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>StarMash</h1>
<h3>Click on the image to choose the hot one.</h3>
<center>
<table>
 <tr>
<td valign="top" class="image"><a href="rate.php?winner=<?=$images[0]->image_id?>&loser=<?=$images[1]->image_id?>"><img src="http://localhost/face/images/<?=$images[0]->filename?>" /></a></td>

<td valign="top" class="image"><a href="rate.php?winner=<?=$images[1]->image_id?>&loser=<?=$images[0]->image_id?>"><img src="http://localhost/face/images/<?=$images[1]->filename?>" /></a></td>
 </tr>
 <tr>
  <td>Won: <?=$images[0]->wins?>, Lost: <?=$images[0]->losses?></td>
  <td>Won: <?=$images[1]->wins?>, Lost: <?=$images[1]->losses?></td>
 </tr>
 <tr>
  <td>Score: <?=$images[0]->score?></td>
  <td>Score: <?=$images[1]->score?></td>
 </tr>
 <tr>
  <td>P(Win this Mash): <?=round(expected($images[1]->score, $images[0]->score), 4)?></td>
  <td>P(Win this Mash): <?=round(expected($images[0]->score, $images[1]->score), 4)?></td>
 </tr>
</table>
</center>
<h2>Top Rated</h2>
<center>
<table>

  		<?php
        $image0=$top_ratings[0];
        $image1=$top_ratings[1];
        $image2=$top_ratings[2];
        $image3=$top_ratings[3];
        $image4=$top_ratings[4];

        ?>
        <tr>
  		<td valign="top"><img src="images/<?=$image0->filename?>" width="70" /></td>
      <td valign="top"><img src="images/<?=$image1->filename?>" width="70" /></td>
      <td valign="top"><img src="images/<?=$image2->filename?>" width="70" /></td>
      <td valign="top"><img src="images/<?=$image3->filename?>" width="70" /></td>
      <td valign="top"><img src="images/<?=$image4->filename?>" width="70" /></td>
    	</tr>

  	 <tr>
  		<td valign="top">Score: <?=$image0->score?></td>
      <td valign="top">Score: <?=$image1->score?></td>
      <td valign="top">Score: <?=$image2->score?></td>
      <td valign="top">Score: <?=$image3->score?></td>
      <td valign="top">Score: <?=$image4->score?></td>



<!--
  	</tr>
  	 	<td valign="top">Performance: <?=$image0->performance?></td>
       <td valign="top">Performance: <?=$image1->performance?></td>
       <td valign="top">Performance: <?=$image2->performance?></td>
       <td valign="top">Performance: <?=$image3->performance?></td>
       <td valign="top">Performance: <?=$image4->performance?></td>

  	 	<tr> -->
<tr>
  		<td valign="top">Won: <?=$image0->wins?></td>
      <td valign="top">Won: <?=$image1->wins?></td>
      <td valign="top">Won: <?=$image2->wins?></td>
      <td valign="top">Won: <?=$image3->wins?></td>
      <td valign="top">Won: <?=$image4->wins?></td>
  	</tr>

  	<tr>
  		<td valign="top">Lost: <?=$image0->losses?></td>
      <td valign="top">Lost: <?=$image1->losses?></td>
      <td valign="top">Lost: <?=$image2->losses?></td>
      <td valign="top">Lost: <?=$image3->losses?></td>
      <td valign="top">Lost: <?=$image4->losses?></td>

  	</tr>


</table>
</center>

<?php
require_once 'footer.php';
?>

</body>
</html>
