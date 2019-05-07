<?php


/*
** getTitle v1.0
** this function use to echo title of page if no totle echo defulte title
** we use $page title if isset echo the title else echo defulte title
*/
function getTitle(){
    global $pageTitle;
    if(isset($pageTitle))
    {   
        echo $pageTitle;
    }else{
        echo "Shop";
    }
}

/*
** Redirect Function v2.0
** $Msg = echo the  message
** $url = the Link You Want Redirect To
** $seconds =   Seconds Before Redirecting
*/
function redirectHome($Msg, $url = null, $seconds = 3){
    
    if($url === null)
    {
        $url = 'dash.php';
        $link = "<strong>Home Page</strong>";
    }else{
      
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
        {
                $url = $_SERVER['HTTP_REFERER'];
                $link = "<strong>Previous Page</strong>";
        }else{
            $url = 'dash.php';
            $link = "<strong>Home Page</strong>";

        }
    }
    
    echo $Msg;
    echo "<div class = 'alert alert-info'>". lang('REDIRCT_PT1'). $link .lang('REDIRCT_PT2'). $seconds ." ".lang('REDIRCT_PT3'). "</div>";
    header("refresh:$seconds;url=$url");
    exit();
}

/*
** Check Item v1.0
** Function To Check Item In DataBase
** $select = The Item To Select [Ex:- username, item, category ]
** $from =  The Table To Select From [Ex:- users, items, categories]
** $value = The value of Select [Ex:- mohamed, Box, Electronics]
*/
    function checkItem($select, $from, $value){
        global $con;
        $statement = $con->prepare("SELECT 
                                          $select 
                                   FROM   $from 
                                   WHERE $select = ? ");
        $statement->execute(array($value));
        if($statement->rowCount() > 0)
        {
            return false;
        }else{
            return true;
        }
    }
/*
** getCount v1.0
** getCount     => Get Count Of Record in Data Base
** $item        => The Item to Count
** $table       => Name of the Table 
** $beforeWhere => column befor where ex: WHERE ID = 
** $value       => After = ex:- WHERE ID = 1
*/
function getCount($item, $table,$beforWhere=null , $value=null){
    global $con;
    if($value == null || $beforWhere==null )
    {
        $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
        $stmt2->execute();
        return $stmt2->fetchColumn();
    }else{
            $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table WHERE $beforWhere = $value");
            $stmt2->execute();
            return $stmt2->fetchColumn();
    }
    
}

/*
** Get Last Records Functions v1.0
** function To Get Lastest Item Freom database [Users, Items, Comments]
** $selet => Field to Select
** $table => Name of the table
** $order => oreder recorder by 
** $limit => number of the record will be returned
*/

function getLastes($select, $table, $order, $limit = 5){
    global $con;
    $stmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

















