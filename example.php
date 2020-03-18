<?php
use zakirkun\kawalcorona\kawalcoronaApi;
require 'Kawalcorona.php';

$get = new kawalcoronaApi();

// option
// sembuh|meninggal|positif
$option = array(
	'option'	=> 'sembuh'
);
$get->setOption($option);

// region
$get->setRegion('indonesia');

var_dump($get->result());