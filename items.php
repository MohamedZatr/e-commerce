<?php
/********************************************************
        ---------------------------------------
        |           Items Page                |
        ---------------------------------------
********************************************************/
ob_start(); // OutPut Buffering Start
session_start();
if(isset($_SESSION['username']))
{
    include 'preperdata.php' ;    
    $pageTitle = lang('MANGE_ITEMS');
        include "init.php";
    // Chech do is set 
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
   // check value of do
    if($do == 'Manage'){ 
        $query = '';
        if(isset($_GET['state']) && $_GET['state'] == 'Approve')
        {
            $query = " WHERE Approve = 0 ";
        }
                    try{
                        $stmt = $con->prepare("SELECT 
                                                    items.*, categories.Name As CatName, users.UserName
                                               From 
                                                        items 
                                               INNER JOIN 
                                                        categories 
                                               ON 
                                                        categories.Cat_ID = items.Cat_ID 
                                              INNER JOIN 
                                                        users 
                                              ON 
                                                        users.UserID = items.Member_ID");
                        $stmt->execute();
                        $data = $stmt->fetchAll();?>

<!-- Create Table To Display Items -->

<h1 class="text-center"><?php echo lang('MANAGE_ITEMS') ?></h1>
<div class="contanier">
<div class='col-sm-3 col-sm-10'><a href='items.php?do=Add' class ='btn btn-primary additem' ><i class = 'fa fa-plus'></i>Add Item</a> </div>
    <table class="main-table text-center tbl table table-bordered">
        <tr>
            <!--<td><?php /*echo lang('ITEMS_ID');*/?></td>-->
            <td><?php echo lang('ITEMS_NAME');?></td>
            <td><?php echo lang('ITEMS_DESCRIP');?></td>
            <td><?php echo lang('ITEMS_PRICE');?></td>
            <td><?php echo lang('ITEMS_DATE');?></td>
            <td><?php echo lang('ITEMS_CONTRY');?></td>
            <td><?php echo lang('ITEMS_STATUS');?></td>
            <td><?php echo lang('ITEMS_RATING');?></td>
            <td><?php echo lang('ITEMS_CATEGORY');?></td>
            <td><?php echo lang('ITEMS_MEMBER');?></td>
            <td><?php echo lang('CONTROLE');?></td>
        </tr>
  
                        <?php
                        
                        foreach($data as $record){
                            echo "<tr>";                            
                            //echo "<td>" .$record['Item_ID']."</td>";                            
                            echo "<td>" .$record['Name']."</td>";
                            echo "<td>" .$record['Description']."</td>";
                            echo "<td>" .$record['Price']."</td>";
                            echo "<td>" .$record['Add_Date']."</td>";
                            echo "<td>" .$record['Country_Made']."</td>";
                            if($record['Status'] == 1){
                                echo "<td>".lang('ITEM_NEW')."</td>";
                            }elseif($record['Status'] == 2){
                                echo "<td>".lang('ITEM_LIKE_NEW')."</td>";
                            }elseif($record['Status'] == 3){
                                echo "<td>".lang('ITEM_USED')."</td>";
                            }elseif($record['Status'] == 4){
                                echo "<td>".lang('ITEM_OLD')."</td>";
                            }
                            
                            echo "<td>" .$record['Rating']."</td>";
                            
                            echo "<td>" .$record['CatName']. "</td>";
                            
                            echo "<td>" .$record['UserName']. "</td>";
                            
                            echo "<td><a href='items.php?do=edit&itemid=".$record['Item_ID']."' class = 'btn btn-success'><i class = 'fa fa-edit'></i> Edit</a>";
                            if($record['Approve'] == 0){
                            echo "<a href='items.php?do=Approve&itemid=".$record['Item_ID']."' class = 'btn btn-info'><i class = 'fa fa-check'></i> Approve</a>";}
                            echo"<a href='items.php?do=delete&itemid=".$record['Item_ID']."' class = 'btn btn-danger confirm_category '><i class = 'fa fa-close '></i> Delete</a></td>";
                            
                                                                
                            
                            echo "</tr>";
                            
                        }
                        echo "  </table> </div>";
                        /*echo "<div class='col-sm-3 col-sm-10'><a href='items.php?do=Add' class ='btn btn-primary additem' ><i class = 'fa fa-plus'></i>Add Item</a> </div>";*/
                       }catch(Exception $e){
                                                echo "<div class = 'container'>";
                                                echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                                                echo "There is error:- " . $e->getMessage() . "</div>";
                                           }
        

}elseif($do == 'Add'){ 
?>
        <!-- Form To Insert Items -->
        <h1 class = "text-center">Add Item</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=Insert" method="POST">
                <!-- Start Name Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_NAME'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="<?php echo lang('ITEM_NAME'); ?>" autocomplete="off" required = "required"/>
                         </div>
                </div>
                <!-- End Name Feild -->
                 <!-- Start Description Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_DESCRIP'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                                <input type="text" name="description" class="form-control" placeholder="<?php echo lang('ITEM_DESCRIP'); ?>" autocomplete="off" required = 'required'/>
                         </div>
                </div>
                <!-- End Description Feild -->
                <!-- Start Price Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_PRICE'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                                <input type="text" name="price" class="form-control" placeholder="<?php echo lang('ITEM_PRICE'); ?>" autocomplete="off" required = "required"/>
                         </div>
                </div>
                <!-- End Price Feild -->
                <!-- Start Country Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_COUNTRY'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                                <input type="text" name="country" class="form-control" placeholder="<?php echo lang('ITEM_COUNTRY'); ?>" autocomplete="off" required = 'required'/>
                         </div>
                </div>
                <!-- End Country Feild -->
                <!-- Start Member Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_STATUS'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                               <select name="status">
                                <option value="0">....</option>                             
                                <option value="1"><?php echo lang('ITEM_NEW'); ?></option>
                                <option value="2"><?php echo lang('ITEM_LIKE_NEW'); ?></option>
                                <option value="3"><?php echo lang('ITEM_USED'); ?></option>
                                <option value="4"><?php echo lang('ITEM_OLD'); ?></option>
                               </select>
                         </div>
                </div>
                <!-- End Member Feild -->
                <!-- Start Category Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_MRMBER'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                               <select name="member">
                                <option value="0">....</option>  
                                <?php 
                              try{
                                    // get Users To Add int table item this user who add this item 
                                    $stmt = $con->prepare("SELECT UserID,UserName  FROM users WHERE 	RegStatus = 1 ORDER BY UserID");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                  }catch(Exception $e){
                                    echo "<div class = 'container'>";
                                                echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                                                echo "There is error:- " . $e->getMessage() . "</div>";
                                                        }

                                foreach($result as $value){
                                echo "<option value='" .$value['UserID']. "'>" .$value['UserName']."</option>"; 
                                }
                                   ?>
                               </select>
                         </div>
                </div>
                <!-- End Category Feild -->
                <!-- Start Status Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_CATEGORY'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                               <select name="category">
                                <option value="0">....</option>  
                                 <?php 
                              try{
                                    // Get All Category the Category for the item we add
                                    $stmt = $con->prepare("SELECT Cat_ID,Name  FROM categories ORDER BY Cat_ID");
                                    $stmt->execute();
                                    $categories = $stmt->fetchAll();
                                  }catch(Exception $e){
                                    echo "<div class = 'container'>";
                                                echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                                                echo "There is error:- " . $e->getMessage() . "</div>";
                                                        }

                                foreach($categories as $category){
                                echo "<option value='" .$category['Cat_ID']. "'>" .$category['Name']."</option>"; 
                                }
                                   ?>                            
                               </select>
                         </div>
                </div>
                <!-- End Status Feild -->
                <!-- Start Submit Button -->
                    <div class="form-group form-group-lg">
                        <div class = "col-sm-offset-3 col-sm-10">
                            <input type="submit" value="Add Item" class="btn btn-primary btn-lg" />
                        </div>
                    </div>
                <!-- End Submit Buton -->
                
            </form>
        </div>
<?php    }elseif($do == 'Insert'){
                // Check the user Comming from reqest or directly 
                if($_SERVER['REQUEST_METHOD'] == 'POST')
                {
                    echo "<div class = 'container'>";
                    echo "<h1 class = 'text-center'> Insert Item</h1>";
                    // Get The Data From POST Request
                    $name               = $_POST['name'];                    
                    $description        = $_POST['description'];
                    $price              = $_POST['price'];
                    $country            = $_POST['country'];
                    $status             = $_POST['status'];
                    $member             = $_POST['member'];
                    $category           = $_POST['category'];
                   
                    // Create this array To collect the error forms and display this error
                    $formErrors = array();
                    //chech Name is Empty Or Not
                    if(empty(trim($name))){
                        $formErrors[] = lang('NAME_EMPTY');
                    }
                    //chech Description is Empty Or Not
                    if(empty(trim($description))){
                        $formErrors[] = lang('DESCRITION_EMPTY');
                    }
                    //chech Price is Empty Or Not
                    if(empty(trim($price))){
                        $formErrors[] = lang('PRICE_EMPTY'); 
                    }
                    //chech Country is Empty Or Not
                    if(empty(trim($country))){
                        $formErrors[] = lang('COUNTRY_EMPTY');                  
                    }
                    
                     //chech Name is Less than 4 Charcter
                    if(strlen(trim($name) ) < 4){
                        $formErrors[] = lang('NAME_NUM_CHAR');
                    }
                    //chech Description is Less than 10 Charcter
                    if(strlen(trim($description)) < 10){
                        $formErrors[] = lang('DESCRITION_NUM_CHAR');
                    }
                    
                    //chech the User Chooss status or not
                    if($status == 0){
                        $formErrors[] = lang('STATUS');
                    }
                    //chech the User Chooss Member or not
                    if($member == 0){
                        $formErrors[] = lang('MEMBER_ERROR');
                    }
                    //chech the User Chooss Category or not
                    if($category == 0){
                        $formErrors[] = lang('CATEGORY_ERROR');
                    }
                    // this for display the error if it found 
                    foreach($formErrors as $error)
                    {
                        echo "<div class = 'alert alert-danger'>" .$error. "</div>";
                    }
                    // chech there are no error we insert the item
                    if(empty($formErrors))
                    {
                        try{
                            // query to insert the item
                            $stmt = $con->prepare("INSERT INTO 
                                            items(Name,Description,Price
                                            ,Add_Date,Country_Made,Status,Cat_ID,Member_ID)
                                            VALUES(:name,:descrip,:price,now(),:contry,:statu,:category,:member)
                                            ");
                            // passing parameter to query
                            $stmt->execute(array(
                                'name'      => $name,                       
                                'descrip'   => $description,
                                'price'     => $price,
                                'contry'    => $country,
                                'statu'     => $status,
                                'category'  => $category,
                                'member'    => $member

                            ));
                            //Message if Success
                                $Msg =  "<div class = 'alert alert-success'><strong>" . $stmt->rowCount() ." ". lang('SUCCESS_INSERT') . "</strong></div>";
                            // redierct function to rediect the user Automatic
                            redirectHome($Msg,'back'); 
                           }catch(Exception $e){
                            echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>";
                            }
                    }
                    
                    
                }else{
                    // this display if user go directly link
                    echo "<div class = 'container'>";
                    echo "<h1 class = text-center>Error!</h1>";
                    $Msg = "<div class = 'alert alert-danger'>".lang('NO_PERMISSION')."</div>";
                    // redierct function to rediect the user Automatic
                    redirectHome($Msg,'back');                        
                    echo "</div>";
                   
                }
    }elseif($do == 'edit'){
        // check the id of item we esit is integer or Not
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
        // this function check this item we edit is found or Not 
        if(!checkItem("Item_ID", "items",$itemid)){
        try{
            // query to get the data of item we edit
            $stmt = $con->prepare("SELECT * FROM items WHERE Item_ID = ?");
            $stmt->execute(array($itemid));
            $item = $stmt->fetch();
            ?>
        <!--this fotm to display data of item we can edit-->
        <h1 class = "text-center">Update Item</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=Update&itemid=<?php echo $itemid;?>" method="POST">
                <!-- Start Name Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_NAME'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                                <input type="text" name="name" value="<?php echo $item['Name']?>" class="form-control" placeholder="<?php echo lang('ITEM_NAME'); ?>" autocomplete="off" required = "required"/>
                         </div>
                </div>
                <!-- End Name Feild -->
                 <!-- Start Description Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_DESCRIP'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                                <input type="text" name="description" value="<?php echo $item['Description'];?>"  class="form-control" placeholder="<?php echo lang('ITEM_DESCRIP'); ?>" autocomplete="off" required = 'required'/>
                         </div>
                </div>
                <!-- End Description Feild -->
                <!-- Start Price Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_PRICE'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                                <input type="text" name="price" value="<?php echo $item['Price'];?>" class="form-control" placeholder="<?php echo lang('ITEM_PRICE'); ?>" autocomplete="off" required = "required"/>
                         </div>
                </div>
                <!-- End Price Feild -->
                <!-- Start Country Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_COUNTRY'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                                <input type="text" name="country" value="<?php echo $item['Country_Made'];?>" class="form-control" placeholder="<?php echo lang('ITEM_COUNTRY'); ?>" autocomplete="off" required = 'required'/>
                         </div>
                </div>
                <!-- End Country Feild -->
                <!-- Start Member Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_STATUS'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                               <select name="status">
                                <option value="0">....</option>                             
                                <!--chech the status comming from data base and select it-->
                                <option <?php if($item['Status'] == 1) { echo "Selected";} ?> value="1"><?php echo lang('ITEM_NEW'); ?></option>
                                <option <?php if($item['Status'] == 2 ){echo "Selected";} ?> value="2"><?php echo lang('ITEM_LIKE_NEW'); ?></option>
                                <option <?php if($item['Status'] == 3){ echo "Selected";} ?> value="3"><?php echo lang('ITEM_USED'); ?></option>
                                <option <?php if($item['Status'] == 4 ) {echo "Selected";} ?> value="4"><?php echo lang('ITEM_OLD'); ?></option>
                               </select>
                         </div>
                </div>
                <!-- End Member Feild -->
                <!-- Start Category Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_MRMBER'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                               <select name="member">
                                <?php 
                              try{
                                // get All Member From data Base
                                    $stmt = $con->prepare("SELECT UserID,UserName  FROM users WHERE 	RegStatus = 1 ORDER BY UserID");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                  }catch(Exception $e){
                                    echo "<div class = 'container'>";
                                                echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                                                echo "There is error:- " . $e->getMessage() . "</div>";
                                                        }
                             //chech the member comming from data base and select it
                                foreach($result as $value){
                                echo "<option ";
                                    if($item['Member_ID'] == $value['UserID']){
                                        echo " Selected ";
                                    }
                                    
                                    
                                    echo "value='" .$value['UserID']. "'>" .$value['UserName']."</option>"; 
                                }
                                   ?>
                               </select>
                         </div>
                </div>
                <!-- End Category Feild -->
                <!-- Start Status Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('ITEM_CATEGORY'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                               <select name="category">
                                 <?php 
                              try{
                                    // get All Category From data Base
                                    $stmt = $con->prepare("SELECT Cat_ID,Name  FROM categories ORDER BY Cat_ID");
                                    $stmt->execute();
                                    $categories = $stmt->fetchAll();
                                  }catch(Exception $e){
                                    echo "<div class = 'container'>";
                                                echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                                                echo "There is error:- " . $e->getMessage() . "</div>";
                                                        }
                             //chech the category comming from data base and select it
                                foreach($categories as $category){
                                echo "<option ";
                                    if($item['Cat_ID'] == $category['Cat_ID']){
                                        echo " Selected ";
                                    }
                                    echo "value='" .$category['Cat_ID']. "'>" .$category['Name']."</option>"; 
                                }
                                   ?>                            
                               </select>
                         </div>
                </div>
                <!-- End Status Feild -->
                <!-- Start Submit Button -->
                    <div class="form-group form-group-lg">
                        <div class = "col-sm-offset-3 col-sm-10">
                            <input type="submit" value="Save Item" class="btn btn-primary btn-lg" />
                        </div>
                    </div>
                <!-- End Submit Buton -->
                
            </form>
        </div>
    <?php    }catch(Exception $e){
                            echo "<div class = 'container'>";
                            echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                            echo "There is error:- " . $e->getMessage() . "</div>";
        }
        }else{
            // this display erorr when User send it not found in database
                                                              echo "<div class = 'container'>";
                                                              echo "<h1 class = 'text-center'> Error! </h1>" ;
                                                              $Msg =  "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
                                                              redirectHome($Msg,'back',6); 
                                                               echo "</div>";
    } 
        // Comment Mange Start 
        try{
                        $stmt = $con->prepare("SELECT comments.*,users.UserName FROM comments                        INNER JOIN 
                                                            users 
                                                ON 
                                                            users.UserID = comments.Member_ID 
                                                WHERE 	item_ID = ?");
                        $stmt->execute(array($itemid));
                        $comments = $stmt->fetchAll();
                    }catch(Exception $e){
                        
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>";
                    }

        if($stmt->rowCount() > 0){
        ?>
        <h1 class = "text-center"><?php echo lang('MANAGE_COMMENTS') ?>[<?php echo $item['Name']?>]</h1>                                                       

            <div class = "container">
                <div class = "table-responsive">
                    <table class = "main-table text-center table table-bordered">
                        <tr>
                            <td><?php echo lang('ADDBY_COMMENT')?></td>
                            <td><?php echo lang('COMMENT_COMMENT')?></td>
                            <td><?php echo lang('DATE_COMMENT')?></td>                          
                            <td><?php echo lang('CONTROLE')?></td>
                        </tr>
        
<?php  
                    foreach($comments as $comment){
                        echo "<tr>";
                         echo "<td>".$comment['UserName']."</td>";
                        echo "<td>".$comment['Comment']."</td>";
                        echo "<td>".$comment['Add_Date']."</td>";
                        echo "<td><a class = 'btn btn-success'
                              href = 'comment.php?do=edit&comid=".$comment['Com_ID']."'><i class = 'fa fa-edit'></i> Edit</a>";
                            if($comment['status'] == 0){
                                echo "<a class = 'btn btn-info'
                              href = 'comment.php?do=Approve&comid=".$comment['Com_ID']."'><i class = 'fa fa-check'></i> Approve</a>";
                            }
                            
                          echo  "<a class = 'btn btn-danger comforim_comment'
                              href = 'comment.php?do=delete&comid=".$comment['Com_ID']."'><i class = 'fa fa-close'></i> Delete</a></td> </tr>";
                    }
                        echo "</table> </div> </div>";// Comment Manage End
        }
        
    }elseif($do == 'Update'){
         // Check the user Comming from reqest or directly 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo "<div class = 'container'>";
            // check the id of item we esit is integer or Not      
            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ?intval($_GET['itemid']) : 0;
                    // Get data From POST Request 
                    $name               = $_POST['name'];                    
                    $description        = $_POST['description'];
                    $price              = $_POST['price'];
                    $country            = $_POST['country'];
                    $status             = $_POST['status'];
                    $member             = $_POST['member'];
                    $category           = $_POST['category'];
                   
                    // Create this array To collect the error forms and display this error
                    $formErrors = array();
                    //chech Name is Empty Or Not
                    if(empty(trim($name))){
                        $formErrors[] = lang('NAME_EMPTY');
                    }
                    //chech Description is Empty Or Not
                    if(empty(trim($description))){
                        $formErrors[] = lang('DESCRITION_EMPTY');
                    }
                    //chech Price is Empty Or Not
                    if(empty(trim($price))){
                        $formErrors[] = lang('PRICE_EMPTY'); 
                    }
                    //chech Country is Empty Or Not
                    if(empty(trim($country))){
                        $formErrors[] = lang('COUNTRY_EMPTY');                  
                    }
                    
                     //chech Name is Less than 4 Charcter
                    if(strlen(trim($name) ) < 4){
                        $formErrors[] = lang('NAME_NUM_CHAR');
                    }
                    //chech Description is Less than 10 Charcter
                    if(strlen(trim($description)) < 10){
                        $formErrors[] = lang('DESCRITION_NUM_CHAR');
                    }
                    if(!empty($formErrors)){
                        echo "<h1 class ='text-center'>Error !</h1>";
                    }
                    foreach($formErrors as $error)
                    {
                        echo "<div class = 'alert alert-danger'>" .$error. "</div>";
                    }
    // if thear No Error
        if(empty($formErrors)){
                         echo "<h1 class = \"text-center\">Update Item</h1>";
        //if this item is found in database we can Update it
        if(!checkItem("Item_ID", "items",$itemid)){
            try{
                // query to update item
                $stmt = $con->prepare("UPDATE 
                                              items
                                        SET 
                                             Name = :name,
                                             Description = :desrip,
                                             Price = :price,
                                             Country_Made = :contry,
                                             Status = :state,
                                             Cat_ID = :category,
                                             Member_ID = :user
                                        WHERE Item_ID = :id");
                // bind paramerters to query
                $stmt->execute(array(
                        'name'           => $name,                        
                        'desrip'         => $description,
                        'price'          => $price,
                        'contry'         => $country,
                        'state'          => $status,
                        'category'       =>  $category,
                        'user'           =>  $member,
                        'id'             =>  $itemid

                ));
                //Message if Success
                            
                                $Msg =  "<div class = 'alert alert-success'><strong>" . $stmt->rowCount() ." ". lang('SUCCESS_UPDATE') . "</strong></div>";
                            // redierct function to rediect the user Automatic
                            redirectHome($Msg,'back'); 
                echo "</div>";
               
            }catch(Exception $e){
                 // this display error if there are problem in database
                            echo "<div class = 'container'>";
                            echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                            echo "There is error:- " . $e->getMessage() . "</div>";
            }
            
        }else{
             // this display if this item is Not found in database
              echo "<div class = 'container'>";
              echo "<h1 class = 'text-center'> Error! </h1>" ;
              $Msg =  "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
              redirectHome($Msg,'back',6); 
               echo "</div>";   
        }
     }
    }else{
             // this display if user go directly link
                    echo "<div class = 'container'>";
                    echo "<h1 class = text-center>Error!</h1>";
                    $Msg = "<div class = 'alert alert-danger'>".lang('NO_PERMISSION')."</div>";
                    redirectHome($Msg,'back');                        
                    echo "</div>";
        }
    }elseif($do == 'delete'){
        // check the id of item we esit is integer or Not
            $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;      
            //if this item is found in database we can Delete it
            if(!checkItem("Item_ID", "items",$itemid)){
                try{
                    echo "<h1 class = 'text-center'>Delete Item</h1>";
                    echo "<div class = 'container'>";
                    // query to delete item
                    $stmt = $con->prepare("DELETE FROM
                                                        items 
                                                  WHERE 
                                                Item_ID = ?");
                    // pass the paramter to query
                    $stmt->execute(array($itemid));
                //Message if Success
                            
                                $Msg =  "<div class = 'alert alert-success'><strong>" . $stmt->rowCount() ." ". lang('SUCESS_DELETE') . "</strong></div>";
                                // redierct function to rediect the user Automatic
                                    redirectHome($Msg,'back'); 
                                    echo "</div>";
                    
                }catch(Exception $e){
                            echo "<div class = 'container'>";
                            echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                            echo "There is error:- " . $e->getMessage() . "</div>";
                }
                
                    }else{
                        // this display if this item is Not found in database
                         echo "<div class = 'container'>";
                         echo "<h1 class = text-center>Error!</h1>";
                         $Msg = "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
                        // redierct function to rediect the user Automatic 
                        redirectHome($Msg,'back');                        
                         echo "</div>";
                    }
    }elseif($do == "Approve"){
        // check the id of item we esit is integer or Not
        $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']):0;
        //if this item is found in database we can Delete it
            if(!checkItem("Item_ID", "items",$itemid)){
                try{
                    echo "<h1 class = 'text-center'>Approve Item</h1>";
                    echo "<div class= 'container'>";
                    $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID =?");
                    $stmt->execute(array($itemid));
                    //Message if Success
                            
                                $Msg =  "<div class = 'alert alert-success'><strong>" . lang('SUCESS_ACTIVE_ITEM') . "</strong></div>";
                                // redierct function to rediect the user Automatic
                                    redirectHome($Msg,'back'); 
                                    echo "</div>";
                    
                }catch(Exception $e){
                            echo "<div class = 'container'>";
                            echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                            echo "There is error:- " . $e->getMessage() . "</div>";
                }
            }else{
                        // this display if this item is Not found in database
                         echo "<div class = 'container'>";
                         echo "<h1 class = text-center>Error!</h1>";
                         $Msg = "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
                        // redierct function to rediect the user Automatic 
                        redirectHome($Msg,'back');                        
                         echo "</div>";
            }
    }
// ffoter of the page
  include $tpl . "footer.php";
                               }else{
    // redierct user if the user go dirct to this page with out login
    header("Location: index.php");
    exit();
}
 ob_end_flush();// Realese the Out put;
?>