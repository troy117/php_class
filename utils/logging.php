<?php

    require_once DOCUMENT_ROOT."utils/Connections.php";

    date_default_timezone_set('America/Los_Angeles');

    $directory = DOCUMENT_ROOT."logs/";
    $file_name = date("m_d_y").".txt";
    
    Connections::$LOG = fopen($directory.$file_name, "a");
    
    function write_to_log($_message)
    {
        fwrite(Connections::$LOG, date("F j, Y | g:i:s:")." | ".$_message."\r\n");
    }

?>