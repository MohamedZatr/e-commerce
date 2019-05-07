<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" target = "#app-nav" aria-expanded="false" >
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dash.php"><?php echo lang('HOME'); ?></a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
    <ul class="nav navbar-nav">
                  <li ><a href="categories.php"><?php echo lang('CATEGORIES')?></a></li>
                  <li ><a href="items.php"><?php echo lang('ITMES')?></a></li>
                  <li ><a href="member.php"><?php echo lang('MEMBERS')?></a></li>
                  <li ><a href="#"><?php echo lang('STATISTICS')?></a></li>
                  <li ><a href="comment.php"><?php echo lang('COMMENTS')?></a></li>
                  <li ><a href="#"><?php echo lang('LOGS')?></a></li>
    </ul> 
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php  echo $_SESSION['username'] ;?>
         <span class="caret"></span></a>                             
                                        <ul class="dropdown-menu">
                                          <li><a href="member.php?do=Edit&userid=<?php echo $_SESSION['user_id']?>"><?php echo lang('EDITE_PROFILE'); ?></a></li>
                                          <li><a href="#"> <?php echo lang('SETTING')?> </a></li>
                                          <li><a href="logout.php"> <?php echo lang('LOGOUT')?> </a></li>
                                        </ul>
                </li>
            </ul>
    </div>
  </div>
</nav>
