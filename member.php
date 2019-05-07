<?php

/*
======================================================================
== Mange Member Page
== You Can Add | Edit | Delete Members From Here
======================================================================
*/
ob_start(); // Output Buffering Start
session_start();
if(isset($_SESSION['username'])){
        include 'preperdata.php';
        $pageTitle = lang('MANGE_MEMBER');
        include "init.php";
                //Check the request
        if(isset($_GET['do'])){
        $do = $_GET['do'];
        }else{
            $do = 'Manage'; 
         }
          //Start Member Page
           if($do == 'Manage'){ // Manage Member Page 
                // Get All User From Data Base Expect Admin
               $query = ''; 
               if(isset($_GET['page']) && $_GET['page'] == "pending")
                {
                   $query = "AND RegStatus = 0" ; 
                } 
                $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");
                $stmt->execute();
                // Sort the data in Variable
                $result = $stmt->fetchAll();
                
?>
        

<h1 class = "text-center"><?php echo lang('MANAGE_MEMBER') ?></h1>                                                       

            <div class = "container">
                <div class = "table-responsive">
                    <table class = "main-table text-center table table-bordered">
                        <tr>
                            <td><?php echo lang('ID')?></td>
                            <td><?php echo lang('USER_NAME')?></td>
                            <td><?php echo lang('EMAIL')?></td>
                            <td><?php echo lang('FULLNAME')?></td>
                            <td><?php echo lang('REGISTER_STATUSE')?></td>                            
                            <td><?php echo lang('REGISTER_DATE')?></td>
                            <td><?php echo lang('CONTROLE')?></td>
                        </tr>
        <?php
        foreach($result as $field)
        {
                echo "<tr>";
                    echo "<td>".$field['UserID']."</td>";                               
                    echo "<td>".$field['UserName']."</td>";
                    echo "<td>".$field['Email']."</td>";
                    echo "<td>".$field['Fullname']."</td>";
                    echo "<td>".$field['RegStatus']."</td>";                    
                    echo "<td>".$field['register_date']."</td>";

                    echo "<td>
                            <a href='member.php?do=Edit&userid=".$field['UserID']."' class='btn btn-success'><i class = 'fa fa-edit'></i> ". lang('EDIT') ."</a>
                            <a href='member.php?do=Delete&userid=".$field['UserID']."' class='btn btn-danger confirm'><i class = 'fa fa-close'></i> ". lang('DELETE') ."</a>";
                        if($field['RegStatus'] == 0)
                        {
                            echo "<a href='member.php?do=Activate&userid=".$field['UserID']."' class='btn btn-info activate'><i class = 'fa fa-check'></i> ". lang('ACTIVATE') ."</a>";
                        }
                            
                            
                            
                       echo"</td>";
                echo "</tr>";

        }
            
        ?>
                    </table>
                
                </div>
        <a href='member.php?do=Add' class = "btn btn-primary"><i class="fa fa-plus"></i> Add Member</a>


            </div>

         <?php  }elseif($do == 'Add'){
               
               //Add Member Page
               ?>
         <h1 class = "text-center"><?php echo lang('ADD_MEMBER') ?></h1>                                                   
            <div class = "container">
                <form class="form-horizontal" action="?do=Insert" method="POST">
                <!-- Start User Filed -->               
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label"><?php echo lang('USERNAME');?></label>
                                <div class = "col-sm-9 col-md-6">
                                        <input type="text" name="username" class="form-control" 
                                                autocomplete = "off" required = "required" placeholder="<?php echo lang('USERNAME');?>"/>
                                
                               </div>
                        </div>
                    
                <!-- End User Filed -->
                    <!-- Start Password Filed -->               
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label"><?php echo lang('PASSWORD');?></label>
                                <div class = "col-sm-9 col-md-6">
                                    <input type="password" name="password" class="password form-control" 
                                        autocomplete = "new-password" required = "required" placeholder="<?php echo lang('PASSWORD');?>"/>
                                    <i class="show-pass fa fa-eye fa-2x"></i>
                                
                               </div>
                        </div>
                    
                <!-- End User Filed -->
                    <!-- Start E-mail Filed -->               
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label"><?php echo lang('EMAIL');?></label>
                                <div class = "col-sm-9 col-md-6">
                                        <input type="email" name="email" class="form-control" 
                                        autocomplete = "off" required = "required" placeholder="<?php echo lang('EMAIL');?>"/>
                                
                               </div>
                        </div>
                    
                <!-- End E-mail Filed -->
                    <!-- Start Full Name Filed -->               
                        <div class="form-group form-group-lg">
                                <label class="col-sm-3   control-label"><?php echo lang('FULLNAME');?></label>
                                <div class = "col-sm-9 col-md-6">
                                <input type="text" name="fullName" class="form-control"
                                autocomplete = "off" required = "required" placeholder="<?php echo lang('FULLNAME');?>"/>
                               </div>
                        </div>
                    
                <!-- End Full Name Filed -->
                    <!-- Start Button Filed -->               
                        <div class="form-group form-group-lg">
                                <div class = "col-sm-offset-3 col-sm-10 col-md-offset-5 col-md-10">
                                        <input type="submit" value="<?php echo lang('BTN_ADD');?>" class="btn btn-primary btn-lg"/>
                                
                               </div>
                        </div>
                    
                <!-- End Button Filed -->

                </form>
            


            </div>
    <?php
            }elseif($do == 'Edit'){//Start Edite Page
    //Check the user set the userid intger value
     $user_id = isset($_GET['userid']) && is_numeric($_GET['userid'])?intval($_GET['userid']):0;
      // make statement to get data of the user by userid   
      $stmt = $con->prepare("SELECT 
                                   *
                            FROM
                                    users
                            WHERE
                                    UserID = ?
                            LIMIT 1");
    $stmt->execute(array($user_id));
    $result = $stmt->fetch();
    $row_count  = $stmt->rowCount();
            //if the data back from database set this data in the form for this id
                    if($row_count > 0)
                    {
?>

         <h1 class = "text-center"><?php echo lang('EDITE_MEMBER') ?></h1>                                                   
            <div class = "container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                <input type="hidden" name="userid" value="<?php echo $result['UserID'];?>" />
                <!-- Start User Filed -->               
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label"><?php echo lang('USERNAME');?></label>
                                <div class = "col-sm-9 col-md-6">
                                        <input type="text" name="username" class="form-control" 
                                               value="<?php echo $result['UserName']?>" autocomplete = "off" required = "required" />
                                
                               </div>
                        </div>
                    
                <!-- End User Filed -->
                    <!-- Start Password Filed -->               
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label"><?php echo lang('PASSWORD');?></label>
                                <div class = "col-sm-9 col-md-6">
                                        <input type="hidden" name="oldpassword" class="form-control" 
                                        autocomplete = "new-password" value = "<?php echo $result['Password']?>"/>
                                    <input type="password" name="newpassword" class="form-control" 
                                        autocomplete = "new-password" placeholder = "<?php echo lang('LEAVE');?>" />
                                
                               </div>
                        </div>
                    
                <!-- End User Filed -->
                    <!-- Start E-mail Filed -->               
                        <div class="form-group form-group-lg">
                            <label class="col-sm-3 control-label"><?php echo lang('EMAIL');?></label>
                                <div class = "col-sm-9 col-md-6">
                                        <input type="email" name="email" class="form-control" 
                                        value="<?php echo $result['Email']?>"autocomplete = "off" required = "required"/>
                                
                               </div>
                        </div>
                    
                <!-- End E-mail Filed -->
                    <!-- Start Full Name Filed -->               
                        <div class="form-group form-group-lg">
                                <label class="col-sm-3   control-label"><?php echo lang('FULLNAME');?></label>
                                <div class = "col-sm-9 col-md-6">
                                <input type="text" name="fullName" class="form-control"
                                value="<?php echo $result['Fullname']?>"autocomplete = "off" required = "required"/>
                               </div>
                        </div>
                    
                <!-- End Full Name Filed -->
                    <!-- Start Button Filed -->               
                        <div class="form-group form-group-lg">
                                <div class = "col-sm-offset-3 col-sm-10 col-md-offset-5 col-md-10">
                                        <input type="submit" value="<?php echo lang('SAVE');?>" class="btn btn-primary btn-lg"/>
                                
                               </div>
                        </div>
                    
                <!-- End Button Filed -->

                </form>

            </div>

<?php 
                    }
                    // there is no such id in data base display this message
                    else{
                        
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'> Error! </h1>" ;
                        $Msg =  "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
                        redirectHome($Msg,'back',6); 
                        echo "</div>";
                    }
}else if($do == "Insert"){ // Insert Page Afert Send Request
                        
                        

                    if($_SERVER['REQUEST_METHOD'] == "POST")
                    {
                             echo "<h1 class = 'text-center'>" . lang('ADD_MEMBER'). "</h1>";
                                $user_name = $_POST['username'];                
                                $password = $_POST['password'];
                                $user_mail = $_POST['email'];
                                $user_fullname = $_POST['fullName'];                               
    //Create Array To Sort Error of The Form
                $formErrors = array();
                  //Validate The Form              
            
               echo "<div class = 'container'>";             
        // User Name Validate
                if(empty($user_name)){
                    $formErrors[] =  lang('UN_EMPTY');
                }
                if(strlen($user_name) < 4 && !empty($user_name) && !is_numeric($user_name)){
                    $formErrors[] = lang('UN_LEGTH');
                }
                if(strlen($user_name) > 20){
                    $formErrors[] = lang('UN_MORE');
                }
                if(is_numeric($user_name)){
                     $formErrors[] = lang('UN_NUMBER');
                }
      //Password Validate
                if(strlen($password) < 8 && !empty($password)){
                     $formErrors[] = lang('PASS_LEGTH');
                }
                if(is_numeric($password) && strlen($password) > 8){
                           $formErrors[] = lang('PASS_WITH_CHAR');
                }
                if(empty($password))
                {
                    $formErrors[] = lang('PASS_EMPTY');
                }
     // E-mail Validate
                if(empty($user_mail)){
                   $formErrors[] = lang('MAIL_EMPTY');
                }
    //Full Name Validate
                if(empty($user_fullname)){
                    $formErrors[] = lang('FN_EMPTY');
                }
                if(is_numeric($user_fullname)){
                     $formErrors[] = lang('FN_NUMBER');
                }
    // Print Array of Error is occuire           
                 foreach( $formErrors as $errorMesssage )
                {
                    echo "<div class = 'alert alert-danger'>" . $errorMesssage . "</div>" ;
                }
                        
                    if(empty($formErrors))
                    {

                        $hashPassword = sha1($password);
                        $Msgs[] = array();
                        $chechTheSameData = true;    
                       if(!checkItem("UserName","users",$user_name)){
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1>";
                        $Msgs[] = "<div class = 'alert alert-danger'>".lang('UN_FOUND')."</div>";
                        $chechTheSameData = false; 
                       }
                      if(!checkItem("Email","users",$user_mail)){
                                    if($chechTheSameData){
                                    echo "<h1 class = 'text-center'>".lang('ERROR')."</h1>";
                                    }
                                    $Msgs[] = "<div class = 'alert alert-danger'>".lang('MAIL_FOUND')."</div>";
                                    $chechTheSameData = false;
                               }
                        
                        if(!$chechTheSameData){
                            @$finalMsg = implode("",$Msgs);  
                            $msg = str_replace("Array","",$finalMsg);
                            echo $msg;
                        
                           //redirectHome($finalMsg,'back'); 
                        }
                        
                    //Insert UserInfo In Data Base
                        if($chechTheSameData){
                        try{
                        $stmt = $con->prepare("INSERT INTO 
                                                            users(UserName, Password, Email, Fullname,RegStatus,register_date)
                                                      VALUES(:userName,:Pass,:emai,:fName,1,now())
                                                      
                                                        ");
                        $stmt->execute(array(
                            'userName' => $user_name,
                            'Pass'     => $hashPassword,
                            'emai'     => $user_mail,
                            'fName'    => $user_fullname,
                               ));  
                            //Message if Success
                            
                                $Msg =  "<div class = 'alert alert-success'><strong>" . $stmt->rowCount() ." ". lang('SUCCESS_INSERT') . "</strong></div>";
                            
                            redirectHome($Msg,'back',6); 
                            
                            
                    }catch (Exception $e)
                    {
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
    }elseif($_GET['do'] == "Update"){ // Update Page Afert Send Request
                                    
                            if($_SERVER['REQUEST_METHOD'] == 'POST')
                            {
                                echo "<h1 class = 'text-center'> ". lang('EDITE_MEMBER') ."</h1>";
                                //Get The Variable From The Form
                                $user_name = $_POST['username'];                
                                $user_mail = $_POST['email'];
                                $user_fullname = $_POST['fullName'];                               
                                $user_id = $_POST['userid'];
                                $password = $_POST['newpassword'];
                                //password trick
        $user_password = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']); 
    
    //Create Array To Sort Error of The Form

            $formErrors = array();
                  //Validate The Form              
            
               echo "<div class = 'container'>";             
                   // User Name Validate
                if(empty($user_name)){
                    $formErrors[] =  lang('UN_EMPTY');
                }
                if(strlen($user_name) < 4 && !empty($user_name) && !is_numeric($user_name)){
                    $formErrors[] = lang('UN_LEGTH');
                }
                if(strlen($user_name) > 20){
                    $formErrors[] = lang('UN_MORE');
                }
                if(is_numeric($user_name)){
                     $formErrors[] = lang('UN_NUMBER');
                }
      //Password Validate
                if(strlen($password) < 8 && !empty($password)){
                     $formErrors[] = lang('PASS_LEGTH');
                }
                if(is_numeric($password) && strlen($password) > 8){
                           $formErrors[] = lang('PASS_WITH_CHAR');
                }
     // E-mail Validate
                if(empty($user_mail)){
                   $formErrors[] = lang('MAIL_EMPTY');
                }
    //Full Name Validate
                if(empty($user_fullname)){
                    $formErrors[] = lang('FN_EMPTY');
                }
                if(is_numeric($user_fullname)){
                     $formErrors[] = lang('FN_NUMBER');
                }
    // Print Array of Error is occuire           
                 foreach( $formErrors as $errorMesssage )
                {
                    echo "<div class = 'alert alert-danger'>" . $errorMesssage . "</div>" ;
                }
                 // Check ther is no error Update the Date
                if(empty($formErrors)){    
                    
                 // Update the Datebase with this info
                try{
                        $stmt = $con->prepare("UPDATE

                                                    Users 
                                              SET    
                                                     UserName = ?,
                                                     Password = ?, 
                                                     Email = ?,
                                                     Fullname = ?
                                              WHERE 
                                                     UserID = ?
                                              ");
                            $stmt->execute(array($user_name, $user_password, $user_mail, $user_fullname, $user_id));
                        $Msg = "<div class = 'alert alert-success'> <strong>" . $stmt->rowCount() ." ". lang('SUCCESS_UPDATE') . " </strong></div>";
                        redirectHome($Msg,'back',6);                        

                    //$_SESSION['username'] = $user_name;
                    }catch(Exception $e)
                    {
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>"; 
                    }
                }
                    echo"</div>";
                                
                            
                                
                                                             }else{
                                                                echo "<div class = 'container'>";
                                                                echo "<h1 class = 'text-center'>".lang('ERROR')."!</h1>";
                                                                $Msg = "<div class = 'alert alert-danger'>"
                                                                .lang('NO_PERMISSION')
                                                                ."</div>";
                                                                redirectHome($Msg,6);
                                                                echo "</div>";
                                                                  }
        }elseif($_GET['do'] == 'Delete'){
                    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
                 echo "<h1 class = 'text-center'> ". lang('ACTIVE_MEMBER') ."</h1>";
                echo "<div class = 'container'>";             

                           try{     
                                if(!checkItem("UserId", "users", $userid)){
                                                        $stmt = $con->prepare("DELETE FROM 
                                                                                            users
                                                                                WHERE UserID = :zuser");
                                                        $stmt->bindParam(":zuser", $userid);
                                                        $stmt->execute();
                                    $Msg =  "<div class = 'alert alert-success'> <strong>"
                                        . $stmt->rowCount() ." ". lang('SUCESS_DELETE') . "</strong></div>";
                                    redirectHome($Msg,'back');

                                    
                                                        }else{
                                                              echo "<div class = 'container'>";
                                                              echo "<h1 class = 'text-center'> Error! </h1>" ;
                                                              $Msg =  "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
                                                              redirectHome($Msg,'back',6); 
                                                               echo "</div>";
                                                             }
                           }catch(Exeption $e){
                               echo $e->getMessage();
                           }
                            echo "</div>";
                        }else if($_GET['do'] == 'Activate')
                            {
                                $userid = isset($_GET['userid']) && is_numeric($_GET['userid'])?
                                intval($_GET['userid']) : 0;
                                
                                echo "<h1 class = 'text-center'> ". lang('ACTIVE_MEMBER') ."</h1>";
                                echo "<div class = 'container'>";   
               
                                try{
                                    if(!checkItem("UserId", "users", $userid)){
                                    $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
                                $stmt->execute(array($userid));
                                $Msg =  "<div class = 'alert alert-success'> <strong>"
                                        . $stmt->rowCount() ." ". lang('SUCCESS_ACTIVE') . "</strong></div>";
                                    redirectHome($Msg,'back');

                                    
                                                        }else{
                                                              echo "<div class = 'container'>";
                                                              echo "<h1 class = 'text-center'> Error! </h1>" ;
                                                              $Msg =  "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
                                                              redirectHome($Msg,'back',6); 
                                                               echo "</div>";
                                                             }
               
                                }catch(Exeption $e){
                               echo $e->getMessage();
                           }
                                
                                echo $userid;
                                echo "<div>";
                            }
           
include $tpl . "footer.php";
                               }else{
    header("Location: index.php");
    exit();
}
ob_end_flush()
?>