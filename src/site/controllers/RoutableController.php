<?hh // strict

use Facebook\HackRouter\IncludeInUriMap;

interface RoutableController extends IncludeInUriMap {
  require extends WebController;
}
