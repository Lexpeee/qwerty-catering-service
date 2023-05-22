
<!-- MODALS -->

<div id="loginModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p>LOGIN FORM</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>	
            </div>
            <div class="modal-body">
                <form class="customForm" method="post" action="include/inc.usermanagement.php">
                    <div class="container p-3">
                        <input type="text" name="txtUsername" class="inputForm p-2" placeholder="Username">
                        <input type="password" name="txtPassword" class="inputForm p-2" placeholder="Password">
                    </div>
                    <p class="text-center">Not yet a member? <a class="link" href="register.php">Create an account</a></p>
                    <input type="submit"name="btnLoginSubmit"  class="btn primaryButton btn-max-width">
                </form>
            </div>
        </div>
    </div>
</div>

<div id="logoutModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Logout Session</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>	
                </div>
                <div class="modal-body">
                    <p class="text-center">Confirm Logout Session</p>
                    <form class="text-center" action="include/inc.usermanagement.php" method="post">
                        <button type="submit" name="btnLogoutSubmit" class="btn primaryButton btn-max-width">LOG-OUT</button>
                        <a href="#" class="link " data-dismiss="modal">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Navigation -->
<header>
    <nav class="navbar navbar-expand mx-auto">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"><span class="navbar-toggler-icon"></span></button>

        <?php
            if(isset($_SESSION["ses_accttype"])){
                if($_SESSION["ses_accttype"] == 'user' || $_SESSION["ses_accttype"] == 'admin'){
        ?>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav m-auto">
                            
                        <li class="nav-item"><a href="preview.php" class="nav-link"> HOME</a></li>
                        <li class="nav-item"><a href="menu.php" class="nav-link"> MENU</a></li>
                        
                        <li class="nav-item"><a href="order.php" class="nav-link"> CART 
                                    <?php
                                        if(isset($_SESSION["ses_cart"]) && $_SESSION["ses_cart"] != null){
                                            $cartItems = count($_SESSION["ses_cart"]);
                                    ?>
                                            <span class="badge badge-warning"><?php echo $cartItems;?></span>
                                    <?php
                                        }
                                    ?>
                                </a>
                            </li>
                        <li class="nav-item dropdown"><a href="#" id="notificationDropdoown" class="nav-link dropdown-toggle" data-toggle="dropdown" onclick="clearBadge('notifbutton')">NOTIFICATIONS<span id="badge-notifications" class="badge badge-danger"><?php getAllNotifs($conn)?></span></a>
                            <div class="dropdown-menu" style="width: 200px; float: left;">
                                <?php
                                    $sqlShowNotifs = "select * from notifications where notif_isRead = '0' and notif_received_user = '".$_SESSION["ses_uid"]."' order by notif_date_generated and notif_time_generated asc limit 5";
                                    if($resultShowNotifs = mysqli_query($conn,$sqlShowNotifs)){
                                        $rowsShowNotifs = mysqli_num_rows($resultShowNotifs);
                                        if($rowsShowNotifs >= 1){
                                            while($viewNotifs = mysqli_fetch_array($resultShowNotifs)){
                                                echo $viewNotifs["notif_text"]." <span class='small-text'>". $viewNotifs["notif_time_generated"] ."</span><hr>"; 
                                            }
                                            echo "View more notifications";
                                        }else{
                                            ?>
                                                <span class="text-center text-black"><a href="#" class="link">See all notifications</a></span>
                                            <?php

                                        }

                                    }else{
                                        echo "Error fetching notifications";
                                    }

                                ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" ><?php echo strtoupper($_SESSION["ses_user"])?></a>

                            <div class="dropdown-menu">    
                                <!-- <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Settings</a> -->
                                <a class="dropdown-item modal-toggle" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                            </div>                        
                        </li>   
                    </ul>
                </div>  
    <?php                  
            }
        }else{
    ?>
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav m-auto">

                        <li class="nav-item"><a href="preview.php" class="nav-link"> HOME</a></li>
                        <li class="nav-item"><a href="menu.php" class="nav-link"> MENU</a></li>
                        <li class="nav-item"><a href="preview.php#welcomeSection2" class="nav-link" style="transition-duration: 1s;"> ABOUT US</a></li>
                        <li class="nav-item"><a href="preview.php#howtoSection" class="nav-link">BOOKING</a></li>
                        <li class="nav-item"><a href="preview.php#contactSection" class="nav-link"> CONTACT</a></li>
                        <li class="nav-item"><a href="order.php" class="nav-link"> CART 
                                <?php
                                    if(isset($_SESSION["ses_cart"]) && $_SESSION["ses_cart"] != null){
                                        $cartItems = count($_SESSION["ses_cart"]);
                                ?>
                                        <span class="badge badge-warning"><?php echo $cartItems;?></span>
                                <?php
                                    }
                                ?>
                            </a>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link btn-outline" data-toggle="modal" data-target="#loginModal">LOGIN</a></li>
                    </ul>
                </div>
    <?php
            }
    ?>        

        </nav>
    </header>



    <?php //include "include/components/templates/lib.navbar.comp.php"?>