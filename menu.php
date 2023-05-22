<?php
    session_start();
    require "include/inc.dbconnect.php";
    include "include/functions.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Menu | QWERTY Catering</title>
        <?php topLinks();?>

	</head>
	<body id="menuPage">

    <?php topLinks(); include "include/components/templates/lib.navbar.comp.php"?>
        
        <!--main content-->
		<div class="wrapper">
			<div class="container">

                <div id="menuButtons" class="py-3">
                    <div class="list-group row text-center">
                        <a href="#packages-list" id="packageButton" class="btn primaryButton col-sm-12 col-md-6 list-group-item list-group-item-action active" data-toggle="list" >Packages</a>
                        <a href="#menu-list" id="menuButton" class="btn primaryButton col-sm-12 col-md-6 list-group-item list-group-item-action" data-toggle="list" >Menu</a>
                    </div>
                </div>
                
                <div id="menuContent" class="tab-content">
                    <!--package list-->

                    <div id="packages-list" class="tab-pane fade show active">
                        <h2 class="text-center"> Our Packages</h2>
                        <div id="yellow-bar"></div>
                        <div class="p-3 text-center">
                            <p>A list of some of the best-ordered packages just for you. </p>
                        </div>
                        <div class="row">
                            <!--PACKAGE CARDS WITH THE MODAL-->
                            <?php 
                                $sqlPackages = "SELECT * FROM packages";
                                $query = mysqli_query($conn,$sqlPackages);
                                /*$result = mysqli_fetch_array($query);*/
                                $rows = mysqli_num_rows($query);
                                $packageID = "";
                                
                                while($viewPackage = mysqli_fetch_array($query)){
                                    $sqlShowReviews = "SELECT * from reviews where rev_package_id = '".$viewPackage["package_id"]."' ";
                                    $resultShowReviews = mysqli_query($conn,$sqlShowReviews);
                                    $rowsSR = mysqli_num_rows($resultShowReviews);
                                    $totalScore = 0;
                                    $pid = $viewPackage["package_id"];
                                    $packageID = $pid;
                                    if($viewPackage["package_rating"] == 0){
                                        $overallScore = 0;
                                    }else{
                                        while($viewSR = mysqli_fetch_array( $resultShowReviews)){
                                            $totalScore += $viewSR["rev_rating_counter"];
                                        }
    
                                        $overallScore = round($totalScore / $rowsSR, 1);
                                        $sqlSetRating = "update packages set package_rating = '$overallScore' where package_id = '".$viewPackage["package_id"]."'";
                                        mysqli_query($conn,$sqlSetRating);
                                    }
                                    
                            ?>
                            <div class="col-md-6">
                                <div class="card mb-4 bg-dark text-white box-shadow package-containers">
                                    <img class="card-img" src="assets/db/package/<?php echo $viewPackage["package_image"]?>">
                                    <div class="card-img-overlay">
                                        <h4 class="card-title"><?php echo $viewPackage["package_name"]?></h4>
                                        <p>&#9733&#9733&#9733&#9733&#9733 <?php echo $overallScore; ?></p>
                                        
                                        <button type="button" class="btn primaryButton" data-toggle="modal" data-target="#packageInfoModal<?php echo $viewPackage["package_id"]?>">View more</button>
                                    </div>
                                </div>
                            </div>

                            <?php include "include/components/templates/lib.packagedetails.comp.php"?>
                            
                            <?php
                                }
                            ?>
                        </div>  
                    </div>

                    <!--menu list-->
                    <div id="menu-list" class="tab-pane fade">
                        <h2 class="text-center"> Our Menu</h2>
                        <div id="yellow-bar"></div>
                        <div class="p-3 text-center">
                            <p>We serve the best dishes everyone can enjoy! Feel free to add these to your order.</p>
                        </div>

                        <div class="row marg">
                            <?php
                                $sqlCategories = "select * from categories";
                                $resultCategories = mysqli_query($conn,$sqlCategories);
                                while($viewCategories = mysqli_fetch_array($resultCategories)){                                

                            ?>
                            <div class="col-md-6 p-3">
                                <div class="card">
                                    <div class="view">
                                        <div class="featured-image-slot">
                                            <img src="assets/db/categories/<?php echo $viewCategories["cat_image"] ?>" class="img-fluid" alt="photo">
                                        </div>
                                        <a href="#">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                    <div class="card-body text-center">
                                        <h2 class="card-title"><?php echo $viewCategories["cat_name"]?></h2>
                                        <a href="#" class="btn primaryButton btn-md waves-effect" onclick="pcontDetails(<?php echo $viewCategories["cat_id"]?>)">Open</a>
                                    </div>

                                </div>
                            </div>
                            <script>
                                function pcontDetails(pcontid){
                                    window.open("menulist.php?cat="+pcontid,"_self");
                                    console.log(pcontid);
                                }
                            </script>
                            <?php
                                }
                            ?>
                        </div>
                    </div>                
                </div>                
			</div>
		</div>

		<script src="vendors/js/bootstrap.min.js"></script>
	</body>
</html>