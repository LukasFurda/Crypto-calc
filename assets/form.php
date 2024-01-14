<?php

    require "./classes/class.php";

?>


<form action="result.php" method="post">
    <select name="krypt" id="krypt">
        <?php $krypt->generateKyryptomena(); ?>
        
        <!-- <option value="XRP">XRP</option>
        <option value="SHIB">SHIB</option>
        <option value="MATIC">MATIC</option>
        <option value="ATOM">ATOM</option>
        <option value="BTC">BTC</option> -->

    </select><br>
    <select name="mena" id="mena">
        <?php $mena->generateMena(); ?>



        <!-- <option value="EUR">EUR</option>
        <option value="USDT">USD</option> -->
    </select><br>
    <input type="Submit" value="Odoslať">
</form>
