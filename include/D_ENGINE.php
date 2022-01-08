<?php
 //GWS_D_ENGINE
/*
 * All database connection variables
 */

define('GWS_DB_USER', "root"); 
define('GWS_DB_PASSWORD', ""); 
define('GWS_DB_DATABASE', "mesl_test"); 
define('GWS_DB_SERVER', "localhost");

 
function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>