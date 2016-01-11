<?php

namespace Beaver\Dateval;

abstract class EventBuilder {
    public  $date, // string date
            $time, // integer date || timestamp
            $repeat, // integer how much times event will repeat
            $until, // string of date until event will repeat
            $maxRepeats; // integer how much maximum repeats event will occured
    
    public $dates = [];  
    
// seconds in day needed to calculate number of days 
    // between two days ( starting date, ending date )
    const SEC_IN_DAY = 86400; 
    // @a 	string/integer	set when same event will repeat again, 
    // Daily, Weekly or set specific days when to repeat
    final public function repeat( $a ) {
            if($a == "Daily") {
                    $this->repeat = 1;
            } else if($a == "Weekly") {
                    $this->repeat = 7;
            } else {
                    $this->repeat = $a;
            }
    return $this;

    }
    // end
    // @n 		integer 	how much times event will repeat
    final public function maxRepeats( $n = null ) {	
            // check if is integer provided for repeat
            if(gettype($this->repeat) == "integer") {
                    $number = $this->repeat * $n;
                    for($i = 0; $i <= $number; $i += $this->repeat) {
                            array_push($this->dates, strtotime($this->date .  "+ $i days"));
                    }
            // else if string is provided then repeat is pointed to some desired days
            } else if(gettype($this->repeat) == "string") {
                    $this->repeat = explode(",", $this->repeat);
                    foreach($this->repeat as $day) {
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

    return $this;


    }
    // end
    // @date 	string 		until what date event will last
    final public function until( $date ) {
            $eventStart = $this->time; // already converted to timestamp on setDate method
            $repeatUntil = strtotime($date);
            // calculate number of days between starting day of event and end date
            $daysBetween = round( ($repeatUntil - $eventStart) / self::SEC_IN_DAY ); 
            // check if is integer provided for repeat
            if(gettype($this->repeat) == "integer") {

                    for($i = 0; $i <= $daysBetween; $i += $this->repeat) {
                            array_push($this->dates, strtotime($this->date .  "+ $i days"));
                    }
            // else if string is provided then repeat is pointed to some desired days
            } else if(gettype($this->repeat) == "string") {
                    $this->repeat = explode(",", $this->repeat);
                    foreach($this->repeat as $day) {
                            array_push($this->dates, substr($day, 0, 3));
                    }
                    $this->until = $date;
            }



    }
    // end
    // constructor for new event
    final public function __construct($date) {
            $this->date = $date;
            $this->time = strtotime($date);
    }
}
