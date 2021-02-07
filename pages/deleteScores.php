<?php
session_start();
$conn=new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
if($conn->connect_error)
	die("Failed to connect :".$conn->connect_error);
$sql="DELETE FROM best_gamification.scores_admin";
if(!$conn->query($sql)==true)
	die("Failed to connect :".$conn->error);
$sql="DELETE FROM best_gamification.scores_user";
if(!$conn->query($sql)==true)
	die("Failed to connect :".$conn->error);
header("Location: scoresHistory.php");
?>
