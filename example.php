<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["amount"]) ||
        empty($_POST["order_id"]) ||
        empty($_POST["currency"]) ||
        empty($_POST["notify_url"]) ||
        empty($_POST["success_url"]) ||
        empty($_POST["error_url"]) ||
        empty($_POST["cancel_url"])) {
        $err = "Fill out all the fields";
    }else{
        require_once('init.php');
        $a = new Safimoney\Redirect('fe14bcc0-c264-11e9-b7c4-c39f4af53198','69.B1GZaQ9WwE');

        $payload = [
            'order_id' => $_POST["order_id"],
            'amount' => $_POST["amount"],
            'amount_currency' => $_POST["currency"],
            'notify_url' => $_POST["notify_url"],
            'success_url' => $_POST["success_url"],
            'error_url' => $_POST["error_url"],
            'cancel_url' => $_POST["cancel_url"],
        ];

        $result = $a->createOrder($payload);
        var_dump($result);

        header("Location: ".$result->redirect_url);
        die();

        $result = $a->getOrderDetail($payload);
        var_dump($result);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Market Place</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <?php if(!empty($err)): ?>
    <span class="error">* <?php echo $err;?></span>
    <?php endif;?>
    <br><br>
    Amount: <input type="text" name="amount">
    <br><br>
    Order Id: <input type="text" name="order_id">
    <br><br>
    Currency: <input type="text" name="currency">
    <br><br>
    Notify Url: <input type="text" name="notify_url">
    <br><br>
    Success Url: <input type="text" name="success_url">
    <br><br>
    Error Url: <input type="text" name="error_url">
    <br><br>
    Cancel Url: <input type="text" name="cancel_url">
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
