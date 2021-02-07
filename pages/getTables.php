<!DOCTYPE html>
<html>
    <body>
        <?php
        session_start();
        
        $q=intval($_GET['q']);
        if($q){
            $conn = new mysqli($_SESSION["servername"],$_SESSION["sv_username"],$_SESSION["password"]);
            if($conn->connect_error)
                die("Failed to connect: ".$conn->connect_error);
            $sql="SHOW TABLES FROM best_gamification";
            $result=$conn->query($sql);
            $category[]="";
            $i=0;
            while($row=$result->fetch_array()){
                if($row[0]!="members" && $row[0]!="titles" && $row[0]!="users" && $row[0]!="requests" && $row[0]!="scores_admin" && $row[0]!="scores_user"){
                    $category[$i++]=$row[0];
                }
            }
            echo '<select name="category" onchange="showTasks(this.value)">
                    <option value="0">Selectare categorie</option>';
            for($i=0;$i<count($category);$i++){
                echo '<option value='.($i+1).'>'.$category[$i].'</option>';
            }
            echo '</select>';
        }
        ?>
    </body>
</html>
