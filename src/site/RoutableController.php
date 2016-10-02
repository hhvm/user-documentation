<?hh // strict

use FredEmmott\HackRouter\IncludeInUriMap;

interface RoutableController extends IncludeInUriMap {
  require extends WebController;
}
