<?php

$kryptomenyAmount = 0;
$selecetedCurency = "EUR";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $krypt = $_POST["krypt"];
    $mena = $_POST["mena"];   

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.binance.com/api/v3/ticker/price?symbol=" . $krypt . $mena,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST =>"GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    // $data = json_decode($response, true);

    // print_r($data);

    if ($err) {
        echo "Curl Error: " . $err;
    } else {
        $data = json_decode($response, true);
        if(isset($data["code"])) {
            echo "Chyba URL Adresy!";
        } else {
            // print_r($data);

            if (isset($_POST["amount"])) {
                $amount = floatval($_POST["amount"]);
                if ($data && isset($data["price"])) {
                    $price = floatval($data["price"]);
                    $kryptomenyAmount = ($amount * 0.98) / $price;
                //     echo "Za $amount EUR môžete kúpiť: $kryptomenyAmount $krypt";
                // } else {
                //     echo "Chyba pri spracovaní údajov.";
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chlpaté vajcia!</title>
</head>
<body>
<header>
    <h1>Zvol sumu za ktorú by si chcel nakúpiť kryptomeny: <?= $krypt ?></h1>
</header>    
<main>
    <section>
        <form action="result.php" method="post">
            <input type="hidden"
                    name="krypt"
                    value="<?= $krypt ?>"
            ><br>
            <input type="hidden"
                    name="mena"
                    value="<?= $mena ?>"
            ><br>
            <label for="amount">Zadaj sumu v <?= $mena ?></label>
            <br>
            <input type="text"
                    name="amount"
                    id="amount"
                    required
            ><br>
            <input type="submit" value="Vypočítať">
        </form>
    </section>
    <?php if ($kryptomenyAmount > 0): ?>
        <p>Z ceny je odpočítaná provízia 2% za nákup kryptomien.</p>
        <p>Za <?php echo $amount; ?> <?= $mena; ?> môžete kúpiť: <?php echo $kryptomenyAmount; ?> <?php echo $krypt; ?>.</p>
    <?php endif; ?>

</main>
<footer>
    <p>Vajíčka &copy;</p>
</footer>



</body>
</html>
