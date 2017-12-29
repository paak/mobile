<?php
/**
* Get Schedule date long format
*
* @param DateTime $dateTime
*
* @return string date long format
*/
function GetScheduleDate($dateTime)
{
	return date('l, F d, Y', strtotime($dateTime));
}

/**
* Get full dayname of week
*
* @param DateTime $dateTime
*
* @return string full dayname
*/
function GetDayOfWeek($dateTime)
{
	return date('l', strtotime($dateTime));
}

/**
* Get day of the month
*
* @param DateTime $dateTime
*
* @return string day of the month with leading zero
*/
function GetDayOfMonth($dateTime)
{
	return date('d', strtotime($dateTime));
}

/**
* Get full month name
*
* @param DateTime $dateTime
*
* @return string full month name
*/
function GetFullMonthName($dateTime)
{
	return date('F', strtotime($dateTime));
}

/**
* Get full month name
*
* @param DateTime $dateTime
*
* @return string Time
*/
function GetTime($dateTime)
{
	return date('H:i', strtotime($dateTime));
}

/**
* Get DateTime with out separator
*
* @param DateTime $dateTime
*
* @return string DateTime with out separator
*/
function GetDateTime($dateTime)
{
	return date('Ymdhis', strtotime($dateTime));
}

/**
* Get Date with out separator
*
* @param DateTime $dateTime
*
* @return string Date with out separator
*/
function GetMyDate($dateTime)
{
	return date('Ymd', strtotime($dateTime));
}

function FormatDate1on1($dateTime)
{
	return date('l, F d Y', strtotime($dateTime));
}

function GetDate1on1($dateTime) 
{
    //i =Day of the month, 2 digits with leading zeros (01 to 31)
    //j =Day of the month without leading zeros (1 to 31)

    //$fullDate = date('l, d F Y, H:i', strtotime($dateTime));
    $fullDate = date('l, j F Y, H:i', strtotime($dateTime));
	$endTime = date('H:i', strtotime($dateTime . ' +30 minutes'));
	
	return "$fullDate - $endTime hrs";
}

