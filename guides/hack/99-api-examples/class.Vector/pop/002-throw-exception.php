<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Pop\EmptyException;

$v = Vector {};

$last_element = $v->pop(); // Throws InvalidOperationException
