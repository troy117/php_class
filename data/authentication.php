<?php

    require_once DOCUMENT_ROOT . "data/query.php";
    require_once DOCUMENT_ROOT . "utils/Connections.php";



    /**
     *Registers the given user.
     *
     *@param string $_user The username to register
     *@param string $_pass The password to use
     *
     *@return string / boolean Returns true on success, and returns an
     *error message on failure.
     */
    function register($_user,$_pass)
    {
        $_user = mysqli_real_escape_string(Connections::$MYSQL, $_user);
        $_pass = mysqli_real_escape_string(Connections::$MYSQL, $_pass);
        
        $_user = trim($_user);
        $_pass = trim($_pass);
        
        
        if(strlen($_user) < 3)
        {
            return "The username was too short, it must be greater than 3 characters.";
        }
        else if(strlen($_user) > 25)
        {
            return "The username was too long, it cannot exceed 25 characters.";
        }
        else if(strlen($_pass) < 5)
        {
            return "Your password must be at least 5 characters.";
        }
        else if(strlen($_pass) > 50)
        {
            return "Your password cannot exceed 50 characters.";
        }
        
        
        $query = sprintf("INSERT INTO users (username, password) VALUES ".
                         "('%s', '%s')", $_user, $_pass
                         );
        
        $result = query($query);;
        
        if($result)
        {
            return true;
        }
        else
        {
            return "We're having technical difficulties, please try again.";
        }
        
        echo $query;
    }

?>