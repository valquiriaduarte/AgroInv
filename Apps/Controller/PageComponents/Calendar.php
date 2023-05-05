<?php

require_once __DIR__ . "/../../Utils/View.php";
require_once __DIR__ . "/../../Utils/Validate.php";

class Calendar{
  private static $month;

  private static function getDaysClassMonth(){
    $nextMonth = strtotime(self::$month);
    echo '<pre>'; print_r($nextMonth); echo '</pre>';
    
    // Aula::get("*", )
  }
  
  private static function verifyMonth(){
    # Verifica todos os dias que vão aparecer na página do calendário:
    #  Se algum dia do mês tiver aula marcada, adiciona classMonth;
    #  Se algum dia do mês for um dia atual, adicione no atributo atualDay;
  }
  static private function constructRows(){
    $dateCount = strtotime("last sunday", strtotime(self::$month));
    $linhas = "";
    for($l = 0; $l < 6; $l++){
      $linhas .= '<tr>';
      for($c = 0; $c < 7; $c++){
        $linhas .= '<th';
        if(date("Y\-m\-d", strtotime("now -3 hours")) == date("Y\-m\-d", $dateCount)) $linhas .= ' class="today"';
        if(date("Y/-m", $dateCount) != date("Y/-m", strtotime(self::$month))) $linhas .= ' class="outMonthDay"';
        $linhas .= '>' . date("d", $dateCount);
        # if(  tiver com aula marcada no dia) $linhas .= '<div class="Mark"></div>';
        $linhas .= '</p></th>';
        $dateCount = strtotime("+1 day", $dateCount);
      }
      $linhas .= '</tr>';
    }
    return $linhas;
  }
  
  # Avança ou retrocede o mês
  static private function prevMonth(){
    return date("Y\-m\-d", strtotime("-1 month", strtotime(self::$month)));
  }
  static private function nextMonth(){
    return date("Y\-m\-d", strtotime("+1 month", strtotime(self::$month)));
  }
  
  static private function setDate($request){

    # Se for get pega a data atual
    if($request == ''){
      self::$month = Date("Y\-m\-01", strtotime("now -3 hours"));
    } else{ # Se for post verifica qual foi a função requisitada e usa-a
      if(isset($request->getPostVars()["prev"])) self::$month = $request->getPostVars()["prev"];
      if(isset($request->getPostVars()["next"])) self::$month = $request->getPostVars()["next"];
    }
    
  }

  # Troca o nome em ingês pelo em português
  static private function replaceName(){
    $names = ['December' => 'Dezembro', 'November' => 'Novembro', 'October' => 'Outubro', 'September' => 'Setembro', 'August' => 'Agosto', 'July' => 'Julho', 'June' => 'Junho', 'March' => 'Março', 'May' => 'Maio', 'April' => 'Abril', 'February' => 'Fevereiro', 'January' => 'Janeiro'];
    return str_replace(array_keys($names), array_values($names), date("F Y", strtotime(self::$month)));
  }
  
  static function getCalendar($request){

    
    self::setDate($request);
    # self::getDaysClassMonth();
    
    return View::render("Calendar", [
      "next" => self::nextMonth(),
      "prev" => self::prevMonth(),
      "month" => self::replaceName(),
      "dias" => self::constructRows()
    ]);
  }
}