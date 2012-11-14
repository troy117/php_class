<?php
    
    ini_set("display_errors",1);
    ini_set("error_reporting",E_ALL);
    
    define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]."/php_class/");
    
    require_once DOCUMENT_ROOT."data/database.php";
    
    require_once DOCUMENT_ROOT."data/authentication.php";
    
    
    $_POST["request"] = "register";
    $_POST["user"] = "NewUser2";
    $_POST["password"]= "blarg";
    
    
    /*Using $_GET will show up inside the url,
        will change to $_POST to keep it hidden
    */
    //What are we requesting
    $request = $_POST["request"];
    
    $response = "The request was unhandled";

    switch($request)
    {
        case "register";
            
            $response = register($_POST["user"], $_POST["password"]);
            
            break;
        
        case "get_id";
            echo "bye";
            break;
        
        default:
            echo "neither";
            break;
        
    }
    
    if($response === true)
    {
        $response = "Success";
    }
    echo "<h1>".$response."</h1>";
    
    
    
    /*
    Old Code from previous day, stuff to deal with request
    
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
    
    */

?>