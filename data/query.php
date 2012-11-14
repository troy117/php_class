<?php

    require_once DOCUMENT_ROOT . "utils/Connections.php";
    require_once DOCUMENT_ROOT . "utils/logging.php";

    function query($_query)
    {
        $result = mysqli_query(Connections::$MYSQL, $_query);
        
        if(!$result)
        {
            write_to_log("MySQL Error: ".mysqli_error(Connections::$MYSQL));
        }
        
        return $result;
    }
    
    /**
     * Cleans the given query, returns the clean query.
     *
     * @param string $_query The MySQL query.
     *
     * @return string The clean MySQL query.     *
     */
    function clean($_query)
    {
        return mysqli_real_escape_string(Connections::$MYSQL,$_query);
    }

?>