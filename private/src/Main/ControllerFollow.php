<?php
namespace Main;

use DocBlock\Parser;
use Main\Event\Event;
use Main\Http\RequestInfo;
use Main\View\BaseView;

class ControllerFollow
{
  private $uri, $method;

  public function __construct($uri = null, $method = null)
  {
    $this->uri = $uri;
    $this->method = $method;
  }

  public function getUri()
  {
    return $this->uri;
  }

  public function getMethod()
  {
    return $this->method;
  }
}
