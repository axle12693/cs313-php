<?php
    $total = 0;
    $out = "";
    foreach ($_SESSION["ItemsList"] as $item => $buying)
    {
        if ($buying)
        {
            $total += $costs[$item];
            $out = $out . "<tr id=\"$item\" class=\"itemtr\">
                  <td>$names[$item]</td>
                  <td>\$$costs[$item]</td>
                  <td><button value=\"Remove from cart\" id=\"$item\">Remove from cart</button></td>
                  </tr>";
        }
    }
    $out = $out . "<tr>
          <td>Total:</td>
          <td>\$$total</td>
          </tr>";
    echo($out);
?>