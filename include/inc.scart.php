<?php
    session_start();
    require_once "inc.dbconnect.php";
    include "functions.php";    

    /* add packages to cart */
    if(isset($_REQUEST["packid"])){
        $packid = $_REQUEST["packid"];
        $package = getPackage($conn,$packid);
        
        $cartdata = array(
            "id" => $package["package_id"],
            "name" => $package["package_name"],
            "quantity" => "1",
            "price" => $package["package_price"],
            "category" => $package["package_category"],
            "type"=>"Package"
        );

        
        
        $cartid = array_column($_SESSION["ses_cart"],"id");
        $cartqty = array_column($_SESSION["ses_cart"],"quantity");
        
        if(in_array($packid,$cartid)){
            echo "Item already exists";
            exit();
        }else{
            $_SESSION["ses_cart"][] = $cartdata;
            var_dump($_SESSION["ses_cart"]);
            exit();
        }
        
    }
 
    /* ADD PACKAGE TO CART (note that this is very different from adding menu items) */

    /*ADD ALL TO CART BUTTON - add all ITEM fields to the cart*/
    if(isset($_POST["btnAddAllToCart"])){
        //MAY NAGUUNSET NG VALUE DITO KAMO
        if(isset($_POST["txtQty"]) && $_POST["txtQty"] != null){
            if(isset($_SESSION["ses_cart"])){
                foreach($_POST["txtQty"] as $keys => $data){
                    $catid = $_POST["hidPID"][$keys];//id of the given item
                    $name = $_POST["hidPName"][$keys]; //name of item
                    $categoryID = $_POST["hidPCID"][$keys]; //category id of item
                    $qty = $data;//quantity of an item
                    $categoryName = getCategoryDetails($conn,$categoryID)["cat_name"]; //name of category
                    $itemPrice = getItemInfoById($conn,$catid)["pcont_price"];
                    $wast = getItemInfoById($conn,$catid)["pcont_name"];
                    $totalPrice = $itemPrice * $qty;
                    /* 
                    echo "ID = ".$catid;
                    echo "<br>";
                    echo "Name = ".$name;
                    echo "<br>";
                    echo "Category ID: ".$catid;
                    echo "<br>";
                    echo "Category Data: ".$categoryName;
                    echo "<br>";
                    echo "Quantity = ".$qty;
                    echo "<br>";
                    echo "Item Price = ". $itemPrice;
                    echo "<br>";
                    echo "Total Price: ".$totalPrice;
                    echo "<br>"; */
                    if($data != null){
                        
                        $cartdata = array(
                            "id"=>$catid,
                            "name"=>$name,
                            "quantity"=>$qty,
                            "price"=> $totalPrice,
                            "category"=>$categoryName,
                            "type"=>"Item"
                        );

                        $cartid = array_column($_SESSION["ses_cart"],"id");
                        $cartQuantity = array_column($_SESSION["ses_cart"],"quantity");

                        if(in_array($catid,$cartid)){
                            foreach($_SESSION["ses_cart"] as $keys => $cartValue){
                                if($cartValue["name"] == $name){
                                    if($cartValue["quantity"] == $qty){
                                        echo "same value!";
                                    }else{
                                        $_SESSION["ses_cart"][$keys]["quantity"] = $qty;
                                        $_SESSION["ses_cart"][$keys]["price"] = $totalPrice;
                                        echo "success value!";
                                    }
                                }else{
                                    echo "no";
                                }
                            }
                        }else{
                            $_SESSION["ses_cart"][] = $cartdata;
                            echo "success";
                        }
                    }else{
                        echo "empty";
                        //header("location: ../menulist.php?cat=".$catid);
                    }
                }
                
            }else{
                echo "There seems to be an error in fetching your cart! Contact your programmer!";
            }
            header("location: ../menulist.php?cat=".$categoryID);
        }else{
            echo "null";
        }
        //var_dump($_SESSION["ses_cart"]);
    }

    /*ADD TO CART BUTTON (SUBMIT BUTTON) - add a single ITEM to the cart*/
    if(isset($_REQUEST["pcontname"]) && isset($_REQUEST["pcontid"]) && isset($_REQUEST["pqty"]) && isset($_REQUEST["price"]) && isset($_REQUEST["category"])){
        $id = $_REQUEST["pcontid"];
        $name = $_REQUEST["pcontname"];
        $qty = $_REQUEST["pqty"];
        $price = $_REQUEST["price"];
        $category = $_REQUEST["category"];
        $categoryName = getCategoryDetails($conn,$category)["cat_name"];
        if($id == null || $qty == null || $price== null){
            echo "One of the inputs is/are empty. Check your form or contact the developer for more info!";
        }else{
            $cartdata = array(
                "id"=>$id,
                "name"=>$name,
                "quantity"=>$qty,
                "price"=>$price,
                "category"=>$categoryName,
                "type"=>"Item"
                //ADD KEY: TYPE: EITHER ITEM OR PACKAGE
            );
            
            //tinawag yung mga keys ng array inside each array
            //woo dugo na utak ko hahaha
            $cartid = array_column($_SESSION["ses_cart"],"id");
            $cartqty = array_column($_SESSION["ses_cart"],"quantity");            
            
            if(in_array($id,$cartid)){
                foreach($_SESSION["ses_cart"] as $keys => $cartValue){
                    if($cartValue["name"] == $name){
                        if($cartValue["quantity"] == $qty){
                            echo "same value!";
                            break;
                        }else{
                            $_SESSION["ses_cart"][$keys]["quantity"] = $qty;
                            $_SESSION["ses_cart"][$keys]["price"] = $price;
                            echo "success value!";
                            break;
                        }
                    }else{
                        echo "no";
                    }
                }
                
            }else{
                $_SESSION["ses_cart"][] = $cartdata;
                echo "success";
                header("location: ../menulist.php?cat=".$category);
            }
        }
    }
    
    /*DELETE FROM CART BUTTON - add a single ITEM to the cart*/
    if(isset($_POST["btnDeleteCartItem"]) and isset($_POST["chkbox"])){
        if(isset($_POST["chkbox"])){
            $checkboxes = $_POST["chkbox"];
            foreach($checkboxes as $cbid){
                echo $cbid;
                foreach($_SESSION["ses_cart"] as $keys => $value){
                    if($_SESSION["ses_cart"][$keys]["id"] == $cbid){
                        echo $_SESSION["ses_cart"][$keys]["name"];
                        unset($_SESSION["ses_cart"][$keys]);
                    }
                }
            }
            header("location: ../order.php?item=deleted");
        }else{
            header("location: ../order.php?item=fetchfailed");
            //add error handler
        }
    }else{
        header("location: ../order.php?item=404");
    }

    /*clear shoppingcart */
    if(isset($_REQUEST["btn"]) && $_REQUEST["btn"] == "deletecartundercat"){
        if(!empty($_SESSION["ses_cart"])){
            unset($_SESSION["ses_cart"]);
            echo "shopping cart cleared";
            header("location: ../menulist.php?cat=". $_REQUEST["id"]);
        }
    }else if(isset($_REQUEST["btn"]) && $_REQUEST["btn"] == "deletecart"){
        if(!empty($_SESSION["ses_cart"])){
            unset($_SESSION["ses_cart"]);
            echo "shopping cart cleared";
            header("location: ../index.php");
        }
    }
    echo "<hr/>";
    echo "<h1>Cart data:</h1>";
    echo "<p>The following scribed below has nothing to do with the code that you're editing. This only shows that you only have access to the file that you are editing, so congratulations. You desever a beer or two. :D</p>";
    echo "<pre>";
    print_r($_SESSION["ses_cart"]);
    echo "</pre>";
    
?>