<?php

//--------------------------------------------------------------------------------------------------
// Utilities for our event-fetching scripts.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// PHP will fatal error if we attempt to use the DateTime class without this being set.
date_default_timezone_set('UTC');


class Event {

	// Tests whether the given ISO8601 string has a time-of-day or not
	const ALL_DAY_REGEX = '/^\d{4}-\d\d-\d\d$/'; // matches strings like "2013-12-29"

	public $title;
	public $allDay; // a boolean
	public $start; // a DateTime
	public $end; // a DateTime, or null
	public $properties = array(); // an array of other misc properties


	// Constructs an Event object from the given array of key=>values.
	// You can optionally force the timezone of the parsed dates.
	public function __construct($array, $timezone=null) {

		$this->title = $array['title'];

		if (isset($array['allDay'])) {
			// allDay has been explicitly specified
			$this->allDay = (bool)$array['allDay'];
		}
		else {
			// Guess allDay based off of ISO8601 date strings
			$this->allDay = preg_match(self::ALL_DAY_REGEX, $array['start']) &&
				(!isset($array['end']) || preg_match(self::ALL_DAY_REGEX, $array['end']));
		}

		if ($this->allDay) {
			// If dates are allDay, we want to parse them in UTC to avoid DST issues.
			$timezone = null;
		}

		// Parse dates
		$this->start = parseDateTime($array['start'], $timezone);
		$this->end = isset($array['end']) ? parseDateTime($array['end'], $timezone) : null;

		// Record misc properties
		foreach ($array as $name => $value) {
			if (!in_array($name, array('title', 'allDay', 'start', 'end'))) {
				$this->properties[$name] = $value;
			}
		}
	}


	// Returns whether the date range of our event intersects with the given all-day range.
	// $rangeStart and $rangeEnd are assumed to be dates in UTC with 00:00:00 time.
	public function isWithinDayRange($rangeStart, $rangeEnd) {

		// Normalize our event's dates for comparison with the all-day range.
		$eventStart = stripTime($this->start);
		$eventEnd = isset($this->end) ? stripTime($this->end) : null;

		if (!$eventEnd) {
			// No end time? Only check if the start is within range.
			return $eventStart < $rangeEnd && $eventStart >= $rangeStart;
		}
		else {
			// Check if the two ranges intersect.
			return $eventStart < $rangeEnd && $eventEnd > $rangeStart;
		}
	}


	// Converts this Event object back to a plain data array, to be used for generating JSON
	public function toArray() {

		// Start with the misc properties (don't worry, PHP won't affect the original array)
		$array = $this->properties;

		$array['title'] = $this->title;

		// Figure out the date format. This essentially encodes allDay into the date string.
		if ($this->allDay) {
			$format = 'Y-m-d'; // output like "2013-12-29"
		}
		else {
			$format = 'c'; // full ISO8601 output, like "2013-12-29T09:00:00+08:00"
		}

		// Serialize dates into strings
		$array['start'] = $this->start->format($format);
		if (isset($this->end)) {
			$array['end'] = $this->end->format($format);
		}

		return $array;
	}

}


// Date Utilities
//----------------------------------------------------------------------------------------------


// Parses a string into a DateTime object, optionally forced into the given timezone.
function parseDateTime($string, $timezone=null) {
	$date = new DateTime(
		$string,
		$timezone ? $timezone : new DateTimeZone('UTC')
			// Used only when the string is ambiguous.
			// Ignored if string has a timezone offset in it.
	);
	if ($timezone) {
		// If our timezone was ignored above, force it.
		$date->setTimezone($timezone);
	}
	return $date;
}


// Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
// but in UTC.
function stripTime($datetime) {
	return new DateTime($datetime->format('Y-m-d'));
}



function div($a, $b)
{
   return (int) ($a / $b);
} 

function jalali_to_gregorian($j_y, $j_m, $j_d)
{

$g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

$j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);


 
$jy = $j_y-979;

$jm = $j_m-1;

$jd = $j_d-1;

 

$j_day_no = 365*$jy + div($jy, 33)*8 + div($jy%33+3, 4);

for ($i=0; $i < $jm; ++$i)
	$j_day_no += $j_days_in_month[$i];

 

$j_day_no += $jd;

 

$g_day_no = $j_day_no+79;



$gy = 1600 + 400*div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */

$g_day_no = $g_day_no % 146097;

 

$leap = true;

if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */
{

	$g_day_no--;
	
	$gy += 100*div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */
	
	$g_day_no = $g_day_no % 36524;
	
	 
	
	if ($g_day_no >= 365)
		$g_day_no++;
	else
		$leap = false;
}

 

$gy += 4*div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */

$g_day_no %= 1461;

 

if ($g_day_no >= 366) {
	$leap = false;

 

$g_day_no--;

$gy += div($g_day_no, 365);

$g_day_no = $g_day_no % 365;

}

 

for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
	$g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);

$gm = $i+1;

$gd = $g_day_no+1;

 if($gm<10)
 	$gm="0".$gm;
 if($gd<10)
 	$gd="0".$gd;

return array($gy, $gm, $gd);

}

 
