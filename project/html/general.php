<?php 
	function sanitise_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function isItStudentID($data) {
    	if(preg_match("/^[\d]{9}$/", $data)) {
    		return true;
    	} 
    	return false;
    }
?>