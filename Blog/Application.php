<?php
namespace Blog;

use Tiimber\Traits\{ApplicationTrait as Tiimber, ServerTrait as Server};
use Tiimber\Loggers\SysLogger as Logger;

use RedBeanPHP\R;

class Application
{
 use Tiimber;

 use Server;
 
 private function prepare()
 {
   $this->setRoot(dirname(__DIR__));
   $this->setCacheFolder(dirname(__DIR__) . '/cache');
   #R::setup('mysql:host=localhost;dbname=c9', 'dious', '');
   $this->setHost('0.0.0.0');
   $this->setPort(8080);
   (new Logger());
 }

 public function start()
 {
   $this->prepare();
   $this->chop();
   $this->runHttpServer($this->runApp());
 }
}