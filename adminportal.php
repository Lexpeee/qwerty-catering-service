<?php
    require_once "include/inc.dbconnect.php";
    include "include/functions.php";
    session_start();


if(isset($_SESSION["ses_user"]) || isset($_SESSION["ses_lname"]) || isset($_SESSION["ses_fname"])){
    if(isset($_SESSION["ses_accttype"])){
        if($_SESSION["ses_accttype"] == "admin"){
            
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin Portal | QWERTY Catering</title>
       
        <?php topLinks();?>

        <script>
            function clearBadge(value){
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET","include/ajax.php?link="+value,true);
                if(value == "messagesbox"){
                   document.getElementById("badge-messages").style.display = "none";
                }
                if(value == "payments"){
                   document.getElementById("badge-payments").style.display = "none";
                }
                if(value == "notifbutton"){
                   document.getElementById("badge-notifications").style.display = "none";
                }
                xhttp.send();
            }
            var xhttp = new XMLHttpRequest();

        </script>

	</head>
	<body class="adminBody">

        <?php include "include/components/templates/lib.navbar.comp.php"?>

        <!-- MAIN CONTENT -->
		<div class="wrapper m-3"> 
            <div class="container-fluid">
                <div class="row">
                    <!-- LEFT SIDE CONTENT -->
                    <div class="col-3 fixed">
                        <div class="card mb-2 text-center black-bg-color">
                            <div class="card-body">
                                <h5 class="text-center">Upcoming Schedule</h5>
                                <p><?php
                                    $sqlNextSched = "select * from payments where paylog_date_req >= '$dateNow' and paylog_time_req >= '$timeNow' and paylog_status = 'Paid' order by paylog_date_req asc limit 1";
                                    $resultNextSched = mysqli_query($conn,$sqlNextSched);
                                    if($rowsNextSched = mysqli_num_rows($resultNextSched)){
                                        if($rowsNextSched = 1){
                                            if($view = mysqli_fetch_assoc($resultNextSched)){
                                                echo $view["paylog_eventname"];
                                                echo "<br>";
                                                ?>
                                                    <a href="#" onclick="getPaymentSummary(<?php echo $view["paylog_id"]?>)">View Summary</a>
                                                <?php
                                            }
                                        }else if($rowsNextSched < 1){        
                                            echo "There are no upcoming schedules at the moment. ";
                                        }else{
                                            echo "There's either one or more schedules placed.";
                                        }
                                    }else{
                                        echo "No upcoming schedules yet<br>";
                                    }
                                ?></p>
                            </div>
                        </div>
                        
                        <div class="list-group" id="side-menu-admin">
                            <a class="list-group-item list-group-item-action active" id="list-dashboard-link" data-toggle="list" href="#list-dashboard"><i class="fas fa-tachometer-alt fa-xs"></i> Dashboard</a>
                            <!-- <a class="list-group-item list-group-item-action" id="list-usermessages-link" data-toggle="list" href="#list-usermessages"><i class="fas fa-gift fa-xs"></i> User Messages</a> -->
                            <a class="list-group-item list-group-item-action" id="list-packages-link" data-toggle="list" href="#list-packages"><i class="fas fa-gift fa-xs"></i> Packages</a>
                            <a class="list-group-item list-group-item-action" id="list-menu-link" data-toggle="list" href="#list-menu"><i class="fas fa-list fa-xs"></i> Menu</a>
                            <a class="list-group-item list-group-item-action" id="list-schedule-link" data-toggle="list" href="#list-schedule" onclick="clearBadge('payments')"><i class="fas fa-calendar fa-xs"></i> Schedule<span id="badge-payments" class="badge badge-primary"><?php getSchedulesNotif($conn); ?></span></a>
                            <a class="list-group-item list-group-item-action" id="list-messages-link" data-toggle="list" href="#list-messages" onclick="clearBadge('messagesbox')"><i class="fas fa-envelope fa-xs"></i> Messages<span id="badge-messages" class="badge badge-primary"><?php getMessageNotif($conn); ?></span></a>
                            <a class="list-group-item list-group-item-action" id="list-users-link" data-toggle="list" href="#list-users"><i class="fas fa-users fa-xs"></i> Users</a>
                            <a class="list-group-item list-group-item-action" id="list-settings-link" data-toggle="list" href="#list-settings"><i class="fas fa-cog fa-xs"></i> Settings</a>
                        </div>
                        
                        
                    </div>
                    
                    <!-- RIGHT SIDE CONTENT -->    
                    <div class="col-9 black-bg-color">
                        <div id="mainContent">
                            <div class="tab-content" id="tab-menu-content">
                                <!-- <button type="button" name="textButtonAdd" class="btn primaryButton" onclick="addCounter`">Click me</button>
                                <p id="manPara">asdqwe</p> -->
                                <script>
                                    function addCounter(){
                                        var xhttp = new XMLHttpRequest();
                                        xhttp.onreadystatechange = function(){
                                            if(this.readyState == 4 && this.status == 200){
                                                document.getElementById("manPara").innerHTML = this.responseText;
                                            }
                                        }
                                        xhttp.open("GET","include/ajax.php?button=test",true);
                                        xhttp.send();
                                    }
                                </script>
                                
                                <!--DASHBOARD TAB-->
                                <div class="tab-pane fade show active m-3" id="list-dashboard">
                                    <h3 class="p-3 text-center uniqueHeader">Dashboard</h3>
                                    <?php include "include/records/lib.dashboard.php" ?>
                                </div>
                                
                                <!--USER MESSAGES-->
                                <!-- <div class="tab-pane fade" id="list-usermessages">
                                    <h3 class="p-3 text-center uniqueHeader">User Messages</h3>
                                    <div class="moreblack-bg-color">
                                        <?php //include "include/records/lib.usermessages.php"?>
                                    </div>
                                </div> -->
                                
                                <!--PACKAGES TAB-->
                                <div class="tab-pane fade" id="list-packages">
                                    <h3 class="text-center uniqueHeader">Packages</h3>
                                    <?php include "include/records/lib.packages.php"?>
                                </div>
                                
                                <!--MENU TAB-->
                                <div class="tab-pane fade" id="list-menu">
                                    <h3 class="text-center uniqueHeader">Menu</h3>
                                    <?php include "include/records/lib.menuitems.php"?>
                                </div>
                                
                                <!--SCHEDULES TAB-->
                                <div class="tab-pane fade" id="list-schedule">
                                    <h3 class="text-center uniqueHeader">Schedules</h3>
                                    <?php include "include/records/lib.schedules.php"?>
                                </div>
                                        
                                <!--MESSAGES TAB-->
                                <div class="tab-pane fade" id="list-messages">
                                    <h3 class="p-3 text-center uniqueHeader">Messages</h3>
                                    <?php include "include/records/lib.messages.php"?>
                                </div>
                                    
                                <!--<h3 class="p-3 text-center uniqueHeader">Dashboard</h3> TAB-->
                                <!-- USERS TAB -->
                                <div class="tab-pane fade" id="list-users">
                                    <h3 class="p-3 text-center uniqueHeader">Users</h3>
                                    <?php include "include/records/lib.useraccounts.php"?>
                                </div>
                                
                                <!--SETTINGS TAB-->
                                <div class="tab-pane fade" id="list-settings">
                                    <h3 class="p-3 text-center uniqueHeader">Settings</h3>
                                    <ul>
                                        <li>Change Passsword</li>
                                        <li>Change details(first name, last name, email contact, mga kuno kuno);</li>
                                        
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
		</div>
        <!--END OF MAIN CONTENT-->
        <script>
            /* function for testing purposes */
            function errorMsg(a){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("errorMessageHere").innerHTML = this.responseText;
                        //window.alert(a);
                        /* do test1 as a variable */
                    }
                }
                xhttp.open("GET","include/libraries/lib.errors.php?error="+a,true);
                xhttp.send();
            }
        </script>
        <?php bottomLinks();?>
	</body>
</html>
<?php
            
        }else if($_SESSION["ses_accttype"] == "user"){
            header("location:index.php?noaccess");
        }else{
            header("location:preview.php?noaccess");
        }
    }
}else{
    header("location:preview.php?signin=errorloadingpage");
}
    
    
?>