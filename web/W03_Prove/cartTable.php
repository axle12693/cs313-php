<?php
    session_start();
    $costs = array("dr" => 1000000, "ph" => 500000, "hy"=>250000);
    $names = array("dr" => "Dragon", "ph" => "Phoenix", "hy" => "Hydra");
    $total = 0;
    $out = "";
    foreach ($_SESSION["ItemsList"] as $item => $buying)
    {
        if ($buying)
        {
            $total += $costs[$item];
            $out = $out . "<tr id=\"$item\" class=\"itemtr\">
                  <td>$names[$item]</td>
                  <td>\$$costs[$item]</td>";
            if (!isset($confirm))
            {
                $out = $out . "<td><button value=\"Remove from cart\" id=\"$item\">Remove from cart</button></td>";
            }
                  
            $out = $out . "</tr>";
        }
    }
    $out = $out . "<tr>
          <td>Total:</td>
          <td>\$$total</td>
          </tr>";
    echo($out);
?>