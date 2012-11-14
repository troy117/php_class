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

?>