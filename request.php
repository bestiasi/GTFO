<?php session_start();
$conn = new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
if($conn->connect_error)
    die("Failed to connect: ".$conn->connect_error);
$email=$_POST['email'];
if(strchr($email,"@")!="@bestis.ro"){
    header("Location: index.php?err=1");
    die();
}
$sql="SELECT MAX(id) FROM best_gamification.requests";
if(!($result=$conn->query($sql)))
    die("Failed to connect: ".$conn->error);
else{
    $row=$result->fetch_array();
    if(!$row[0])
        $id=1;
    else
        $id=$row[0]+1;
}
$sql="SELECT Email FROM best_gamification.requests";
$result=$conn->query($sql);
if($result){
    while($row=$result->fetch_assoc()){
        if($email==$row["Email"]){
            header("Location: index.php?err=2");
            die();
        }
    }
}
$sql="INSERT INTO best_gamification.requests(id,Email, Approved) VALUES('$id','$email','NO')";
if($conn->query($sql)==true){
    header("Location: index.php");
    die();
}
else
    die("Failed query :".$conn->error);
?>
