<?php /**database*/
     define('DB_SERVER','localhost');
     define('DB_USER','user');
     define('DB_PASS' ,'vaio@321');
     define('DB_NAME', 'alpha_db');
     
    //  define('DB_SERVER','localhost');
    //  define('DB_USER','esgwycwm_alphanero_user');
    //  define('DB_PASS' ,'vaio@321');
    //  define('DB_NAME', 'esgwycwm_alphanero_db');
// Create connection
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS,DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Unable to Connect database: " . $conn->connect_error);
}
?>