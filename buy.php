s<?php

require("../includes/config.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    render("buy_form.php", ["title" => "BUY"]);
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $stockbought = lookup($_POST["symbol"]);
    $total_value = $stockbought["price"] * $_POST["quantity"] ;
    $cas_left = cs50::query("SELECT cash FROM users WHERE id = ?",$_SESSION["id"]);
    $transaction = 'BUY';
    
    if(!preg_match("/^\d+$/", $_POST["quantity"]))
    {
        apologize("only positive numbers");
    }
    else
    {
            if ($cas_left < $total_value)
             {
            apologize("INSUFFICIENT FUNDS");
            }
            else
            {
        
            
            $rows = cs50::query("SELECT symbol,shares FROM portfolio WHERE user_id = ?",$_SESSION["id"]);
         
                cs50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES(?, ?, ?) 

                ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["quantity"]);
            }
        
        }
        
    
    
    cs50::query("UPDATE users SET cash = cash - ? WHERE id = ?",$total_value,$_SESSION["id"]);
    cs50::query("INSERT INTO history (user_id,symbol,transaction,quantity) VALUES (?,?,?,?)",$_SESSION["id"], $_POST["symbol"],$transaction,$_POST["quantity"]);
    
    redirect("/");
    
}

?>




















?>