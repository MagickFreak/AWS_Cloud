<?php   
    function awslogin(){
        if(isset($_SESSION['user'])){
            return true;
        }else{
            return false;
        }
    }
?>