<?php session_start();
$conn = new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
if($conn->connect_error)
    die("Failed to connect: ".$conn->connect_error);
?>
<!DOCTYPE html>
<html>
    <head>
        <style><?php include 'style/style.css'?></style>
    </head>
    <body>
        <div id="logged_user">
            <p>Logged in as <?php echo $_SESSION['Name']?> | 
            <a href="../index.php">Log Out</a></p>
        </div>
        <div>
            <?php
            if(isset($_POST["exeReq"])){
                echo "<meta http-equiv='refresh' content='0'>";
            }
            $sql="SELECT Email, Approved FROM best_gamification.requests";
            $result=$conn->query($sql);
            if($result){
                echo 
                '
                <form method="post" action="requestsHistory.php">
                ';
                $i=0;
                while($row=$result->fetch_assoc()){
                    if($row["Approved"]=="NO"){
                        $aprobare[$i]="aprobare".$i;
                        $email[$i]=$row["Email"];
                        echo
                        '
                            '.$row["Email"].' --> 
                            Aprobare: Da <input type="radio" name="'.$aprobare[$i].'" value="YES">
                                      Nu <input type="radio" name="'.$aprobare[$i++].'" value="NO"><br>
                        ';
                    }
                }
                echo 
                '
                    <input name="exeReq" type="submit" value="Executa!">
                </form>
                ';
                for($j=0;$j<$i;$j++){
                    if(!empty($_POST[$aprobare[$j]])){
                        if($_POST[$aprobare[$j]]=="YES"){
                            $sql="UPDATE best_gamification.requests SET Approved='YES' WHERE Email='$email[$j]'";
                            if(!$result=$conn->query($sql))
                                die("Failed to query: ".$conn->error);
                        }
                        else{
                            $sql="DELETE FROM best_gamification.requests WHERE Email='$email[$j]'";
                            if(!$result=$conn->query($sql))
                                die("Failed to query: ".$conn->error);
                        }
                    }
                }
            }
            ?>
        </div>
        <form method="post" action="page1.php">
            <input type="submit" value="Back">
        </form>
    </body>
</html>
