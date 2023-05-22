<?php
    require "../inc.dbconnect.php";
    include "../functions.php";
    session_start();

?>
<html>
    <html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Order Summary | QWERTY CATERING</title>
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
        <link rel="stylesheet" type="text/css" href="../../vendors/css/mdb-4.11.css">
        <!-- <link rel="stylesheet" href="../../vendors/css/style.css"> -->
        <link rel="stylesheet" href="../../vendors/css/fa-svg-with-js.css">
        
        
        <script src="../../vendors/js/Chart.js"></script>
        <script src="../../vendors/js/fontawesome-all.js"></script>
		<script src="../../vendors/js/jquery-3.3.1.min.js"></script> 

	</head>
        <body>
            <div class="container">
                <div id="asdqwe123"></div>
                <div class="col-sm-12 text-center">
                    <img id="mainLogo" style="width: 100px;height: 150px;" src="../../assets/logo/qwerty catering-01.png">

                    <h2>Monthly Summary</h2>
                    <p><?php echo date("F Y") ?></p>
                    <!-- <div id="yellow-bar"></div> -->
                    
                    <?php
                        $monthToday = date("F");
                        $monthTodayUnix = date("m");
                        $dayToday = date("d");
                        $getMonthlyRecords = mysqli_query($conn,"select distinct * from payments where MONTH(paylog_date_paid) = '$monthTodayUnix' and day(paylog_date_paid) < '$dayToday' and paylog_status = 'Paid'");
                        
                        
                        $rows = mysqli_num_rows($getMonthlyRecords);
                        echo "<br>";
                    
                    ?>
                    <div class="header">
                        <p>
                            Total successful payments: <?php echo $rows?><br>
                            Total money: <?php echo number_format("100000");?> PHP
                        </p>

                    </div>
                    <?php
                        if($rows == 0){
                            ?>
                                <div class="alert alert-warning text-center p-5">There are no records to show..</>
                            <?php
                        }else{
                    ?>
                    <table class="table table-hover table-bordered ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event Name</th>
                                <th>Event Type</th>
                                <th>PAX</th>
                                <th>Payment Type</th>
                                <th>Order Type</th>
                                <th>Date and Time Paid</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <?php while($view = mysqli_fetch_array($getMonthlyRecords)){?>
                            <tr>
                                <td><?php echo $view["paylog_id"]?></td>
                                <td><?php echo $view["paylog_eventname"]?></td>
                                <td><?php echo $view["paylog_eventtype"]?></td>
                                <td><?php echo $view["paylog_pax"]?></td>
                                <td><?php echo $view["paylog_paytype"]?></td>
                                <td><?php echo $view["paylog_ordertype"]?></td>
                                <td><?php echo $view["paylog_date_paid"]." ".$view["paylog_time_paid"]?></td>
                                <td><?php echo number_format($view["paylog_price"])?> PHP</td>
                            </tr>
                            <!-- <pre><?php var_dump($view)?></pre> -->
                        <?php
                        }
                        ?>
                    </table>
                    

                    <button type="button" class="btn btn-primary" onclick="printPage()">Print</button>
                    
                
                    <?php
                        }
                    ?>
                <script>
                    
                    function printPage(){
                        window.print();
                    }
        
                </script>
            </div>
        </body>
</html>