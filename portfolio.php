<table class ="table table-striped" >
<thead>
    <tr>
        <th>NAME</th>
        <th>SYMBOL</th>
        <th>SHARES</th>
        <th>PRICE</th>
        <th>TOTAL</th>
    </tr>
</thead>

<?php
 $id = $_SESSION["id"];
 $rows = cs50::query("SELECT symbol,shares FROM portfolio WHERE user_id='$id'");
 
foreach ($rows as $row)
{
    $stock = lookup($row["symbol"]);
    if ($stock !== false)
    {
        
            $total = $stock["price"] * $row["shares"];
            print("<tbody>");
            print("<tr>");
            print("<td>{$stock["name"]}</td>");
            print("<td>{$stock["symbol"]}</td>");
            print("<td>{$row["shares"]}</td>");
            print("<td>{$stock["price"]}</td>");
            print("<td>{$total}</td>");
            print("</tr>");
            print("</tbody>");
        }
}
 ?>
 </table>