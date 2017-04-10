<?php
 
  require("../includes/config.php");
  
  if ($_SERVER["REQUEST_METHOD"] == "GET")
  {
  
  render("reset_form.php", ["title" => "reset"]);
  
  }
   else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      
      
        if(empty($_POST["new_pass"] || $_POST["cnf_pass"]))
        {
            apologize("Please fill in all the fields");
            
        }
        if($_POST["new_pass"] != $_POST["cnf_pass"])
        {
            apologize("New password and Confirm password did not match");
            
        }
        
        cs50::query("UPDATE users SET hash =? WHERE id =?", password_hash($_POST["new_pass"],PASSWORD_DEFAULT),$_SESSION["id"]);
        redirect("/");
        
    }