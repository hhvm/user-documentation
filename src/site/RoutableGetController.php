<?hh // strict

use FredEmmott\HackRouter\IncludeInUriMap;
use FredEmmott\HackRouter\SupportsGetRequests;

interface RoutableGetController extends
RoutableController, SupportsGetRequests {
}
