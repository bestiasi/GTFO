function showTables(str){
    if(str==""){
        document.getElementById("tablesHint").innerHTML="";
        return;
    }
    else{
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                document.getElementById("tablesHint").innerHTML=this.responseText;
            }
        };
        xmlhttp.open("GET","getTables.php?q="+str,true);
        xmlhttp.send();
        showTasks(0);       //scoate un select-urile
        showButton(0);
    }
}

function showTasks(str){
    if(str==""){
        document.getElementById("tasksHint").innerHTML="";
        return;
    }
    else{
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                document.getElementById("tasksHint").innerHTML=this.responseText;
            }
        };
        xmlhttp.open("GET","getTasks.php?q="+str,true);
        xmlhttp.send();
        showButton(0);
    }
}

function showButton(str){
    if(str==""){
        document.getElementById("buttonHint").innerHTML="";
        return;
    }
    else{
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                document.getElementById("buttonHint").innerHTML=this.responseText;
            }
        };
        xmlhttp.open("GET","getButton.php?q="+str,true);
        xmlhttp.send();
    }
}














