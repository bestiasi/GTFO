<?php session_start();
if(empty($_SESSION['login'])){
    header("Location: ../index.php");
    die();
}
$username=$_SESSION['username'];
$conn = new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
if($conn->connect_error)
    die("Failed to connect: ".$conn->connect_error);
$sql="SELECT Rol FROM best_gamification.users WHERE username='$username'";
$result=$conn->query($sql);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $_SESSION['Rol']=$row["Rol"];
}
$sql="SELECT Nume FROM best_gamification.users WHERE username='$username'";
$result=$conn->query($sql);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $_SESSION['Name']=$row['Nume'];
}
include 'functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            <?php include 'style/style.css'?>
        </style>
        <script src="js/scripts.js"></script>
    </head>
    <body>
        <?php
        
        $name=$result->fetch_assoc();
        echo
            '<div id="logged_user">
                <p>Logged in as '.$_SESSION['Name'].' | <a href="../index.php">Log Out</a></p>
            </div>';
        ?>
        <div id="interface">
            <div id="dashboard">
                <?php
                    $members[]="";
                    $sql="SELECT id FROM best_gamification.members";
                    $result=$conn->query($sql);
                    $nRows=mysqli_num_rows($result);
                ?>
                <div id="description">
                    <div id="des_content"><p>Titlu Leut</p></div>
                    <div id="des_content"><p>Scor</p></div>
                    <div id="des_content"><p>Membri</p></div>
                </div>
                <div id="participant">
                    <div id="part_cont">FOSSIL LION</div>
                    <div id="part_cont">1250+</div>
                    <div id="part_cont">
                    <?php
                    
                    for($i=1;$i<=$nRows;$i++){
                        $sql="SELECT Score, Nume FROM best_gamification.members WHERE id='$i'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            $row=$result->fetch_assoc();
                            $score=$row["Score"];
                            if($score>1250)
                                echo $row["Nume"].' ';
                        }
                    }
                    ?>
                    </div>
                </div>
                <div id="participant">
                    <div id="part_cont">MAMA LION</div>
                    <div id="part_cont">851 - 1250</div>
                    <div id="part_cont">
                    <?php
                    
                    for($i=1;$i<=$nRows;$i++){
                        $sql="SELECT Score, Nume, Gender FROM best_gamification.members WHERE id='$i'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            $row=$result->fetch_assoc();
                            $score=$row["Score"];
                            $gender=$row["Gender"];
                            if($score>=851 && $score<=1250 && $gender=="female")
                                echo $row["Nume"].' ';
                        }
                    }
                    ?>
                    </div>
                </div>
                <div id="participant">
                    <div id="part_cont">PAPA LION</div>
                    <div id="part_cont">851 - 1250</div>
                    <div id="part_cont">
                    <?php
                    
                    for($i=1;$i<=$nRows;$i++){
                        $sql="SELECT Score, Nume, Gender FROM best_gamification.members WHERE id='$i'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            $row=$result->fetch_assoc();
                            $score=$row["Score"];
                            $gender=$row["Gender"];
                            if($score>=851 && $score<=1250 && $gender=="male")
                                echo $row["Nume"].' ';
                        }
                    }
                    ?>
                    </div>
                </div>
                <div id="participant">
                    <div id="part_cont">YOUNG LION</div>
                    <div id="part_cont">551 - 850</div>
                    <div id="part_cont">
                    <?php
                    
                    for($i=1;$i<=$nRows;$i++){
                        $sql="SELECT Score, Nume FROM best_gamification.members WHERE id='$i'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            $row=$result->fetch_assoc();
                            $score=$row["Score"];
                            if($score>=551 && $score<=850)
                                echo $row["Nume"].' ';
                        }
                    }
                    ?>
                    </div>
                </div>
                <div id="participant">
                    <div id="part_cont">TEEN LION</div>
                    <div id="part_cont">251 - 550</div>
                    <div id="part_cont">
                    <?php
                    
                    for($i=1;$i<=$nRows;$i++){
                        $sql="SELECT Score, Nume FROM best_gamification.members WHERE id='$i'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            $row=$result->fetch_assoc();
                            $score=$row["Score"];
                            if($score>=251 && $score<=550)
                                echo $row["Nume"].' ';
                        }
                    }
                    ?>
                    </div>
                </div>
                <div id="participant">
                    <div id="part_cont">BABY LION</div>
                    <div id="part_cont">0 - 250</div>
                    <div id="part_cont">
                    <?php
                    
                    for($i=1;$i<=$nRows;$i++){
                        $sql="SELECT Score, Nume FROM best_gamification.members WHERE id='$i'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            $row=$result->fetch_assoc();
                            $score=$row["Score"];
                            if($score>=0 && $score<=250)
                                echo $row["Nume"].' ';
                        }
                    }
                    ?>
                    </div>
                </div>
            </div>
            <div id="rules">
                <div id=rules_row>
                    <div id="rules_column">
                        <p>Categorie</p>
                    </div>
                    <div id="rules_column">
                        <p>Denumire task</p>
                    </div>
                    <div id="rules_column">
                        <p>Puncte per task</p>
                    </div>
                </div>
                <div id="rules_row">
                    <div id="rules_column">
                        <p>Departament</p>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Name FROM best_gamification.department";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Name"].'</p>';
                        }
                        ?>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Score FROM best_gamification.department";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Score"].'</p>';
                        }
                        ?>
                    </div>
                </div>
                <div id="rules_row">
                    <div id="rules_column">
                        <p>Echipe de FR</p>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Name FROM best_gamification.frteams";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Name"].'</p>';
                        }
                        ?>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Score FROM best_gamification.frteams";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Score"].'</p>';
                        }
                        ?>
                    </div>
                </div>
                <div id="rules_row">
                    <div id="rules_column">
                        <p>Extern</p>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Name FROM best_gamification.extern";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Name"].'</p>';
                        }
                        ?>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Score FROM best_gamification.extern";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Score"].'</p>';
                        }
                        ?>
                    </div>
                </div>
                <div id="rules_row">
                    <div id="rules_column">
                        <p>Granturi</p>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Name FROM best_gamification.grants";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Name"].'</p>';
                        }
                        ?>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Score FROM best_gamification.grants";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Score"].'</p>';
                        }
                        ?>
                    </div>
                </div>
                <div id="rules_row">
                    <div id="rules_column">
                        <p>International</p>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Name FROM best_gamification.international";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Name"].'</p>';
                        }
                        ?>
                    </div>
                    <div id="rules_column">
                        <?php
                        $sql="SELECT Score FROM best_gamification.international";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc())
                                echo '<p>'.$row["Score"].'</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <p>Adaugare scor:</p>
        <form method="post" action="updateScore.php">
            <?php
            
            if($_SESSION['Rol']=="Admin"){
                echo 
                    '<select name="members" onchange="showTables(this.value)">
                        <option value="0">Selectare persoana</option>';
                $sql="SELECT Nume FROM best_gamification.members";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    $counter=1;
                    while($row=$result->fetch_array()){
                        echo 
                            '<option value="'.$counter++.'">'.$row[0].'</option>';
                    }
                }
                echo '</select>';
            }
            else{
                $sql='SELECT id FROM best_gamification.members WHERE Nume="'.$_SESSION["Name"].'"';
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    $row=$result->fetch_assoc();
                    $id=$row["id"];
                    echo 
                        '<script>showTables("'.$id.'")</script>';
                }
            }
            ?>
            <div id="tablesHint"></div>
            <div id="tasksHint"></div>
            <div id="buttonHint"></div>
        </form>
        <?php
        if($_SESSION['Rol']=="Admin"){
            echo 
                '<form method="post" action="resetScore.php">
                    <input type="submit" value="Reset Score">
                </form>';
            echo 
                '<form method="post" action="requestsHistory.php">
                    <input type="submit" value="Istoric Request-uri">
                </form>
                ';
            echo 
                '<form method="post" action="scoresHistory.php">
                    <input type="submit" value="Istoric Scoruri">
                </form>';
        }
        ?>
    </body>
</html>
