<?php
session_start();//Start the Session
session_unset(); //Unset the Data
session_destroy(); // destroy the session 
header("Location: index.php");
exit(); 
