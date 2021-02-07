<?php

function EchoRow($col1,$col2,$col3,$col4){
    echo 
        '<div id="participant">
            <div id="part_cont">
                <p>'.$col1.'</p>
            </div>
            <div id="part_cont">
                <p>'.$col2.'-'.$col3.'</p>
            </div>
            <div id="part_cont">
                <p>'.$col4.'</p>
            </div>
        </div>';
}

?>