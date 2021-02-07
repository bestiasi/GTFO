<?php session_start();
unset($_SESSION['login']);
unset($_SESSION['username']);
unset($_SESSION['Rol']);
unset($_SESSION['Name']);
$_SESSION["servername"]="db.tuiasi.ro";
$_SESSION["sv_username"]="best_gamification";
$_SESSION["password"]="k8uz8nzb85axr";

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form action="login.php" method="post">
            Username: <input type="text" name="username"><br>
            Parola: <input type="password" name="password"><br>
            <input type="submit" value="Login">
        </form>
        <?php
        
        if(!empty($_GET)){
            $err=$_GET["err"];
            if($err==0)
                echo "Username sau parola incorecte! <br>";
        }
        
        ?>
        <h3>Inregistrare</h3>
        <form action="register.php" method="post">
            Email: <input type="text" name="email"><br>
            Parola: <input type="password" name="password"><br>
            Repetare parola: <input type="password" name="rpassword"><br>
            Gender: Male<input type="radio" name="gender" value="male">
                    Female<input type="radio" name="gender" value="female">
                    Nu exista altceva!<input type="radio" name="gender" value="gay"><br>
            <input type="submit" value="Register">
        </form>
        <?php
        
        if(!empty($_GET)){
            $err=$_GET["err"];
            switch($err){
                case 3:
                    echo "Nu exista cerere pentru email!";
                    break;
                case 4:
                    echo "Email-ul nu este aprobat!";
                    break;
                case 5:
                    echo "Email-ul deja e folosit!";
                    break;
                case 6:
                    echo "Introdu aceeasi parola!";
                    break;
                case 7:
                    echo "Alege gender-ul!";
                    break;
                case 8:
                    echo "Parola sa aiba minim 5 caractere!";
                    break;
            }
        }
        ?>
        <h3>Cerere inregistrare</h3>
        <form action="request.php" method="post">
            Email: <input type="text" name="email"><br>
            <input type="submit" value="Request">
        </form>
        <?php
        if(!empty($_GET)){
            $err=$_GET["err"];
            switch($err){
                case 1:
                    echo "Nu email de bestis!";
                    break;
                case 2:
                    echo "Email-ul deja se afla in request!";
                    break;
            }
        }
        ?>
    </body>
</html>




