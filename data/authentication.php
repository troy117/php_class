<?php

    require_once DOCUMENT_ROOT . "data/query.php";
    require_once DOCUMENT_ROOT . "utils/Connections.php";

    define("SALT_LENGTH",10);
    define("SERVER_ERROR_MESSAGE","We're having technical difficulties, please try again.");
    

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
        //clean the input
        $_user = clean($_user);
        $_pass = clean($_pass);
        
        //trim the user and pass
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
                         "('%s', '%s')", $_user, hash_password($_pass)
                         );
        
        $result = query($query);;
        
        if($result)
        {
            return true;
        }
        else
        {
            $query = sprintf("SELECT username FROM users WHERE username = '%s'", $_user);
                $result = query($query);

            
            if($result)
            {
                $row = mysqli_fetch_assoc($result);
                if($row)
                {
                    return "That username was already taken";
                }
            }
            return SERVER_ERROR_MESSAGE;
        }
        
        echo $query;
    }//End Register Function
    
    function login($_username,$_password)
    {
        $_username = clean($_username);
        
        $query = sprintf("SELECT password FROM users WHERE username = '%s'",$_username);
            $result = query($query);
        
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            
            if($row)
            {
                if(check_password_hash($_password,$row["password"]))
                {
                    return true;
                }
                else
                {
                    return "The password is incorrect";
                }
            }
            else
            {
                return "The given user does not exist";
            }
        }
        
        return SERVER_ERROR_MESSAGE;
    }
    
    
    /**
     * Hashes the password.
     *
     * <code>extract_hash_from_salt()</code> uses this function to determine how
     * long the salt is.  If this function changes, you may need to change that function.
     *
     * @param String $_plain_text the pasword to be hashed
     * @param String $_salt this is a optional variable to use a salt.
     *
     **/
    function hash_password($_plain_text, $_salt="")
    {
        if(!$_salt)
        {
            $salt = md5(mt_rand(1,100000000));
                $salt = substr($salt,0,SALT_LENGTH);
        }
        else
        {
            $salt = $_salt;
        }
        //random_giberish is an extra passphrase to generate a random hash
        $hash = hash("whirlpool","random_giberish".$_plain_text.$salt);
            $hash = substr($hash,0,strlen($hash)-SALT_LENGTH).$salt;
        return $hash;
    }
    
    function check_password_hash($_plain_text,$_hash)
    {
        $salt = extract_salt_from_hash($_hash);
        return(hash_password($_plain_text, $salt)== $_hash);
    }
    /**
     * Returns the salt from the given hash.
     * 
     * @param string $_hash hashed password
     *
     * @return string The salt extracted from the password.
     */
    function extract_salt_from_hash($_hash)
    {
        return substr($_hash, -SALT_LENGTH);
    }
    
    

?>