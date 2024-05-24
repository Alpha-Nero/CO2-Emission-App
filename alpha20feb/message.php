<?php 

if(isset($_SESSION['status'])){

?>

<!--<div class="alert alert-danger alert-dismissible" style=" margin-left:auto; margin-right:auto; ">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Wrong Details
                </div>-->
                <p class="text-danger">The email Address or password that you've entered doesn't match any account.</p>
                
<?php
unset($_SESSION['status']);
}
?>



