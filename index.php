<?php


use Beaver\Dateval\Event as Event;
use Beaver\Dateval\Report as Report;

error_reporting(-1);
ini_set('display_errors', 'On');

require_once(__DIR__ . "/vendor/autoload.php");


$event = new Event("01 January 2016");
$event->repeat("Daily")->maxRepeats(10);

$report = new Report($event);

var_dump();










