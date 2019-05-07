<?php

/*
--------------------------------------------------------------------
            Categories Page
--------------------------------------------------------------------
*/



ob_start();
session_start();
if(isset($_SESSION['username']))
{
    include "preperdata.php";
    $pageTitle = lang('CATEGORIES');
    include "init.php";
    $do = isset($_GET['do']) ? $_GET['do']:"Manage";
    if($do == 'Manage')
    {
        $sort = 'ASC';
        $sort_array = array('ASC','DESC');
        if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array))
        {
            $sort = $_GET['sort'];
        }
        $stmt = $con->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
        $stmt->execute();
        $result = $stmt->fetchAll();
        ?>

<div class="container catrgories">
    <h1 class="text-center"><?php echo lang('MANAGE_CAT');?></h1>
    <a class="btn btn-primary" href = 'categories.php?do=Add'><i class = 'fa fa-plus'></i> <strong>Add Category</strong></a>
    <div class="panel panel-defulte">
        <div class = "panel-heading">
            <i class = 'fa fa-edit' ></i> <?php echo lang('MANAGE_CAT');?>
            <div class="option pull-right">
            <i class = 'fa fa-sort'></i> Ordering: [
                <a class = "<?php if($sort == ASC) {echo 'active';}?>" href="?sort=ASC">ASC</a> |     
                <a class = "<?php if($sort == DESC) {echo 'active';}?>" href="?sort=DESC">DESC</a> ]
                <i class = 'fa fa-eye'></i> View: [  
                <span class = 'active' data-view = 'full'>Full</span> |     
                <span data-view = 'classic'>Classic</span> ]
            </div>   
        </div>
    <div class="panel-body">
        
        <?php 
         foreach($result as $value){
                            echo "<div class = 'cat'>";
                            echo "<div class = 'hidden-btn'>";
                                    echo "<a href='?do=edit&catid=".$value['Cat_ID']."' class = 'btn btn-success'><i class = 'fa fa-edit' ></i> Edit</a>";
                                    echo "<a href='?do=delete&catid=".$value['Cat_ID']."' class = 'btn btn-danger confirm_admin'><i class = 'fa fa-close' > Delete</i></a>";
                            echo"</div>";
                            echo "<h3><strong>"  . $value['Name']."</strong></h3>";
                    echo "<div class= 'full_view'>";
                            echo "<p><strong>"  ;
                            if($value['Description']==''){
                                echo "This Category Has No Description";
                            }else{echo $value['Description'];}  
                            echo "</strong></p>";
                            
             
                            if($value['Visibilty'] == 1){
                            echo "<span class = 'visibility'><i class='fa fa-eye'></i><strong> Hidden</strong></span>";}
             
             
                            if($value['Allow_Comment'] == 1){
                            echo "<span class = 'comment'><i class='fa fa-comment'></i><strong> NOT Allow</strong></span>";}
             
             
                            if($value['Allow_Ads'] == 1){
                                echo "<span class = 'ads' ><i class='fa fa-close '></i><strong> NOT Allow </strong></span>";}
                    echo "</div>";
                       echo "</div>";
                       echo "<hr>";
  
            }
        ?>
        </div>




    <?php 
   
 
    }elseif($do == 'Add')
    {?>
                 </div>
    </div>
  <h1 class="text-center">Add Categories</h1>
  <div class="container">
        
      <form class = "form-horizontal" action = "?do=Insert"  method = "POST">
          <!-- Start Cat_name Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_NAME');?></label>
                <div class = "col-sm-9 col-md-6">
                    <input type="text" name="cat_name" class="form-control" 
                                                autocomplete = "off" required = "required" placeholder="<?php echo lang('CAT_NAME');?>"/>                </div>
          </div>
          <!-- End Cat_name Field -->
          <!-- Start Cat_Decription Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_DESCRIOTION');?></label>
                <div class = "col-sm-9 col-md-6">
                    <input type="text" name="cat_descrip" class="form-control" 
                      placeholder="<?php echo lang('CAT_DESCRIOTION');?>"/>         
              </div>
          </div>
          <!-- End Cat_Decription Field -->
          <!-- Start Cat_Ordering Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_ORDERING');?></label>
                <div class = "col-sm-9 col-md-6">
                    <input type="text" name="ordering" class="form-control" 
                                                autocomplete = "off" placeholder="<?php echo lang('CAT_ORDERING');?>"/>                </div>
          </div>
          <!-- End Cat_Ordering Field -->
          <!-- Start Visibilt Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_VISIBILTY');?></label>
                <div class = "col-sm-9 col-md-6">
                        <div>
                            <input id="vis-yes" type="radio" name="visibilty" value="0" checked />
                            <label for="vis-yes" >Yes</label>
                        </div>
                        <div>
                            <input id="vis-no" type="radio" name="visibilty" value="1"  />
                            <label for="vis-no" >No</label>
                        </div>
              
                </div>
          </div>
          <!-- End Visibilty Field -->
          <!-- Start Comment Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_ALLOW_COMMENT');?></label>
                <div class = "col-sm-9 col-md-6">
                        <div>
                            <input id="com-yes" type="radio" name="comment" value="0" checked />
                            <label for="com-yes" >Yes</label>
                        </div>
                        <div>
                            <input id="com-no" type="radio" name="comment" value="1"  />
                            <label for="com-no" >No</label>
                        </div>
              
                </div>
          </div>
          <!-- End Comment Field -->
          <!-- Start ADs Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_ALLOW_ADS');?></label>
                <div class = "col-sm-9 col-md-6">
                        <div>
                            <input id="ads-yes" type="radio" name="ads" value="0" checked />
                            <label for="ads-yes" >Yes</label>
                        </div>
                        <div>
                            <input id="ads-no" type="radio" name="ads" value="1"  />
                            <label for="ads-no" >No</label>
                        </div>
              
                </div>
          </div>
          <!-- End ADs Field -->
          <!-- Start ADs Field -->
          <div class = "form-group form-group-lg">  
                <div class = "col-sm-offset-3 col-md-10">
                    <input class = "btn btn-primary btn-lg" type="submit" value="Add Category" />
                </div>
          </div>
          <!-- End ADs Field -->
        </form>
  </div>

<?php
    }elseif($do == 'Insert')
    {
        // Insert Category 
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            echo "<div class= 'container'>";
            echo "<h1 class = 'text-center'>Add Category</h1>";
            // get Date From Post Request
            $name               = $_POST['cat_name'];
            $descrip            = $_POST['cat_descrip'];
            $ordering           = $_POST['ordering'];
            $visibile           = $_POST['visibilty'];
            $allow_comment      = $_POST['comment'];
            $allow_ads          = $_POST['ads'];
            
            $form_error = array();
            if(empty(trim($name))){
                $form_error[] = lang('CN_EMPTY');
            }
            if(strlen($name) < 4){
                $form_error[] = lang('CN_LEGTH');
            }
            foreach($form_error as $error){
                    echo "<div class = 'alert alert-danger'>" . $error . "</div>" ;

            }
            
           if(empty($form_error)){
               //Check If The Category Exist In The DataBase
                if(checkItem("Name","categories",$name)){
                try{
                    //insert Category Info In DataBase
                    $stmt = $con->prepare("INSERT INTO 
                            categories(Name,Description,Ordering,Visibilty,Allow_Comment,Allow_Ads) 
                            VALUES(?,?,?,?,?,?)
                                            ");
                    $stmt->execute(array($name,$descrip,$ordering,$visibile,$allow_comment,$allow_ads));
                    
                     $Msg =  "<div class = 'alert alert-success'><strong>" . $stmt->rowCount() ." ". lang('SUCCESS_INSERT') . "</strong></div>";
                     redirectHome($Msg,'back'); 
                }catch(Exception $e){
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>";
                }
                
            }else{
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . lang('ERROR_SAME') . "</div>";
                }
            }
            
            
            
            echo "</div>";
            
        }else{
                           
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'> Error! </h1>" ;
                        $Msg =  "<div class = 'alert alert-danger'>".lang('NO_PERMISSION')."</div>";
                        redirectHome($Msg,'back',6); 
                        echo "</div>";
             }
    }elseif($do == "edit"){
        //Chech Cat id is set and get integer value 
        $catid = isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET['catid']): 0;
        //chech this Category is Exist in data base 
        if(!checkItem("Cat_ID","categories",$catid)){
                try{
                        // get info of this category to disply it in thr form
                        $stmt = $con->prepare("SELECT * FROM categories WHERE Cat_ID = ?");
                        $stmt->execute(array($catid));
                        $result = $stmt->fetch();
                       ?>
<!-- set date of user in the form -->
<h1 class="text-center">Add Categories</h1>
  <div class="container">
        
      <form class = "form-horizontal" action = "?do=Update&catid=<?php echo $catid ;?>"  method = "POST">
          <!-- Start Cat_name Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_NAME');?></label>
                <div class = "col-sm-9 col-md-6">
                    <input type="text" name="cat_name" value="<?php echo $result['Name'];?>" class="form-control" 
                                                autocomplete = "off" required = "required" placeholder="<?php echo lang('CAT_NAME');?>"/>                </div>
          </div>
          <!-- End Cat_name Field -->
          <!-- Start Cat_Decription Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_DESCRIOTION');?></label>
                <div class = "col-sm-9 col-md-6">
                    <input type="text" name="cat_descrip" value="<?php echo $result['Description'];?>" class="form-control" 
                      placeholder="<?php echo lang('CAT_DESCRIOTION');?>"/>         
              </div>
          </div>
          <!-- End Cat_Decription Field -->
          <!-- Start Cat_Ordering Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_ORDERING');?></label>
                <div class = "col-sm-9 col-md-6">
                    <input type="hidden" name="catid" value=""> 
                    <input type="text" name="ordering" value="<?php echo $result['Ordering'];?>" class="form-control" 
                                                autocomplete = "off" placeholder="<?php echo lang('CAT_ORDERING');?>"/>                </div>
          </div>
          <!-- End Cat_Ordering Field -->
          <!-- Start Visibilt Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_VISIBILTY');?></label>
                <div class = "col-sm-9 col-md-6">
                        <div>
                            <input id="vis-yes" type="radio" name="visibilty" value="0" <?php if($result['Visibilty'] == 0){echo "checked";} ?> />
                            <label for="vis-yes" >Yes</label>
                        </div>
                        <div>
                            <input id="vis-no" type="radio" name="visibilty" value="1" <?php if($result['Visibilty'] == 1){echo "checked";} ?>  />
                            <label for="vis-no" >No</label>
                        </div>
              
                </div>
          </div>
          <!-- End Visibilty Field -->
          <!-- Start Comment Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_ALLOW_COMMENT');?></label>
                <div class = "col-sm-9 col-md-6">
                        <div>
                            <input id="com-yes" type="radio" name="comment" value="0" <?php if($result['Allow_Comment'] == 0){echo "checked";} ?> />
                            <label for="com-yes" >Yes</label>
                        </div>
                        <div>
                            <input id="com-no" type="radio" name="comment" value="1" <?php if($result['Allow_Comment'] == 1){echo "checked";} ?> />
                            <label for="com-no" >No</label>
                        </div>
              
                </div>
          </div>
          <!-- End Comment Field -->
          <!-- Start ADs Field -->
          <div class = "form-group form-group-lg">  
                <label class="col-sm-3 control-label"><?php echo lang('CAT_ALLOW_ADS');?></label>
                <div class = "col-sm-9 col-md-6">
                        <div>
                            <input id="ads-yes" type="radio" name="ads" value="0" <?php if($result['Allow_Ads'] == 0){echo "checked";} ?> />
                            <label for="ads-yes" >Yes</label>
                        </div>
                        <div>
                            <input id="ads-no" type="radio" name="ads" value="1" <?php if($result['Allow_Ads'] == 1){echo "checked";} ?> />
                            <label for="ads-no" >No</label>
                        </div>
              
                </div>
          </div>
          <!-- End ADs Field -->
          <!-- Start ADs Field -->
          <div class = "form-group form-group-lg">  
                <div class = "col-sm-offset-3 col-md-10">
                    <input class = "btn btn-primary btn-lg" type="submit" value="Update Category" />
                </div>
          </div>
          <!-- End ADs Field -->
        </form>
  </div>
            


<?php        }catch(Exception $e){
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>";}
        }else{
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . lang('NOT_FOUND_ID') . "</div>";
        }
    }elseif($do == 'Update'){
        //chech The user comming from request Method or dierctly
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            echo "<div class = 'container'>";
            echo "<h1 class = 'text-center'> Update Category</h1>";
            $cat_id = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
            // get Date From Post Request
            $name               = $_POST['cat_name'];
            $descrip            = $_POST['cat_descrip'];
            $ordering           = $_POST['ordering'];
            $visibile           = $_POST['visibilty'];
            $allow_comment      = $_POST['comment'];
            $allow_ads          = $_POST['ads'];       
            $form_error = array();
            if(empty($name)){
                $form_error[] = lang('CN_EMPTY');
            }
            if(strlen($name) < 4){
                $form_error[] = lang('CN_LEGTH');
            }
            foreach($form_error as $error){
                    echo "<div class = 'alert alert-danger'>" . $error . "</div>" ;

            }
            // check there is no error
           if(empty($form_error)){
            if(!checkItem("Cat_ID","categories",$cat_id)){
                try{
                    
                    $stmt = $con->prepare("UPDATE 
                                                    categories 
                                            SET
                                                    Name = ? ,
                                                    Description = ? ,
                                                    Ordering = ? ,
                                                    Visibilty = ? ,
                                                    Allow_Comment = ? ,
                                                    Allow_Ads = ?
                                            WHERE
                                                    Cat_ID = ?
                                            ");
            $stmt->execute(array($name,$descrip,$ordering,$visibile,$allow_comment,$allow_ads,$cat_id));
                    
                    $Msg = "<div class = 'alert alert-success'> <strong>" . $stmt->rowCount() ." ". lang('SUCCESS_UPDATE') . " </strong></div>";
                    redirectHome($Msg,'back');   
                    echo "</div>";
                    }catch(Exception $e){
                                    echo "<div class = 'container'>";
                                    echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                                    echo "There is error:- " . $e->getMessage() . "</div>";   
                }
            }
        }
        }else{
            echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1>";
                        $Msg = "<div class = 'alert alert-danger'>" .lang('NO_PERMISSION'). "</div>";
                        redirectHome($Msg,'back',6);                        
                        echo "</div>";
      
    }
    }elseif($do == 'delete'){   
        echo "<div class= 'container'>";
        echo "<h1 class = 'text-center'>Delete Category</h1>";
        // Get catrgory Id and chech it is intger or no
        $cat_id = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        if(!checkItem("Cat_ID","categories",$cat_id)){
                    try{
                            // Delete the category from Data Base
                            $stmt = $con->prepare("DELETE
                                                    FROM    
                                                            categories
                                                    WHERE   
                                                            Cat_ID = ?");
                            $stmt->execute(array($cat_id));
                         $Msg = "<div class = 'alert alert-success'><strong>".$stmt->rowCount() .lang('SUCESS_DELETE'). "</strong></div>";
                         redirectHome($Msg,'back');                        
                         echo "</div>"; 
                            
                       }catch(Exception $e){ echo "<div class = 'container'>";
                                    echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                                    echo "There is error:- " . $e->getMessage() . "</div>";}
        }else{
                        // if this id is not Exite in data base
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1>";
                        $Msg = "<div class = 'alert alert-danger'>" . lang('NOT_FOUND_ID') . "</div>";
                        redirectHome($Msg,'back',6);                        
                        echo "</div>";
        }
    }
    
    include $tpl . "footer.php";
}else{
     header("Location: index.php");
    exit();
}
ob_end_flush();
?>