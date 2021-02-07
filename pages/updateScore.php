<?php
session_start();
date_default_timezone_set("Europe/Bucharest");
$conn = new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
if($conn->connect_error)
    die("Failed to connect: ".$conn->connect_error);
if(!empty($_POST)){
    if($_SESSION['Rol']=="Admin")
        $id_member=$_POST["members"];
    $id_category=$_POST["category"];
    $id_task=$_POST["task"];
    $member=$table=$task=$task_score=$current_score=$new_score=$category=$current_category_score=$new_category_score="";
    
    switch($id_category){
        case 1:
            $table="best_gamification.department";
            $category="Departament";
            break;
        case 2:
            $table="best_gamification.extern";
            $category="Extern";
            break;
        case 3:
            $table="best_gamification.frteams";
            $category="EchipeFR";
            break;
        case 4:
            $table="best_gamification.grants";
            $category="Granturi";
            break;
        case 5:
            $table="best_gamification.international";
            $category="International";
            break;
    }
    
    $sql="SELECT Score, $category FROM best_gamification.members WHERE id='$id_member'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $current_score=$row["Score"];
        $current_category_score=$row[$category];
    }
    if($_SESSION['Rol']=="Admin"){
        $sql="SELECT Nume FROM best_gamification.members WHERE id='$id_member'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $member=$row['Nume'];
        }
    }
    else
        $member=$_SESSION['Name'];
    
    $sql="SELECT Score, Name FROM $table WHERE id='$id_task'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $task=$row["Name"];
        $task_score=$row["Score"];
    }
    if($_SESSION['Rol']=="Admin"){
        if($_POST["pressed"]=="Adaugare"){
            $new_score=$current_score+$task_score;
            $new_category_score=$current_category_score+$task_score;
        }
        else{
            $new_score=$current_score-$task_score;
            $new_category_score=$current_category_score-$task_score;
        }
        if($new_score<0 || $new_category_score<0){
            echo "Noul scor e mai mic decat 0!";
            die();
        }
        $sql="UPDATE best_gamification.members SET Score='$new_score', $category='$new_category_score' WHERE Nume='$member'";
        if($conn->query($sql)){
            $sql="SELECT MAX(id) FROM best_gamification.scores_admin";
            $result=$conn->query($sql);
            if($result){
                $row=$result->fetch_array();
                $id=$row[0]+1;
            }
            else
                echo $conn->error;
            $action=strval($_POST["pressed"]);
            $date1=strval(date("d.m.Y"));
            $date2=strval(date("h:i:sa"));
            $sql="INSERT INTO best_gamification.scores_admin(id,Member,Task,Score,Date1,Date2,Action,Status) VALUES('$id','$member','$task','$task_score','$date1','$date2','$action','Unchecked')";
            if(!$conn->query($sql)==true)
                die("Failed to connect :".$conn->connect_error);
            
            //updatarea titlului membrului in db
            /*$sql="SELECT Title FROM best_gamification.members WHERE Nume='$member'";
            if(!($result=$conn->query($sql)))
                die("Failed to connect: ".$conn->error);
            else{
                $row=$result->fetch_array();
                $title=$row[0];
            }
            if($action=="Adaugare"){
                $sql="SELECT id, Score2 FROM best_gamification.titles WHERE Name='$title'";
                if(!($result=$conn->query($sql)))
                    die("Failed to connect: ".$conn->error);
                $row=$result->fetch_array();
                $score2=$row["Score2"];
                $_id=$row["id"];
                if($new_score>$score2){
                    $_id+=1;
                    $sql="SELECT Name FROM best_gamification.titles WHERE id='$_id'";
                    if(!($result=$conn->query($sql)))
                        die("Failed to connect: ".$conn->error);
                    $row=$result->fetch_array();
                    $title=$row["Name"];
                    $sql="UPDATE best_gamification.members SET Title='$title' WHERE Nume='$member'";
                    if(!($result=$conn->query($sql)))
                        die("Failed to connect: ".$conn->error);
                }
            }
            else{
                $sql="SELECT id, Score1 FROM best_gamification.titles WHERE Name='$title'";
                if(!($result=$conn->query($sql)))
                    die("Failed to connect: ".$conn->error);
                $row=$result->fetch_array();
                $score1=$row["Score1"];
                $_id=$row["id"];
                if($new_score<$score1){
                    $_id-=1;
                    $sql="SELECT Name FROM best_gamification.titles WHERE id='$_id'";
                    if(!($result=$conn->query($sql)))
                        die("Failed to connect: ".$conn->error);
                    $row=$result->fetch_array();
                    $title=$row["Name"];
                    $sql="UPDATE best_gamification.members SET Title='$title' WHERE Nume='$member'";
                    if(!($result=$conn->query($sql)))
                        die("Failed to connect: ".$conn->error);
                }
            }*/
            header("Location: page1.php");
            die();
        }
        else
            die("Failed adding score!");
    }
    else{
        $sql="SELECT MAX(id) FROM best_gamification.scores_user";
        $result=$conn->query($sql);
        if($result){
            $row=$result->fetch_array();
            $id=$row[0]+1;
        }
        else
            echo $conn->error;
        $action=strval($_POST["pressed"]);
        $date1=strval(date("d.m.Y"));
        $date2=strval(date("h:i:sa"));
        $sql="INSERT INTO best_gamification.scores_user(id,Member,Task,Score,Date1,Date2,Action,Status) VALUES('$id','$member','$task','$task_score','$date1','$date2','$action','Unchecked')";
        if(!$conn->query($sql)==true)
            die("Failed to connect :".$conn->connect_error);
        header("Location: page1.php");
        die();
    }
}
?>
