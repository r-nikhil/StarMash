<?php

include('mysql_connect.php');
include('functions.php');

// If rating - update the database
if ($_GET['winner'] && $_GET['loser']) {

 // Get the winner
 $result = mysqli_query($conn,"SELECT * FROM images WHERE image_id = ".$_GET['winner']." ");
 $winner = mysqli_fetch_object($result);

 // Get the loser
 $result = mysqli_query($conn,"SELECT * FROM images WHERE image_id = ".$_GET['loser']." ");
 $loser = mysqli_fetch_object($result);

 // Update the winner score
 // make this into a function
 $winner_expected = expected($loser->score, $winner->score);
 $winner_new_score = win($winner->score, $winner_expected);
 mysqli_query($conn,"UPDATE images SET score = ".$winner_new_score.", wins = wins+1 WHERE image_id = ".$_GET['winner']);

 // Update the loser score
 $loser_expected = expected($winner->score, $loser->score);
 $loser_new_score = loss($loser->score, $loser_expected);
 mysqli_query($conn,"UPDATE images SET score = ".$loser_new_score.", losses = losses+1  WHERE image_id = ".$_GET['loser']);

 // Insert battle
 mysqli_query($conn,"INSERT INTO battles SET winner = ".$_GET['winner'].", loser = ".$_GET['loser']." ");

 // Back to the frontpage
 header('location: index.php');

}

?>
