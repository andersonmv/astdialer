<?php

include_once 'config.php';
include_once 'connection.php';
include_once 'lib/phpagi-asmanager.php';

global $managerhost;
global $manageruser;
global $managerpass;

$dbconn = new connection();
//$managerconn = new AGI_AsteriskManager();

$dbconn->connect();
//$managerconn->connect($managerhost, $manageruser, $managerpass) or die("Erro ao conectar ao manager!");

$sql = "SELECT * FROM campaings WHERE state = 'on'";
$campaings = $dbconn->getDataAssoc($sql);

foreach ($campaings as $current_campaing) {

    $id = $current_campaing['id'];

    $sql = "SELECT n.prefix, n.phonenumber FROM numberlist n INNER JOIN campaings c WHERE n.campaing_id = c.id AND c.id = $id";
    $numbers = $dbconn->getDataArray($sql);

    ${"config" . $id} = $current_campaing;

    ${"numberlist" . $id} = Array();

    foreach ($numbers as $current_number) {

        $prefix = $current_number[0];
        $phonenumber = $current_number[1];

        $complete_number = $prefix . $phonenumber;

        array_push(${"numberlist" . $id}, $complete_number);
    }
}

foreach ($campaings as $current_campaing) {

    $id = $current_campaing['id'];
    $current_campaing_settings = ${"config" . $id};
    $current_number_list = ${"numberlist" . $id};

    $calls_counter = 0;
    $total_calls = 0;
    $max_calls = $current_campaing_settings['max_calls'];
    $name = $current_campaing_settings['name'];

    echo "INICIANDO A CAMPANHA $name\n";

    while (!(empty($current_number_list))) {

        if ($calls_counter < $max_calls) {

            $prefix = $current_campaing_settings['prefix'];
            $phonenumber = $current_number_list[0];
            $number_to_dial = $prefix . $phonenumber;
            $destination = "9003";

            echo "NOVA CHAMADA PARA O NUMERO: $phonenumber\n";
            echo "TRANSFERINDO PARA A FILA: $destination\n";

            //$managerconn->Originate($channel, $destination, "from-internal");

            array_pop($current_number_list);
            $calls_counter++;
            $total_calls++;
        } else {
            echo "LIMITE DE CHAMADAS EXCEDIDO!\n";
            $calls_counter = 0;
        }
    }

    echo "TOTAL DE CHAMADAS $total_calls\n";
}