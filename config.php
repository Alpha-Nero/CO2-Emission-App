<?php // Connection String
//if(isset($_POST["submit"])){
     define('DB_SERVER','localhost');
     define('DB_USER','user');
     define('DB_PASS' ,'password');
     define('DB_NAME', 'alpha_db');


    //  define('DB_SERVER','localhost');
    //  define('DB_USER','esgwycwm_alphanero_user');
    //  define('DB_PASS' ,'vaio@321');
    //  define('DB_NAME', 'esgwycwm_alphanero_db');
/**** Data Base Query and Connection  ****/

class Databases{  
      public $con;  
      public $error;  
      public function __construct()  
      {  
           $this->con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);  
           if(!$this->con)  
           {  
                echo 'Database Connection Error ' . mysqli_connect_error($this->con);  
           }else{
              // echo'ssssssssssssssssssssssssssssssssssssssssssssssss';
           }  
      }  
public function insert($table_name, $data)  
      {  
          if(isset($_POST["submit"])){
           $string = "INSERT INTO ".$table_name." (";            
           $string .= implode(",", array_keys($data)) . ') VALUES (';            
           $string .= "'" . implode("','", array_values($data)) . "')"; 
         //echo $string;
           if(mysqli_query($this->con, $string))  
           {  
                return true;  
           }  
           else  
           {  
                echo mysqli_error($this->con);  
           }  
          }
      }
      
//Test-

public function select($table_name)  
      {  
           $array = array();  
           $query = "SELECT * FROM ".$table_name." where ".$table_name.'_'."is_visibility='1' order by ".$table_name.'_'."id desc";  
          // echo $query ;
           $result = mysqli_query($this->con, $query);  
          if($result){
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;  
          }
      } 
public function select_where($table_name,$where)  
      {  
           $array = array();  
          
           if($table_name == 'project_master'){
            $query = "SELECT * FROM ".$table_name." where project_name='$where' order by project_master_id  desc";  
           }elseif($table_name == 'add_Item_to_project' || $table_name =='add_Location_to_project'){
               if($table_name =='add_Location_to_project'){
                    $query = "SELECT * FROM ".$table_name." where add_Location_to_project_project_id='$where' order by add_Location_to_project_project_id  desc";
               }else{
                $query = "SELECT * FROM ".$table_name." where add_Item_to_project_assign_id='$where' order by add_Item_to_project_id  desc";
               }
           }else{
           $query = "SELECT * FROM ".$table_name." where ".$table_name.'_'."id=".$where." order by ".$table_name.'_'."id desc";  
          // echo $query;
          
           }
         //echo $query;
           $result = mysqli_query($this->con, $query);  
           if($result){
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array; 
           }
      }
public function get_projectsByid($table_name,$where)  
      {  
           $array = array();  
          
           if($table_name == 'project_master'){
                  $query = "SELECT * FROM ".$table_name." where project_id='$where' order by project_id  desc";  
           }
         
           $result = mysqli_query($this->con, $query); 
       if($result){
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;  
       }
      } 
public function select_inventry($table_name,$where)  
      {  
           $array = array();  
     
            $query = "SELECT * FROM ".$table_name." $where order by inventory_transaction_id   desc";  
           $result = mysqli_query($this->con, $query);
           if($result){
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;
           }
      }       
public function select_Query($query)  
      {  
           $array = array();  
           $query =   $query;
           $result = mysqli_query($this->con, $query);
          
           if($result){
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;  
           }
      }
      
// Update record

public function updateData($query)  
      {  
           if(isset($_POST["submit"])){
           $array = array();  
          
           $result = mysqli_query($this->con, $query);  
           if($result){
           return true; 
           }else{
               return false; 
           }
      } 
      }
      
 }  
//}
?>
