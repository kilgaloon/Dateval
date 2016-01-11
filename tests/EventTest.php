<?php

require_once("src/EventBuilder.php");
require_once("src/Event.php");
require_once("src/Report.php");

class EventTest extends PHPUnit_Framework_TestCase {
    
    public function testRepeatDaily( $a = "Daily" ) {
            if($a == "Daily") {
                    $this->repeat = 1;
                    $this->assertEquals(1, $this->repeat);
                    
            } else if($a == "Weekly") {
                    $this->repeat = 7;                  
                    
            } else {
                    $this->repeat = $a;
            }
            
            return $this;

    }
    
    public function testRepeatWeekly( $a = "Weekly" ) {
            if($a == "Daily") {
                    $this->repeat = 1;
                    
            } else if($a == "Weekly") {
                    $this->repeat = 7;                  
                    $this->assertEquals(7,$this->repeat);
            } else {
                    $this->repeat = $a;
            }
            
            return $this;

    }
    
    public $date = "01 January 2016";
    public $dates = [];
    public function testMaxRepeatsIntereger( $n = 3 ) {
        $repeat = 3;
         // check if is integer provided for repeat
            if(gettype($repeat) == "integer") {
                    $number = $repeat * $n;
                    for($i = 0; $i <= $number; $i += $repeat) {
                            array_push($this->dates, strtotime($this->date .  "+ $i days"));
                    }
                    
                    $this->assertCount(4, $this->dates);
            // else if string is provided then repeat is pointed to some desired days
            } else if(gettype($repeat) == "string") {
                    $repeat = explode(",", $repeat);
                    foreach($repeat as $day) {
                            array_push($this->dates, substr($day, 0, 3));
                    }
                    // if $n is null then just set maxRepeats
                    // this means that we want infinite
                    if($n == null) {
                            $this->maxRepeats = true;
                    } else {// otherwise we want to limit our repeats
                            $this->maxRepeats = $n;
                    }

            }

                
    }

    public function testMaxRepeatsString( $n = 3 ) {
         $repeat = "Monday,Saturday";
         // check if is integer provided for repeat
            if(gettype($repeat) == "integer") {
                    $number = $repeat * $n;
                    for($i = 0; $i <= $number; $i += $repeat) {
                            array_push($this->dates, strtotime($this->date .  "+ $i days"));
                    }
                    
                    
            // else if string is provided then repeat is pointed to some desired days
            } else if(gettype($repeat) == "string") {
                    $repeat = explode(",", $repeat);
                    foreach($repeat as $day) {
                            array_push($this->dates, substr($day, 0, 3));
                    }
                    // if $n is null then just set maxRepeats
                    // this means that we want infinite
                    if($n == null) {
                            $this->maxRepeats = true;
                    } else {// otherwise we want to limit our repeats
                            $this->maxRepeats = $n;
                    }
                    
                    $this->assertCount(2, $this->dates);

            }

                
    }
    
}
