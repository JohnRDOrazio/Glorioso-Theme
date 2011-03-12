<?php

set_include_path($_SERVER['DOCUMENT_ROOT']."themes/glorioso/include/" . PATH_SEPARATOR . get_include_path() );
/**
 * @see Zend_Loader
 */
require_once 'Zend/Loader.php';
/**
 * @see Zend_Gdata
 */
Zend_Loader::loadClass('Zend_Gdata');


/**
 * @see Zend_Gdata_ClientLogin
 */
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');

/**
 * @see Zend_Gdata_HttpClient
 */
Zend_Loader::loadClass('Zend_Gdata_HttpClient');

/**
 * @see Zend_Gdata_Calendar
 */
Zend_Loader::loadClass('Zend_Gdata_Calendar');

	$user = $_POST['username'];
	$pass = $_POST['password'];
  //$user = '';
  //$pass = '';
  $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
  $tzOffset="+00";
  $client = Zend_Gdata_ClientLogin::getHttpClient($user,$pass,$service);

  $gdataCal = new Zend_Gdata_Calendar($client);
  $newEvent = $gdataCal->newEventEntry();

  $newEvent->title = $gdataCal->newTitle($_POST["fc_ev_title"]);
  $newEvent->where = array($gdataCal->newWhere($_POST["fc_ev_where"]));
  $newEvent->content = $gdataCal->newContent($_POST["fc_ev_desc"]);
  $newEntry->content->type = 'text';

  $when = $gdataCal->newWhen();
  $startDate = $_POST["fc_ev_startDate"];
  $startTime = $_POST["fc_ev_startTime"];
  $endDate = $_POST["fc_ev_endDate"];
  $endTime = $_POST["fc_ev_endTime"];
  $when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
  $when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
  $newEvent->when = array($when);

  // Upload the event to the calendar server
  // A copy of the event as it is recorded on the server is returned
  $createdEvent = $gdataCal->insertEvent($newEvent);

  $myid = $createdEvent->id->text;
  echo "Event created with id = ".$myid;

?>