<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "db_catering";

    $conn = mysqli_connect($servername,$username,$password,$databaseName);
    
    /*GLOBAL VARIABLES*/
	date_default_timezone_set("Asia/Hong_Kong");
	$dateNow = date("Y/m/d");
    $timeNow = date("h:i:sa");
    $monthToday = date("m");
    $monthNow = date("m");
    
    include "components/templates/lib.links.comp.php";
    
    if(!$conn){
        die("Connection failed: ". mysqli_connect_error());
    }
    if(!isset($_SESSION["ses_cart"])){ 
        $_SESSION["ses_cart"] = array();
    }
?>