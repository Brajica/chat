<?php
error_reporting(0);
session_start();
class status{

    function status_session(){
        if (isset($_SESSION["id"]) && $_SESSION["id"]==NULL){
            session_unset();
            session_start();
        }
    }
}


?>
