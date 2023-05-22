<?php
    session_start();
    require "include/inc.dbconnect.php";
    include "include/functions.php";
    //include "include/inc.scart.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Menu List | QWERTY Catering</title>

        <?php topLinks();?>

	</head>
	<body>`
    
        <?php topLinks(); include "include/components/templates/lib.navbar.comp.php"?>

		<div class="wrapper">
			<div class="container">
                
                <!--sub menu list-->
                <div id="sub-menu-list">
                    <?php
                        if(isset($_REQUEST["cat"]) || $_REQUEST["cat"] != ""){
                            $packcontid = $_REQUEST["cat"];
                            $sqlMenuList = "select * from categories where cat_id = '$packcontid'";
                            $resultMenuList = mysqli_query($conn,$sqlMenuList);
                            if($viewML = mysqli_fetch_array($resultMenuList)){
                    ?>
                    <button type="button" class="btn btn-secondary active" onclick="window.history.back()">Go back</button>
                    <h2 class="text-center headerr"><?php echo $viewML["cat_name"]?></h2>
                    <div class="featured-image-slot">
                        <img src="assets/db/categories/<?php echo $viewML["cat_image"]?>" >
                    </div>
                    
                    
                    
                    <p id="errorHandlerMessage"></p>
                    
                    <form action="include/inc.scart.php" method="post">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                            <?php
                                $sqlMenu = "select * from package_contents where pcont_category_id = '".$_REQUEST["cat"]."' group by pcont_name";
                                $result = mysqli_query($conn,$sqlMenu);

                                while($viewCatContent = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $viewCatContent["pcont_name"]; ?></td>
                                <td><?php echo number_format($viewCatContent["pcont_price"]); ?></td>
                                
                                <input type="hidden" name="hidPID[]" value="<?php echo $viewCatContent["pcont_id"]?>">
                                <input type="hidden" name="hidPName[]" value="<?php echo $viewCatContent["pcont_name"]?>">
                                <input type="hidden" name="hidPCID[]" value="<?php echo $viewCatContent["pcont_category_id"]?>">
                                <td>   X   <input id="qtyBox_<?php echo $viewCatContent["pcont_id"]?>" class="inputForm" type="text" name="txtQty[]" maxlength="2" style="width: 50px" pattern="[0-9]" onchange="getTotalPrice(<?php echo $viewCatContent["pcont_id"]?>,<?php echo $viewCatContent["pcont_price"]?>)"/>   =   <span id="totalPrice_<?php echo $viewCatContent["pcont_id"]?>"></span> PHP</td>
                                <td><button id="btnAdd_<?php echo $viewCatContent["pcont_id"]?>" type="button" class="btn primaryButton" onclick="addToCart('<?php echo $viewCatContent["pcont_id"]?>', '<?php echo $viewCatContent["pcont_name"]?>','<?php echo $viewCatContent["pcont_price"]?>')" disabled>+ Add To Cart</button></td>
                                
                            </tr>
                            
                            <?php
                                }
                                ?>
                        </table>
                        <button id="clearCartButton" type="button" class="btn dangerButton" onclick="clearSCart(<?php echo $_REQUEST["cat"];?>)">Clear Cart</button>
                        <button type="submit" name="btnAddAllToCart" class="btn primaryButton" onclick="addAllToCart()">Add All To Cart</button>
                            
                        <pre id="phpoutput"><?php var_dump($_SESSION["ses_cart"]);?></pre>
                        <script>

                            // function addAllToCart(){
                            //     window.alert("Added all to cart!");
                            //     var xhttp = new XMLHttpRequest();
                            //     xhttp.onreadystatechange = function(){
                            //         if(this.readyState == 4 && this.status == 200){
                            //             console.log(this.responseText);
                            //             //var response = xhttp.responseText;
                            //             //window.location.reload();
                            //             //window.open("include/inc.scart.php?&pcontid="+ pcontid +"&pcontname="+pcontname+"&pqty="+orderQuantity + "&price="+totalPrice,"_self");
                            //         }
                            //     }
                            //     xhttp.open("GET","include/inc.scart.php?btn=addalltocart&cat=<?php echo $_REQUEST["cat"]?>",true);
                            //     xhttp.send();
                            // }
                            

                            /* function to add something to the cart */
                            function addToCart(pcontid,pcontname,pcontprice){
                                var orderQuantity = document.getElementById("qtyBox_"+pcontid).value;
                                var totalPrice = document.getElementById("totalPrice_"+pcontid).innerHTML;
                                //window.location.reload();
                                //window.alert("function addToCart");
                                //document.getElementById("errorMessage").innerHTML = "<div class='alert alert-danger''>Set a quantity for <b>"+pcontname+"</b> </div>";                                    
                                
                                if(orderQuantity === ""){
                                    document.getElementById("errorHandlerMessage").innerHTML = "<div class='alert alert-danger''>Set a quantity for <b>"+pcontname+"</b> </div>";                                    
                                }else{
                                    window.alert("Added item to cart!");
                                    //window.alert("its working");
                                    //console.log("ajax working fine "+pcontid + " " + orderQuantity);
                                    var xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function(){
                                        if(this.readyState == 4 && this.status == 200){
                                            //console.log("ajax working fine "+pcontid + " " + orderQuantity);
                                            //var response = xhttp.responseText;
                                            //console.log(response);
                                            window.location.reload();
                                            //window.open("include/inc.scart.php?&pcontid="+ pcontid +"&pcontname="+pcontname+"&pqty="+orderQuantity + "&price="+totalPrice,"_self");
                                        }
                                    }
                                    xhttp.open("GET","include/inc.scart.php?pcontid="+ pcontid +"&pcontname="+pcontname+"&pqty="+orderQuantity + "&price="+totalPrice+ "&category=<?php echo $_REQUEST["cat"]?>",true);
                                    xhttp.send();
                                }
                            }

                            /*function to clear the cart session variable*/
                            function clearSCart(pcontid){
                                window.alert("Cart cleared!");
                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function(){
                                    if(this.readyState == 4 && this.status == 200){
                                        window.location.reload();
                                        //window.open("include/inc.scart.php?&pcontid="+ pcontid +"&pcontname="+pcontname+"&pqty="+orderQuantity + "&price="+totalPrice,"_self");
                                    }
                                }
                                xhttp.open("GET","include/inc.scart.php?btn=deletecartundercat",true);
                                xhttp.send();
                            }
                            
                            /*function to get the total price of a product in realtime and enable button link*/
                            function getTotalPrice(pcontid,pcontprice){
                                var quantity = document.getElementById("qtyBox_"+pcontid).value;
                                var sum = pcontprice * quantity;
                                    document.getElementById("totalPrice_"+pcontid).innerHTML = sum;   
                                    
                                if(!document.getElementById("qtyBox_"+pcontid).value == ""){
                                    document.getElementById("btnAdd_"+pcontid).disabled = false;
                                    }else{
                                    document.getElementById("btnAdd_"+pcontid).disabled = true;
                                        
                                    }
                                //console.log(sum);
                                //console.log("Sum of food");
                            }
                            
                        </script>
                        

                    </form>
                    <?php
                            }
                        }else{
                    ?>
                    <div class="alert alert-info">
                        Whoops! Something's wrong! Go back please.
                    </div>
                    <?php
                        }
                    ?>
                      
                </div>
                
                
			</div>

		</div>
        <script src="vendors/js/snackbar.min.js"></script>
		<script src="vendors/js/bootstrap.min.js"></script>
	</body>
</html>