<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("vendor/autoload.php");

use Beaver\Dateval\Event as Event;
use Beaver\Dateval\Notifier as Notifier;
use Beaver\Dateval\EmailTemplate as EmailTemplate;

$event = new Event("22 Jun 2016");
$template = new EmailTemplate("emails/birthday");

$event->__set("who", "Strahinja");
$event->__set("startTime", "10:00 PM");

$notify = new Notifier($event, $template);

var_dump($notify);