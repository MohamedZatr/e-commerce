<?php
session_start();
if(isset($_SESSION['username']))
{
    include 'preperdata.php';
    $pageTitle = lang('HOME_PAGE');
    include "init.php";
        /*Start Content Of dash Page*/
    $lastUser = 5 ; // Number of Users
     $theLastes = getLastes("*","users","UserID",$lastUser); // array Of users
    $lastItems = getLastes("*","items","Item_ID",$lastUser); // array Of users
    $lastCommentss = getLastes("*","comments","Com_ID",$lastUser);
?>
    <div class = "home-stats">
            <div class="container text-center">
                <h1>DashBoard</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat st-members">
                            <div class = 'info' >
                            Total Members
                            <span><a href="member.php">
                                <i class="fa fa-users"></i><?php echo getCount("UserID","users");?>
                                  </a>
                                </span>
                            </div>
                        </div >
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-pending">
                               
                            <div class = 'info' >
                            Pending Members
                            <span><a href="member.php?do=Manage&page=pending"><i class="fa fa-user-plus"></i>
                                <?php echo getCount("UserID","users","RegStatus","0");?>
                                  </a>
                           </span>
                            </div>
                        </div >
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-items">
                            <div class = 'info' >
                             Total Items              
                            <span><a href="items.php"><i class="fa fa-tag"></i><?php echo getCount("Item_ID","items");?></a></span>
                            </div>
                        </div >
                    </div>
                    <div class="col-md-3">
                        <div class="stat st-comment">
                                  
                            <div class = 'info' >
                            Total Comments
                            <span><a href="comment.php"><i class="fa fa-comments"></i><?php echo getCount("Com_ID","comments");?></a></span>
                            </div>
                        </div >
                    </div>

                </div>
        </div>
    </div>
    <div class = "last"> 
        <div class = "container">
            <div class = "row">
                <div class = "col-sm-6">
                    <div class = "panel panel-default">
                        <div class = "panel-heading">
                            <i class="fa fa-users fa-lg"></i> &nbsp; Last <?php echo $lastUser;?> Registerd Users
                            <span class = 'toggle-info pull-right'><i class = 'fa fa-plus fa-lg'></i></span>
                            
                        </div>
                        <div class = "panel-body">
                            <ul class="list-unstyled lastes-users">    
                        <?php    
                            
                                foreach($theLastes as $user)
                                {
                                     echo "<li>";
                                    if($user['RegStatus'] == 0){
                                        echo "<a href='member.php?do=Activate&userid=".$user['UserID']."' class='btn btn-info pull-right activate'><i class = 'fa fa-check'></i> ". lang('ACTIVATE') ."</a>";
                                                }
                                   
                                        echo  "<strong>". $user['UserName'] .
                                        "</strong><a href='member.php?do=Edit&userid=".$user['UserID']."'><span class='pull-right btn btn-success'>
                                        <i class = 'fa fa-edit'>
                                         Edit </i>";
                                    
                                    echo "</span></a></li>";
                                }
                        ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class = "col-sm-6">
                    <div class = "panel panel-default">
                        <div class = "panel-heading">
                            <i class="fa fa-tag fa-lg"></i> &nbsp; Last <?php echo $lastUser;?> Items
                            <span class = 'toggle-info pull-right'><i class = 'fa fa-plus fa-lg'></i></span>
                        </div>
                        <div class = "panel-body">
                             <ul class="list-unstyled lastes-users">    
                        <?php
                            foreach($lastItems as $item){
                                echo "<li>";
                                 if($item['Approve'] == 0){
                                    echo "<a class = 'pull-right btn btn-info' href = 'items.php?do=Approve&itemid=".$item['Item_ID']."'><i class = 'fa fa-check'></i> Approve</a>";
                                }
                                echo  "<strong>".$item['Name'].
                                "<strong><a class = 'pull-right btn btn-success' href = 'items.php?do=edit&itemid=".$item['Item_ID']."'><i class = 'fa fa-edit'></i> Edit</a>";
                               
                            echo"</li>";
                            }
                        ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                 <!--start Comments-->
                  <div class = "row">
                  <div class = "col-sm-6">
                    <div class = "panel panel-default">
                        <div class = "panel-heading">
                            <i class="fa fa-comments fa-lg"></i> &nbsp; Last <?php echo $lastUser;?> Comments
                            <span  class = 'toggle-info pull-right'><i class = 'fa fa-plus fa-lg'></i></span>
                           <a t></a>
                        </div>
                        <div class = "panel-body">
                            <?php
                                try{
                                    $stmt = $con->prepare("SELECT comments.*,users.UserName FROM comments INNER JOIN users ON users.UserID = comments.Member_ID LIMIT 5");
                                    $stmt->execute();
                                    $lastComments = $stmt->fetchAll();
                                    /*echo "<pre>";                                   
                                    print_r($lastComments);
                                    echo "</pre>";*/

                            foreach($lastComments as $comment){
                                echo "<div class = 'comment-box'>";
                                    echo "<span class = 'member-n' >".$comment['UserName']."</span>"; 
                                    echo "<p class = 'comment-com' >".$comment['Comment']."</p>";
                                    echo "<a class = 'btn-dash btn btn-danger btn-sm comforim_comment'
                              href = 'comment.php?do=delete&comid=".$comment['Com_ID']."' title ='Delete This Comment'><i class = 'fa fa-close '></i></a>";
                                    echo "</div>";
                                echo "";
                            }
                                }catch(Exception $e){
                                     // this display error if there are problem in database
                                        echo "<div class = 'container'>";
                                        echo "<h1 class = 'text-center'>".lang('ERROR')."</h1> <div class = 'alert alert-danger'>";
                                        echo "There is error:- " . $e->getMessage() . "</div>";
                                    
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Comments-->
        </div>
    </div>
    <?php
    /*End Content Of dash Page*/

    include $tpl . "footer.php";   
}
else{
	header("Location: index.php");
	exit();
}
?>