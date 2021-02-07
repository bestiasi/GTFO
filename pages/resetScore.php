<?php
session_start();
$conn = new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
if($conn->connect_error)
    die("Failed to connect: ".$conn->connect_error);
$sql="UPDATE best_gamification.members SET Score=0,Departament=0,Extern=0,EchipeFR=0,Granturi=0,International=0, Title='BABY LION'";
$result=$conn->query($sql);
if(!$conn->query($sql)){
    echo "Failed to query!";
    die();
}
header("Location: page1.php");
die();
?>
