<?php
    function sanitizeString($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=(filter_var($data,FILTER_SANITIZE_STRING));
        return $data;
    }
?>