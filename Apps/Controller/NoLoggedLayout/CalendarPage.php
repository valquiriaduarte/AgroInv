<?php
require_once __DIR__ . "/../../Utils/View.php";
require_once __DIR__ . "/../PageComponents/Calendar.php";
require_once __DIR__ . "/NoLoggedLayout.php";

class CalendarPage extends NoLoggedLayout{
  static function get($request = ''){

    $title = 'Calendário';
    
    return parent::getPage(View::render("CalendarPage" , [
                        "calendar" => Calendar::getCalendar($request),
    ]), 'Calendário', $title);
  }
}