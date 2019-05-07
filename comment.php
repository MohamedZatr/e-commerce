<?php



ob_start(); //Output Buffering Start
session_start();
if(isset($_SESSION['username'])){        
        include 'preperdata.php';
        $pageTitle = lang('COMMENTS');
        include "init.php";
//check do is set or no     
    if(isset($_GET['do'])){
        $do = $_GET['do'];
    }else{
        $do = 'Manage';
    }
       //chech do to go the target
    // Manage Page
    if($do == 'Manage'){
                    try{
                        $stmt = $con->prepare("SELECT comments.*,users.UserName,items.Name FROM comments                        INNER JOIN 
                                                            users 
                                                ON 
                                                            users.UserID = comments.Member_ID 
                                                INNER JOIN 
                                                            items 
                                                ON 
                                                            items.Item_ID = comments.item_ID");
                        $stmt->execute();
                        $comments = $stmt->fetchAll();
                    }catch(Exception $e){
                        
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>";
                    }

?>
        
<h1 class = "text-center"><?php echo lang('MANAGE_COMMENTS') ?></h1>                                                       

            <div class = "container">
                <div class = "tbl table-responsive">
                    <table class = "main-table text-center table table-bordered">
                        <tr>
                            <td><?php echo lang('ID_COMMENT')?></td>
                            <td><?php echo lang('COMMENT_COMMENT')?></td>
                            <td><?php echo lang('STATUE_COMMENT')?></td>
                            <td><?php echo lang('DATE_COMMENT')?></td>
                            <td><?php echo lang('ITEM_COMMENT')?></td>                            
                            <td><?php echo lang('ADDBY_COMMENT')?></td>
                            <td><?php echo lang('CONTROLE')?></td>
                        </tr>
        
<?php  
                    foreach($comments as $comment){
                        echo "<tr>";
                        echo "<td>".$comment['Com_ID']."</td>";
                        echo "<td>".$comment['Comment']."</td>";
                        echo "<td>".$comment['status']."</td>";
                        echo "<td>".$comment['Add_Date']."</td>";
                        echo "<td>".$comment['Name']."</td>";
                        echo "<td>".$comment['UserName']."</td>";
                        echo "<td><a class = 'btn btn-success'
                              href = 'comment.php?do=edit&comid=".$comment['Com_ID']."'><i class = 'fa fa-edit'></i> Edit</a>";
                            if($comment['status'] == 0){
                                echo "<a class = 'btn btn-info'
                              href = 'comment.php?do=Approve&comid=".$comment['Com_ID']."'><i class = 'fa fa-check'></i> Approve</a>";
                            }
                            
                          echo  "<a class = 'btn btn-danger comforim_comment'
                              href = 'comment.php?do=delete&comid=".$comment['Com_ID']."'><i class = 'fa fa-close'></i> Delete</a></td> </tr>";
                    }
                        echo "</table> </div> </div>";
                        
                        
                        
    }elseif($do == 'edit'){
        // get id of comment and check is intger or not
        $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
        //chech if this Comment is  in data base or not
        if(!checkItem("Com_ID", "comments",$comid)){
            try{
                $stmt = $con->prepare("SELECT * FROM comments WHERE Com_ID = ?");
                $stmt->execute(array($comid));
                $comment = $stmt->fetch();
                ?>
             <!--this fotm to display data of item we can edit-->
        <h1 class = "text-center"><?php echo lang('UPDATE_COMMENT');?></h1>
        <div class="container">
            <form class="form-horizontal" action="?do=Update&comid=<?php echo $comid;?>" method="POST">
                <!-- Start Name Feild -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-3 control-label"><?php echo lang('COMMENT_COMMENT'); ?></label> 
                         <div class="col-sm-9 col-md-6">
                             <textarea type="text" name="name" class="form-control" placeholder="<?php echo lang('COMMENT_COMMENT'); ?>" autocomplete="off" required = "required"><?php echo $comment['Comment']?></textarea>
                         </div>
                </div>
                <!-- Start Submit Button -->
                    <div class="form-group form-group-lg">
                        <div class = "col-sm-offset-3 col-sm-10">
                            <input type="submit" value="Save" class="btn btn-primary btn-lg" />
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
        
    }elseif($do == 'Update'){
        // chech user comming from request or directly
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // get id of comment and check is intger or not
        $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
        $comment = $_POST['name'];
        if(!empty(trim($comment))){
        if(!checkItem("Com_ID", "comments", $comid)){    
        try{
            echo "<h1 class = \"text-center\">".lang('UPDATE_COMMENT')."</h1>
                <div class=\"container\">";
            $stmt = $con->prepare("UPDATE comments SET 	Comment = ? WHERE Com_ID = ?");
            $stmt->execute(array($comment,$comid));
             //Message if Success
                                $Msg =  "<div class = 'alert alert-success'><strong>" . $stmt->rowCount() ." ". lang('SUCCESS_UPDATE') . "</strong></div>";
                            // redierct function to rediect the user Automatic
                            redirectHome($Msg,'back'); 
                echo "</div>";
        }catch(Exception $e){
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>";
        }
        }else{
         echo "<div class = 'container'>";
                                                              echo "<h1 class = 'text-center'> Error! </h1>" ;
                                                              $Msg =  "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
                                                              redirectHome($Msg,'back',6); 
                                                               echo "</div>";   
        }
    }else{
        echo "<div class = 'container'> <h1 class = 'text-center'>" .lang('ERROR'). "</h1>";
        
        echo "<div class = 'alert alert-danger'>" .lang('ERROR_COMMENT'). "</div>";
    }
                                            }else{
                                                                echo "<div class = 'container'>";
                                                                echo "<h1 class = 'text-center'>".lang('ERROR')."!</h1>";
                                                                $Msg = "<div class = 'alert alert-danger'>"
                                                                .lang('NO_PERMISSION')
                                                                ."</div>";
                                                                redirectHome($Msg,6);
                                                                echo "</div>";
                                            }
    }elseif($do == 'Approve'){
            // get id of comment and check is intger or not
            $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
        if(!checkItem("Com_ID", "comments", $comid)){    
        try{
            echo "<h1 class = \"text-center\">".lang('APPROVE_COMMENT')."</h1>
                <div class=\"container\">";
            $stmt = $con->prepare("UPDATE comments SET 	status = 1 WHERE Com_ID = ?");
            $stmt->execute(array($comid));
             //Message if Success
                                $Msg =  "<div class = 'alert alert-success'><strong>" 
                                    . lang('APPROVE_COMMENT_MSG') . "</strong></div>";
                            // redierct function to rediect the user Automatic
                            redirectHome($Msg,'back'); 
                echo "</div>";
        }catch(Exception $e){
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>";
        }
        }else{
                                                              echo "<div class = 'container'>";
                                                              echo "<h1 class = 'text-center'> Error! </h1>" ;
                                                              $Msg =  "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
                                                              redirectHome($Msg,'back',6); 
                                                               echo "</div>";
        }

    }elseif($do == "delete")
    {
        // get id of comment and check is intger or not
        $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;
        if(!checkItem("Com_ID", "comments", $comid)){   
        try{
            echo "<h1 class = \"text-center\">Delete Comment</h1>
                <div class=\"container\">";
            $stmt = $con->prepare("DELETE FROM comments  WHERE Com_ID = ?");
            $stmt->execute(array($comid));
             //Message if Success
                                $Msg =  "<div class = 'alert alert-success'><strong>" 
                                    . lang('DELETE_COMMENT_MSG') . "</strong></div>";
                            // redierct function to rediect the user Automatic
                            redirectHome($Msg,'back'); 
                echo "</div>";
        }catch(Exception $e){
                        echo "<div class = 'container'>";
                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                        echo "There is error:- " . $e->getMessage() . "</div>";
        }
        }else{
                                                              echo "<div class = 'container'>";
                                                              echo "<h1 class = 'text-center'> Error! </h1>" ;
                                                              $Msg =  "<div class = 'alert alert-danger'>".lang('NOT_FOUND_ID')."</div>";
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