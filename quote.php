<?php

require("../includes/config.php"); 

 if($_SERVER["REQUEST_METHOD"]== "GET") {

    render("quote_form.php");



}
else{
    
    $value = lookup($_POST["symbol"]);
    if($value == false)
    {
    apologize("invalid stock");
    }
    else{
    render("quote_form2.php",["symbol" => $value ["name"],"price" => $value["price"]]);

    }
}
     
?>
