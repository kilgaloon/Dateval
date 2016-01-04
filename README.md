ReccuringLibrary
================

Create new events, and see when they will repeat by generating results

First you need to create an event like this
 ``` 
 $event = new Event("06 January 2014");
 
 ```
  
```
Example 1:
  $event->repeat("Weekly")
        ->maxRepeats(11);
        
  Event date will be set to 06 January 2014 and i will be repeated every week for limit of 11, which is 11 weeks.
  
  To generate reports on this example run:
    constructor: $report = new Report($event); // report constructor is taking Event object as argument
    usage:       $report->generateDates(from, to, pattern);
    ex:          $report->generateDates("01 March 2014", "31 March 2014");
    
    Pattern is set to default "d M Y", but you can change it any time just passing argument to function like this
    ex:         $report->generateDates("01 March 2014", "31 March 2014", "d m y");
```
```    
Example 2:
  $event->repeat("Daily")
        ->until("15 March 2014");
        
  Event date is set and by generating reports with:
      $report->generateDates("01 March 2014", "31 March 2014");
  
  We will get dates from 01 March 2014 to 15 March 2014, Since event is happening every day starting from 06 January 2014 but we are generating reporst just for dates between 01 March and 31 March
```
```
Example 3:
  $event->repeat("Monday,Wednesday,Friday")
        ->maxRepeats();

  Event date is set and by generating reports with:
      $report->generateDates("01 March 2014", "31 March 2014");

  When repeat have provided argument days separated by commas that means we are searching for event that occurs just on provided days, and with maxRepeats() with not provided argument we are searching it with no limits and that will mean from 01 March to 31 March

```



  There is some more examples and functionalities on this:
```
  $event->repeat("Monday,Wednesday,Friday")
        ->maxRepeats(11);

  $event->repeat("Monday,Wednesday,Friday")
        ->until("15 March 2014");

  $event->repeat(5) // event happens on every fifth day
        ->until("15 March 2014");
```
