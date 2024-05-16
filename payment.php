<?php
require_once './config/helper.php';
if(!isset($_POST['purchaseBtn'])){
    echo "<p class='error'><b>PURCHASE BUTTON</b> was not clicked! Please try again.</p>";
}else{
        (isset($_GET['user_id']))?
        $user_id = trim($_GET['user_id']):
        $user_id = "";
        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $sql = "INSERT INTO payment (CustomerID, Subtotal, Total) VALUES (?,?,?)";
        $sql2 = "SELECT * FROM cart WHERE CustomerID = '$user_id'";
                if($result = $con->query($sql2)){
                if(mysqli_num_rows($result) > 0){
                while($record = $result->fetch_object()){
                    (isset($subtotal))?
                    $subtotal = trim($subtotal):
                    $subtotal = 0.00;
                    $subtotal = $subtotal + ($record->Price*$record->Quantity);
                    $shippingFee = 20.00;
                }
                $total = $subtotal + $shippingFee;
                }
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sss', $user_id, $subtotal, $total);
        $stmt->execute();
        if($stmt->affected_rows > 0){
        $user_id = $subtotal = $total = NULL;
            }
        $stmt->close();
        $con->close();
        $result->free();
    }
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Payment</title>
        <link href="css/payment.css" rel="stylesheet" type="text/css"/>
    </head>
    <body style="background-image:url(image/background_1.jpg);
                 background-repeat:no-repeat;
                 background-size:cover;">
        <?php
        include "./header1.php";
        ?>
        <?php
        if(isset($_POST['purchaseBtn'])){
    echo "<center>
        <h1>Payment</h1>
    </center>
    <center>
    <table class='payment' width='60%' height='80%' border='1'>
        <tr>
            <th class='theader' style='text-align:center; width:50%;'>
                Payment Details
            </th>
            <th class='theader' style='text-align:center; width:50%;'>
                Summary
            </th>
        </tr>
        <tr>
        <td>";
            (isset($_GET['user_id']))?
            $user_id = trim($_GET['user_id']):
            $user_id = "";
            printf("<form method='POST' action='paymentResult.php?user_id=%s'>", $user_id);
            echo "<table class='paymentDetails'>
            <tr>";
            echo "<td class='paymentMethod'>Payment Method: <select class='paymentMethods' name='paymentMethod' required>
            <option disabled selected value> -- select an option -- </option>
            <option value='MasterCard'>MasterCard</option>
            <option value='Visa'>Visa</option>
            </select></td>";
            echo "</tr>
            <tr>
            <td class='cardNumber'>
            Card Number:  <input type='text' name='cardNum' value='' size='19' maxlength='19' placeholder='0000 0000 0000 0000' required/>
            </td>
            </tr>
            <tr>
            <td class='expDate'>
                    Expiry Date:  <input type='text' class='expiryDate' name='expDate' value='' size='5' maxlength='5' placeholder='00/00' required/>
            </td>
            </tr>
            <tr>
                <td class='cvv'>
                    CVV Code:  <input type='password' class='cvvCode' name='cvv' value='' size='3' maxlength='3' required/>
                </td>
            </tr>
            <tr>
            <td style='position:relative; left:40px; bottom:10px;'>
            Promotion Code: <input type='text' name='promoCode' value='' placeholder='          Optional'>
            </td>
            </tr>
            </table>
                <center>
                <input type='submit' value='Confirm Purchase' class='purchaseButton' name='purchaseButton'/>";
                (isset($_GET['user_id']))?
                $user_id = trim($_GET['user_id']):
                $user_id = "";
                echo "<input type='button' value='Cancel' class='cancelButton' name='cancelBtn' onclick=\"location='cart.php?user_id=$user_id'\"/>
                </center>
            </form></td>
            <td><table class='summary'>
            <tr>";
            (isset($_GET['user_id']))?
            $user_id = trim($_GET['user_id']):
            $user_id = "";
            $con = new mysqli (DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = "SELECT * FROM cart WHERE CustomerID = '$user_id'";
            $total = 0;
            if($result = $con->query($sql)){
            if(mysqli_num_rows($result) > 0){
            while($record = $result->fetch_object()){
            printf("<td class='product'>Product Name: %s<br/>Total Price: RM%.2lf</td></tr><tr>"
                    ,$record->ProductName,$record->Price*$record->Quantity);
            $total = $total + ($record->Price*$record->Quantity) + $shippingFee;
            }
            }
            }
            $con->close();
            $result->free();
            echo "<td class='total' style='text-align:left;'>Total with shipping fee: </td>
            <td class='totalAmt' style='text-align:right;'>RM$total</td>
        </tr>
    </table></td>
    </table>
    </center>";
        }
        
    ?>
        <?php
        include "./footer1.php";
        ?>
   </body>
</html>