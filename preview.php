<?php
    session_start();
    require "include/inc.dbconnect.php";
    include "include/functions.php";
   
if(isset($_SESSION["ses_user"]) || isset($_SESSION["ses_uid"]) || isset($_SESSION["ses_lname"]) || isset($_SESSION["ses_fname"])){
    header("location:index.php");
}else{
    
    
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sad Project</title>

        <?php topLinks(); ?>
	</head>
	<body>
        
        <div id="featuredPackageInfoModal" class="modal fade">
			<div class="modal-dialog" role="document" style="max-width: 75%;">
				<div class="modal-content">
					<div class="modal-body">
                        <?php
                            $sqlFeaturedPackage = "select top 1 * from packages order by package_rating limit 1";
                            $result = mysqli_query($conn,$sqlFeaturedPackage);    
                            $viewFP = mysqli_fetch_array($result);
                        
                        ?>
                        
						<h2 class="sad-header"><?php echo $viewFP["package_name"];?></h2>
                        <p>&#9733&#9733&#9733&#9733&#9733 15</p>
						<div class="featured-image-slot" style="background: url(../../assets/featuredpagebg.png) no-repeat center ;"></div>
						<div class="text-center">
							<button type="button" class="btn btn-lg btn-warning text-white" onclick="getPackageIDFeatured()">Order now!</button>
						</div>
                        <script>
                        function getPackageIDFeatured(){
                            window.open("order.php?pid=2","_self");
                        }
                        </script>
						<p id="packagePar">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						

						<div class="text-center">
							<ul>
								<?php 
                                    $sqlFPList = "SELECT * from package_contents where pcont_package_id = '".$viewFP["package_id"]."' ";
                                    $resultFP = mysqli_query($conn,$sqlFPList);

                                    while($viewFP = mysqli_fetch_array($resultFP)){
                                ?>
                                <li class="list-group-item"><?php echo $viewList["pcont_name"]?> <em><?php echo $viewList["pcont_category"]?></em></li>

                                <?php        
                                    }
                                ?>
							</ul>
							<p>Price: 100000</p>
						</div>
						<hr>
						<div class="container-fluid">
							<div class="row">
								<div class="col-2">
									<div class="radial-profile-picture"></div>
								</div>
								<div class="col-10">
									<h5 class="header">Critic Name</h5>
									<p>&#9733&#9733&#9733&#9733&#9733 15</p>
									<em>"omg omg i love this package. it tase gud and i love it. omg omgomgomg this is too informal omg baliw ako"</em>
									<p>Date submitted: asdqweqweqwwe</p>
								</div>
							</div>
						</div>
						<h3 class="text-center">Load more reviews</h3>
                        
					</div>
				</div>
			</div>
		</div>
        
        <!--MAIN CONTENT-->
        <section id="welcomeSection">
            <?php include "include/components/templates/lib.navbar.comp.php"?>
            
            <div id="welcomeSection1" class="container">
                <div class="logo-area">
                    <a href="preview.php"><img id="mainLogo" src="assets/logo/qwerty%20catering%20WHITE-01.png"></a>
                    <p id="titleHeader">Building every memory, one occasion at a time</p>
                    <button id="latestMenuButton" class="btn primaryButton">See our latest menu</button>
                    <script>
                        document.getElementById("latestMenuButton").addEventListener("click",function(){
                            window.open("menu.php","_self");
                        });
                    </script>
                </div>
            </div>
            
            <div id="welcomeSection2" class="container">
                <div id="aboutUsSection">
                    <h1 class="text-center p-3">About Us</h1>
                    <div id="yellow-bar"></div>
                    <p id="aboutText">With over 25 years of experience in the catering business, our President Claudete Sebben founded this company on the principal of excellence. Qwerty Catering not only executes delicious cuisine but also high-quality presentation and service. We are committed to give each and every client regardless of the size of your event, the type of occasion, or their budget, the best cuisine and service.</p>
                    <p id="aboutText">We have an established reputation for taking special care of our clientele, providing impeccable service, international cuisine selections, and attentive, professional follow-up. We are known for being a one-stop shop for all catering and rentals needs, providing you with an endless variety of choices and for continually exceeding our clients’ expectations. Since our entry on the scene in 1995 we have received countless nods from clients, media sources, and top DC-area event professionals.</p>
                    <p id="aboutText">Qwerty creates custom menus and decor to fit our clients’ unique tastes and budgets. We bring their vision to life with exquisite cuisine and presentation, offering a multitude of flavors of the world’s cuisine.</p>
                </div>
            </div>
        </section>    
        
        <section id="howtoSection">
            <div class="container">
                <h1 class="text-center p-3">Book our services</h1>
                <p class="black-color text-center">Here's how you can order online</p>
                <div id="yellow-bar"></div>
                <div id="howToSectionGuideBox">
                   <div class="timeline">



                       <div class="timeline-item timeline-item-left">
                           <div class="row">
                               <div class="col-8 text-right">
                                   <h5 class="title black-color">Browse Menu</h5>
                                   <p class="black-color">Choose from a variety of menu items we offer</p>
                                </div>
                                <div class="col-4">
                                    <img src="assets/icons/menu-1.png" style="height: 90px;">
                                </div>
                            </div>
                            <div class="timeline-point timeline-point-default"></div>
                       </div>
                       <div class="timeline-item timeline-item-right">
                           <div class="row">
                               <div class="col-4">
                                   <img src="assets/icons/clipboard.png" style="height: 90px;">
                                </div>
                                <div class="col-8">
                                    <h5 class="title black-color">Set Your Date</h5>
                                    <p class="black-color">Book your orders on the date you choose</p>
                                </div>
                            </div>
                            <div class="timeline-point timeline-point-default"></div>
                       </div>
                       <div class="timeline-item timeline-item-left">
                           <div class="row">
                               <div class="col-8 text-right">
                                   <h5 class="title black-color">Provide Your Details</h5>
                                   <p class="black-color">Fill out the necessary details we need to deliver</p>
                                </div>
                                <div class="col-4">
                                    <img src="assets/icons/browser.png" style="height: 65px;">
                                </div>
                            </div>
                            <div class="timeline-point timeline-point-default"></div>
                       </div>
                       <div class="timeline-item timeline-item-right">
                           <div class="row">
                               <div class="col-4">
                                   <img src="assets/icons/invoice.png" style="height: 90px;">
                                </div>
                                <div class="col-8">
                                    <h5 class="title black-color">Get your order statement</h5>
                                    <p class="black-color">Claim your online receipt after ordering</p>
                                </div>
                            </div>
                            <div class="timeline-point timeline-point-default"></div>
                       </div>
                       <div class="timeline-item timeline-item-left">
                           <div class="row">
                               <div class="col-8 text-right">
                                   <h5 class="title black-color">Track your orders</h5>
                                   <p class="black-color">We have a little app at the bottom of the page to track your orders</p>
                                </div>
                                <div class="col-4">
                                    <img src="assets/icons/menu-1.png" style="height: 90px;">
                                </div>
                            </div>
                            <div class="timeline-point timeline-point-default"></div>
                       </div>
                       
                   </div>
                </div>
            </div>            
        </section>
        
        
        <section id="featuredSection">
            <div id="featuredSectionContent" class="container">
                <h1 class="text-center white-color p-3">Featured Package:</h1>
                <div id="yellow-bar"></div>

                <?php
                    $sqlGetTopRatedPackage = mysqli_query($conn,"select * from packages order by package_rating desc limit 1");
                    while($topRatedPackage = mysqli_fetch_assoc($sqlGetTopRatedPackage)){
                ?>
                <div id="featuredPackage" class="row">
                    <div class="col-sm-12 col-md-6">
                        <div id="featuredImage" style="background: url(assets/db/package/<?php echo $topRatedPackage["package_image"]?>) no-repeat center;"></div>
                    </div>
                    <div id="featured-package-info" class="col-sm-12 col-md-6">
                        <div id="starRating">
                            <img src="assets/icons/star.png"><p style="float: right;"><?php echo $topRatedPackage["package_rating"]?></p>
                        </div>
                        <h1 class="text-center p-3 uniqueHeader"><?php echo $topRatedPackage["package_name"]?></h1>
                        <div id="yellow-bar"></div>
                        <p class="black-color p-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <button type="button" class="btn btn-max-width primaryButton featured-buttons" data-toggle="modal" data-target="#featuredPackageInfoModal">Order Now</button>
                        <button type="button" class="btn btn-max-width secondaryButton featured-buttons" onclick="window.open('menu.php','_self')">View More</button>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </section>
        <section id="contactSection">
            <div class="container">
                <div class="row">
                    <div id="contactSection1" class="col-md-6 col-sm-12 my-auto" >
                        <div class="p-5 text-left">
                            <h3 class="text-center p-3">Contact us</h3>
                            <div id="yellow-bar"></div>
                            <div class="p-3">
                                <p><i class="fas fa-lg fa-envelope"></i> info@qwertycatering.com</p>
                                <p><i class="fab fa-lg fa-facebook"></i> facebook.com/qwertycatering</p>
                                <p><i class="fab fa-lg fa-instagram"></i> @qwertycatering</p>
                            </div>
                        </div>
                    </div>
                    <div id="contactSection2" class="col-md-6 col-sm-12 ">
                        <h3 class="text-center p-1">Connect</h3>
                        <div id="yellow-bar"></div>
                        <p class="p-1 text-center"> Got something on your mind? let us know by sending us a message</p>
                        <form class="customForm" method="post" action="include/inc.contactusform.php">

                            <div class="form-group">
                                <input type="text" name="txtCNName" class="inputForm" placeholder="Name" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6">
                                    <input type="email" name="txtCNEmail" class="inputForm" placeholder="Email" required>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <input type="text" name="txtCNContactNumber" class="inputForm" placeholder="Contact" maxlength="11" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea rows="3" type="text" name="txtCNAddress" class="inputForm" placeholder="Address" required></textarea>
                            </div>
                            <div class="form-group">
                                <textarea rows="4" name="txtCNMessage" class="inputForm" placeholder="Message" required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <input type="checkbox" name="chkboxNotify" ><span>   Send me updates through email regarding news and updates</span>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btnSubmitCN" class="btn primaryButton">
                            </div>

                        </form>
                    </div>
                    
                </div>
            </div>
        </section>
        <section id="orderCheckerSection">
            <div class="container">
                <div class="text-center">
                    
                    
                        <h1>Order Checker</h1>
                        <div id="yellow-bar"></div>
                        <form class="customForm">
                        
                            <div id="divSearchOrder" class="form-group">
                                <p class="p-2">Type in your transaction number to check your order status:</p>
                            </div>
                            <input type="number" id="txtBoxCheckOrder" name="txtCheckOrder" class="inputForm text-center m-3">
                            <button type="button" class="btn primaryButton" onclick="searchOrder(event)">Check Order</button>
                        </form>
                    
                    <script>
                        function getPaymentSummary(payid){
                            window.open("include/libraries/summary.php?sumid="+payid,"","width=500,height=700,resizable=no");
                        }

                        function searchOrder(e){
                            e.preventDefault();
                            searchDiv = document.getElementById("divSearchOrder");
                            var id = document.getElementById("txtBoxCheckOrder").value;
                            
                            xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function(){
                                if(this.readyState == 4 && this.status == 200){
                                    // console.log("test");  
                                    searchDiv.innerHTML = this.responseText;
                                }else if(this.readyState == 3 && this.status == 200){
                                    searchDiv.innerHTML = "Loading..";         
                                }
                            }
                            
                            xhttp.open("GET","include/libraries/lib.quickordersum.php?sumid="+id,true);
                            xhttp.send();
                        }
                    </script>
                    
                    <!-- want to cancel order, status of an order, check schedule of the date, -->
                </div>
                <div class="customFooter py-5 text-center">
                    <p>© 2018 Copyright: Alexis Pineda & Edward Eclarinal</p>
                </div>
            </div>
        </section>
        
        <?php bottomLinks();?>
	</body>
</html>
<?php
    }
?>