<?php
namespace Blog\Actions\Shops;

use Tiimber\{Action, Traits\RedirectTrait};
use RedBeanPHP\R;

class SaveAction extends Action
{
  use RedirectTrait;

  const EVENTS = [
    'request::producer::logged::shop::create'
  ];
  
  public function onPost($request, $args)
  {
    $post = $request->post;
    $table = "shops";
    
    if ($post->get('siret')) {
      $shop = R::dispense($table);
      $postReady = $this->preparePost($post);
      
      foreach ($postReady as $key=>$value) {
        if (is_array($value)) {
          $value = serialize($value);
        }
        $shop->$key = $value;
      }
      
      if ($post->get("daytable")) {
        $shop->timetable = $this->prepareTimetable($post);
      }

      $id = R::store($shop);
      if (!empty($id)) {
        $this->redirect('/pro/tableau-de-bord');
      } else {
        $this->info("Une erreur s'est produite lors de l'enregistrement dans la base de données");
      }
    }
  }
  
  private function prepareTimetable($post) 
  {
    $daytable = $post->get("daytable");
    $days = explode(",", $daytable);
    $timetable =array();
    
    foreach ($days as $i=>$day) {
      $tag = "split-" . $day;
      $split = $post->get($tag);
      if (!$split) {
        $start = "hour-start-" . $day;
        $end = "hour-end-" . $day;
        $timetable[$day] = ["start" => $post->get($start), "end" => $post->get($end)];
      } else {
        $startAm = "hour-start-am-" . $day;
        $endAm = "hour-end-am-" . $day;
        $startPm = "hour-start-pm-" . $day;
        $endPm = "hour-end-pm-" . $day;
        $timetable[$day] = ["start_morning" => $post->get($startAm), "end_morning" => $post->get($endAm), "start_afternoon" => $post->get($startPm), "end_afternoon" => $post->get($endPm)];
      }
    }
    return serialize($timetable);
  }
  
  private function preparePost ($post) {
    $r = [];
    foreach ($post as $key=>$value) {
      if (preg_match("#^hour|^split|^daytable#", $key)) {
      } else {
        $r[$key] = $value;
      }
    }
    return $r;
  }

}