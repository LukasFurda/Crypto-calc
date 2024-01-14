<?php

class SelectOptions{

    private $meny;
    private $kryptomeny;
    

    public function __construct($meny = ["EUR", "USDT"], $kryptomeny = ["XRP", "SHIB", "MATIC", "ATOM", "BTC"])
    {
        $this->meny = $meny;
        $this->kryptomeny = $kryptomeny;
    }

    public function generateMena(){
        foreach ($this->meny as $mena){
            echo "<option value=\"$mena\">$mena</option>";
        }
    }

    public function generateKyryptomena(){
        foreach ($this->kryptomeny as $kryptomena){
            echo "<option value=\"$kryptomena\">$kryptomena</option>";
        }
    }

}

$mena = new SelectOptions();
$krypt = new SelectOptions();