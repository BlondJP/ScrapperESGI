<?php 


include('Scrapper.php');

$url = 'http://www.l-agenceweb.com/';
$keyword = 'agence web';

$s = new Scrapper( $keyword, $url);

$s->getAudit();

 ?>