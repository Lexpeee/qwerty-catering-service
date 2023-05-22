<?php
    require "include/inc.dbconnect.php";
    include "include/functions.php";
    session_start();

    
if(isset($_SESSION["ses_user"]) || isset($_SESSION["ses_uid"]) || isset($_SESSION["ses_lname"]) || isset($_SESSION["ses_fname"])){
    if(isset($_SESSION["ses_accttype"])){
        if($_SESSION["ses_accttype"] == "user"){
            
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Home | QWERTY Catering</title>

		<?php toplinks();?>
    
	</head>
	<body id="indexBody">

    <?php include "include/components/templates/lib.navbar.comp.php"?>
    
		<div class="wrapper">
            <div class="container">
                <div class="row">

                    <!-- LEFT SIDE CONTENT -->

                    <div class="col-3">
                        <div class="card mb-2 text-center black-bg-color">
                            <div class="card-body">
                                <h5>Upcoming Schedule</h5>
                                <?php
                                    $sqlNextSched = "select * from payments where paylog_date_req >= '$dateNow' and paylog_time_req >= '$timeNow' and paylog_status = 'Paid'";
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
                                ?>
                            </div>
                        </div>
                        
                        <div class="list-group" id="side-menu-admin">
                            <a class="list-group-item list-group-item-action active" id="list-dashboard-link" data-toggle="list" href="#list-dashboard"><i class="fas fa-newspaper fa-xs"></i> Dashboard<span class="badge badge-primary"></span></a>
                            <a class="list-group-item list-group-item-action" id="list-schedule-link" data-toggle="list" href="#list-schedule"><i class="fas fa-calendar fa-xs"></i> Schedule<span class="badge badge-primary"></span></a>
                            <a class="list-group-item list-group-item-action" id="list-messages-link" data-toggle="list" href="#list-messages"><i class="fas fa-envelope fa-xs"></i> Messages<span id="badge-messages" class="badge badge-primary"></span></a>
                            <a class="list-group-item list-group-item-action" id="list-settings-link" data-toggle="list" href="#list-settings"><i class="fas fa-cog fa-xs"></i> Settings</a>
                        </div>
                    </div>
                    
                    <!-- RIGHT SIDE CONTENT -->
                    <div class="col-9 black-bg-color">
                        <div id="mainContent">
                            <div class="tab-content">
                                <!--DASHBOARD TAB-->
                                <div class="tab-pane fade show active" id="list-dashboard">
                                    <div class="moreblack-bg-color p-3">
                                        <!-- <button type="button" class="btn btn-success active col-sm-12 p-3" onclick="window.open('menu.php','_self')">Order now!</button> -->
                                        <h2 class="uniqueHeader text-center">Dashboard</h2>
                                        <?php include "include/records/lib.dashboard.php"?>
                                        
                                    </div>
                                </div>
                                
                                <!--SCHEDULES TAB-->
                                
                                <div class="tab-pane fade" id="list-schedule">
                                    <h1 class="uniqueHeader text-center">Schedules</h1>
                                    <?php include "include/records/lib.schedules.php"?>
                                </div>
                                
                                <!--MESSAGES TAB-->
                                <div class="tab-pane fade" id="list-messages">
                                    <h3 class="p-3 text-center uniqueHeader">Messages</h3>
                                    <?php include "include/records/lib.messages.php"?>
                                </div>
    
                                <!-- SETTINGS -->
                                <div class="tab-pane fade" id="list-settings">
                                    <h3 class="p-3 text-center uniqueHeader">Settings</h3>
                                    <div class="alert alert-warning">
                                        Coming Soon!
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    
                    <!--END OF MAIN CONTENT-->
                </div>
            </div>
		</div>
    
        <?php bottomLinks();?>
	</body>
</html>
<?php
        }else{
            header("location:adminportal.php");
        }
    }else{
        header("location:preview.php?signin=failedtocheckaccttype");
    }
}else{
    header("location:preview.php?signin=errorloadingpage");
}
    
    
?>