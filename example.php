<?php
use zakirkun\kawalcorona\kawalcoronaApi;
require 'Kawalcorona.php';

$option = array(
	'option'	=> 'sembuh'
);

$get = new kawalcoronaApi($option);

$get->result();