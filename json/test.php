<?php

$JSON = '{"like":['
            . '{"username":"suraj","password":"abc"},'
            . '{"username":"don","password":"abc"},'
            . '{"username":"rana","password":"abc"}'
            . ']}';

$abd = '{"recent":[
    {"PRODUCT":"asa","QTY":"12","PRICE":"22"},
    {"PRODUCT":"asa","QTY":"12","PRICE":"22"},
    {"PRODUCT":"mom","QTY":"30","PRICE":"10"}
]}';


    $jsonInPHP = json_decode($JSON);
    echo count($jsonInPHP->like)."<br/>";
    
    $js = json_decode($abd);
    echo count($js->recent)."<br/>";
    $fs = $js->recent[0]->PRODUCT;
    $ss = $js->recent[0]->QTY;
    $ts = $js->recent[0]->PRICE;
echo "PRODUCT: ".$fs.
        " ,QTY: ".$ss.
        " ,PRICE: ".$ts.
        "<br/>";

for($i=0 ; $i < count($js->recent) ;$i++){
    $fs = $js->recent[$i]->PRODUCT;
    $ss = $js->recent[$i]->QTY;
    $ts = $js->recent[$i]->PRICE;
    echo "prod: ".$fs.
            " ,qty: ".$ss.
            " ,price: ".$ts.
            "<br/>";
}

?>