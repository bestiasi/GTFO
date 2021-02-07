<?php session_start();
$conn = new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
if($conn->connect_error)
    die("Failed to connect: ".$conn->connect_error);
else{
    if(!empty($_POST)){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $password=md5($password);
        
        $sql="SELECT username, Parola FROM best_gamification.users WHERE username='$username' AND Parola='$password'";
        $res=$conn->query($sql);
        
        if($res->num_rows>0){
            header("Location: pages/page1.php");
            $_SESSION['login']=1;
            $_SESSION['username']=$username;
            die();
        }
        else{
            header("Location: index.php?err=0");
            die();
        }
    }
}
$conn->close();
?>
