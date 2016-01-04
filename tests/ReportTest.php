<?php

use Beaver\Dateval\Event as Event;

class ReportTest extends PHPUnit_Framework_TestCase {
    private $eventObject;
    public $reportDates = [];
    
    public function createEvent() {
        $event = new Event("1 January 2016");
        $event->repeat("Daily")->maxRepeats(14);

        $this->eventObject = $event;
    }
    
    public function testgenerateDates($from = "1 January 2016", $to = '31 January 2016', $pattern = null ) {
        $this->createEvent();
        
        $to = strtotime($to); // convert string to timestamp
        $from = strtotime($from); // convert string to timestamp
        if($pattern == null) $pattern = "d m Y"; // set default pattern if its not set
        // if repeat is on integer then repeat going to happen Daily or Weekly
        if(gettype($this->eventObject->repeat) == "integer") {
            for($i = 0; $i < sizeof($this->eventObject->dates); $i++) {
                if($this->eventObject->dates[$i] >= $from && $this->eventObject->dates[$i] <= $to) {
                    array_push($this->reportDates, date($pattern,$this->eventObject->dates[$i]));
                    
                }
            }
            
            
        // else desired days will be provided
        } else {
            // when days are provided, we check are there any end points
            // if maxRepeats are set then we want to give some limits or no limits to our loop
            if(isset($this->eventObject->maxRepeats)) {
                    // place where to check do we want to limir our look if integer then loop will be limited to that number
                if(gettype($this->eventObject->maxRepeats) == "integer") {
                    // loop through all days
                    for($i = 0; $i <= $this->eventObject->maxRepeats; $i += 1) {
                        $date = strtotime("+ $i days", $from);
                        $day = date("D", $date);
                        // check if looped day is in choosen days and push it to report dates
                        if(in_array($day, $this->eventObject->dates)) {
                            array_push($this->reportDates, date($pattern,$date));
                        }
                    }
                // else loop will be infinite and will print out whole dates from provided $from and $to in generateRange($from, $to)
                } else {
                    //calculate days between choosen dates
                    $daysBetween = round( ($to - $from) / self::SEC_IN_DAY );
                    // loop through all days
                    for($i = 0; $i <= $daysBetween; $i += 1) {
                        $date = strtotime("+ $i days", $from);
                        $day = date("D", $date);
                        // check if looped day is in choosen days and push it to report dates
                        if(in_array($day, $this->eventObject->dates)) {
                            array_push($this->reportDates, date($pattern,$date));
                        }
                    }
                }
                // else if we dont want to limit our loop to some number, we can also limit it to desired date
            } elseif(isset($this->eventObject->until)) {
                $to = strtotime($this->eventObject->until);
                //calculate days between choosen dates
                $daysBetween = round( ($to - $from) / self::SEC_IN_DAY );
                // loop through all days
                for($i = 0; $i <= $daysBetween; $i += 1) {
                    $date = strtotime("+ $i days", $from);
                    $day = date("D", $date);
                    // check if looped day is in choosen days and push it to report dates
                    if(in_array($day, $this->eventObject->dates)) {
                        array_push($this->reportDates, date($pattern,$date));
                    }
                }

            }
        } 
        
        $this->assertCount(15, $this->reportDates);
    }
    
}
