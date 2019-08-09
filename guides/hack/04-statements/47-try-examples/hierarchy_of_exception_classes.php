<?hh // strict

namespace Hack\UserDocumentation\Statements\Try\Examples\Classes;

class DeviceException extends \Exception { /*...*/ }
class DiskException extends DeviceException { /*...*/ }
class RemovableDiskException extends DiskException { /*...*/ }
class FloppyDiskException extends RemovableDiskException { /*...*/ }

function process(): void {
  throw new DeviceException();
}

<<__EntryPoint>>
function main(): void {
  try {
    process(); // call a function that might generate a disk-related exception
  } catch (FloppyDiskException $fde) {
    echo "In handler for FloppyDiskException\n";
    // ...
  } catch (RemovableDiskException $rde) {
    echo "In handler for RemovableDiskException\n";
    // ...
  } catch (DiskException $de) {
    echo "In handler for DiskException\n";
    // ...
  } catch (DeviceException $dve) {
    echo "In handler for DeviceException\n";
    // ...
  } finally {
    echo "In finally block\n";
    // perform some cleanup
  }
}
