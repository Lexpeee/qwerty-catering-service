
                            <!--MODAL FOR PACKAGES LIST-->
                            <div id="packageInfoModal<?php echo $viewPackage["package_id"]?>" class="modal fade">
                                <div class="modal-dialog" role="document" style="max-width: 75%;">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h2><?php echo $viewPackage["package_name"];?></h2>
                                            <div class="featured-image-slot">
                                                <img src="assets/db/package/<?php echo $viewPackage["package_image"]?>">
                                            </div>
                                            <p id="textdiv" class="text-center p-2">Price: <?php echo number_format($viewPackage["package_price"])?> PHP</p>
                                            <div class="text-center">
                                                <!-- <button type="button" id="btnSendReview" class="btn secondaryButton">Send a Review</button> -->
                                                <button type="button" id="btnOrderButton<?php echo $viewPackage["package_id"]?>" class="btn primaryButton">Order now</button>
                                                <script>
                                                    document.getElementById("btnOrderButton<?php echo $viewPackage["package_id"]?>").addEventListener("click",function(){
                                                        var xhttp = new XMLHttpRequest();
                                                        xhttp.onreadystatechange = function(){
                                                            if(this.readyState == 4 && this.status == 200){
                                                                console.log(this.responseText);
                                                            }
                                                        }
                                                        xhttp.open("GET","include/inc.scart.php?packid=<?php echo $viewPackage["package_id"]?>",true);
                                                        xhttp.send();
                                                        
                                                        window.open("order.php","_self");
                                                    }); 
                                                </script>
                                                <!--<button id="btnAdd_<?php echo $viewCatContent["pcont_id"]?>" type="button" class="btn btn-info" onclick="addToCart('<?php echo $viewCatContent["pcont_id"]?>', '<?php echo $viewCatContent["pcont_name"]?>','<?php echo $viewCatContent["pcont_price"]?>')">+ Add To Cart</button>-->
                                            </div>
                                            <?php /*var_dump($_SESSION["ses_cart"]);echo "<br>";echo "<br>";*/?>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                            <p>&#9733&#9733&#9733&#9733&#9733 <?php echo $overallScore;?></p>

                                            <div class="text-center">
                                                <ul class="list-group">
                                                    <?php 
                                                        $sqlList = "SELECT * from package_contents where pcont_package_id = '".$viewPackage["package_id"]."' ";
                                                        $queryList = mysqli_query($conn,$sqlList);
                                                        while($viewList = mysqli_fetch_array($queryList)){
                                                    ?>
                                                    <li class="list-group-item"><?php echo $viewList["pcont_name"]?> <em><?php echo $viewList["pcont_category_id"]?></em></li>

                                                    <?php        
                                                        }
                                                    ?>

                                                </ul>
                                                
                                            </div>
                                            <div class="container-fluid" id="reviewCorner" style="display: none">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="radial-profile-picture"></div>
                                                    </div>
                                                    <div class="col-10">
                                                        <?php
                                                            $sqlRandomReview = "select * from reviews where rev_package_id = '".$viewPackage    ["package_id"]."' order by rand() limit 2";
                                                            $resultRandomReview = mysqli_query($conn,$sqlRandomReview);
                                                            $viewRR = mysqli_fetch_assoc($resultRandomReview);
                                                            $RRDateAndTime = $viewRR["rev_date_submitted"]. " " .$viewRR["rev_time_submitted"];


                                                        ?>
                                                        <h5 class="header"><?php echo $viewRR["rev_account_username"] ?></h5>
                                                        <p>&#9733&#9733&#9733&#9733&#9733 <?php echo $overallScore; ?> </p>
                                                        <em>"<?php echo $viewRR["rev_comments"]; ?>"</em>
                                                        <p>Date submitted: <?php echo $RRDateAndTime; ?> </p>
                                                    </div>
                                                </div>
                                                <p class="text-center"><a href="#" class="white-color">Load more reviews</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END OF MODAL PACKAGES-->