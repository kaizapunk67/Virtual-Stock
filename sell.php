<?php
require("../includes/config.php"); 

if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_form.php", ["title" => "SELL"]);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {   
        $transaction = 'SELL';
        
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("You must provide the symbol you want to remove");
        }
        else if (empty($_POST["quantity"]))
        {
            apologize("You must provide the number of units");
        }
    $id = $_SESSION["id"];
    $rows = cs50::query("SELECT symbol,shares FROM portfolio WHERE user_id='$id'");
 
    foreach ($rows as $row)
    {
        if($row["symbol"] != $_POST["symbol"])
        {
            apologize("You do not own that stock");
        }
        if($row["shares"] < $_POST["quantity"])
        {
            apologize("You have lesser stocks");
        }
        else if ($row["symbol"] == $_POST["symbol"])
        {
            $stock = $row["symbol"];
            $remunits = $row["shares"]-$_POST["quantity"];
            if($remunits > 0)
            {
            cs50::query("UPDATE portfolio SET shares='$remunits' WHERE user_id = '$id'");
            }
            else if($remunits == 0)
            {
            cs50::query("DELETE FROM portfolio WHERE user_id = '$id'  AND symbol ='$stock' ");
            }
            $cash = lookup($row["shares"]);
            $retcash = $cash["price"] * $_POST["quantity"];
            cs50::query("UPDATE users SET cash = cash+$retcash WHERE id = '$id'");
            cs50::query("INSERT INTO history (user_id,symbol,transaction,quantity) VALUES (?,?,?,?)",$_SESSION["id"], $_POST["symbol"],$transaction,$_POST["quantity"]);
            redirect("/");
        }
    }
    }
?>