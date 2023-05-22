
<div class="moreblack-bg-color p-3">
    <table id="menuItemsTable" class="table table-hover ">
    <button type="button" class="btn btn-sm secondaryButton"><i class="fas fa-plus fa-lg"></i>  Add Menu Item</button>
        <tr>
            <th><a href="#" class="link white-color" onclick="sortTable(0,'menuItemsTable')">Name</a></th>
            <th><a href="#" class="link white-color" onclick="sortTable(1,'menuItemsTable')">Package</a></th>
            <th><a href="#" class="link white-color" onclick="sortTable(2,'menuItemsTable')">Category</a></th>
            <th><a href="#" class="link white-color" onclick="sortTable(3,'menuItemsTable')">Order Count</th>
            <th><a href="#" class="link white-color" onclick="sortTable(4,'menuItemsTable')">Price</a></th>
        </tr>
    <?php
        //fetch package content items
        $sqlGetPackageContent = "select * from package_contents order by pcont_ordercounter desc";
        $resultGetPackageContent = mysqli_query($conn,$sqlGetPackageContent);
        while($viewGPC = mysqli_fetch_array($resultGetPackageContent)){
    ?>
        <tr>
            <td>
                <?php
                    if(strlen($viewGPC["pcont_name"]) > 20){
                        echo substr($viewGPC["pcont_name"],0,20)."...";
                    }else{
                        echo $viewGPC["pcont_name"];
                        
                    }
                ?>
            </td>
            <td>
                <?php echo getPackage($conn,$viewGPC["pcont_package_id"])["package_name"]?>
            </td>
            <td><?php echo getCategoryDetails($conn,$viewGPC["pcont_category_id"])["cat_name"]?></td>
            <td><?php echo $viewGPC["pcont_ordercounter"];?></td>
            <td><?php echo $viewGPC["pcont_price"];?></td>
        </tr>
    <?php
        }
    ?>
        
    </table>
</div>