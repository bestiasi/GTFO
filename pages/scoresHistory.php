<?php session_start();
$conn=new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
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
        <div id="scores_box">
            <div id="scores_list">
                <h3>Admin added score</h3>
                <?php
                $sql="SELECT id, Date1, Date2, Member, Task, Score, Action FROM best_gamification.scores_admin";
                if($result=$conn->query($sql)){
                    while($row=$result->fetch_assoc()){
                        echo $row["id"].". ".$row["Date1"]." ".$row["Date2"]." ".$row["Member"]." ".$row["Task"]." ".$row["Score"]." ".$row["Action"]."<br>";
                    }
                }
                ?>
            </div>
            <div id="scores_list">
                <h3>User added score</h3>
                <?php
                $sql="SELECT id, Date1, Date2, Member, Task, Score, Action FROM best_gamification.scores_user";
                if($result=$conn->query($sql)){
                    while($row=$result->fetch_assoc()){
                        echo $row["id"].". ".$row["Date1"]." ".$row["Date2"]." ".$row["Member"]." ".$row["Task"]." ".$row["Score"]." ".$row["Action"]."<br>";
                    }
                }
                ?>
            </div>
        </div>
        <form method="post" action="deleteScores.php">
            <input type="submit" value="Delete history">
        </form>
        <form method="post" action="page1.php">
            <input type="submit" value="Back">
        </form>
    </body>
</html>
