<?php

    //What are we requesting
    $request = $_GET["request"];

    $names = array("Dustin"=>"Kinsey",
                   "Troy"=>"Lewis",
                   "Ian"=>"Kinsey");
    
    if($request=="get_last_name"){
        $first_name = $_GET["first_name"];
        
        echo $first_name." ".$names[$first_name]."<br>";
    }
    else if($request=="get_first_name"){
        echo array_search($_GET["last_name"],$names);
    }
    else if($request=="get_all_names"){
        print_r($names);
    }
    else{
        echo "<h1>UHOH You messed up</h1>";
    }

?>