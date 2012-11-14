<?php


    echo "<br>1</br>";
    echo get_last_name("Bethany");
    echo $last_name;
    echo "<br>3</br>";
    
    
    function get_last_name($_first_name)
    {
  
        echo "<br>2</br>";
        if($_first_name=="Bethany")
        {
            return "Kinsey";
        }
        if($_first_name=="Troy")
        {
            return "Lewis";
        }
        return "None!";
    
    }
    echo "<br>4</br>";


?>