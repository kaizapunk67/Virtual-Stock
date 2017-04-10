<table class ="table table-striped" >
<thead>
    <tr>
        
        <th>SYMBOL</th>
        <th>TRANSACTION TYPE</th>
        <th>QUANTITY</th>
        <th>TIME</th>
    </tr>
</thead>
<?php
 $id = $_SESSION["id"];
 $rows = cs50::query("SELECT symbol,transaction,quantity,time FROM history WHERE user_id='$id'");

 
 //time-stamp is done in database level with configurations to time-stamp for the time variable.
 
foreach ($rows as $row)
{
    print("<tbody>");
    print("<tr>");
    print("<th>{$row["symbol"]}</th>");
    print("<th>{$row["transaction"]}</th>");
    print("<th>{$row["quantity"]}</th>");
    print("<th>{$row["time"]}</th>");
    print("</tr>");
    print("</tbody>");
}

?>