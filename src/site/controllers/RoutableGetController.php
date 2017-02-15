<?hh // strict

use Facebook\HackRouter\IncludeInUriMap;
use Facebook\HackRouter\SupportsGetRequests;

interface RoutableGetController extends
RoutableController, SupportsGetRequests {
}
