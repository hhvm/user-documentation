<?hh

namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock\ParamTag;

class Stringify {
  public static function typehint(TypehintDocumentation $typehint): string {
    $s = $typehint['typename'];
    if ($typehint['genericTypes']) {
      $s .= '<';
      $s .= implode(
        ',',
        array_map(
          $typehint ==> Stringify::typehint(/* UNSAFE_EXPR */ $typehint),
          $typehint['genericTypes'],
        ),
      );
      $s .= '>';
    }
    return $s;
  }

  public static function parameter(
    ParameterDocumentation $param,
    ?ParamTag $tag,
  ): string {
    $name = $param['name'];

    $s = '';
    $types = $tag?->getTypes();
    if ($types !== null) {
      $s .= '['.implode('|',$types).'] ';
    } else {
      $th = $param['typehint'];
      if ($th !== null) {
        $s .= Stringify::typehint($th).' ';
      }
    }

    if ($param['isVariadic']) {
      $s .= '...';
    }
    if ($param['isPassedByReference']) {
      $s .= '&';
    }
    $s .= '$'.$param['name'];

    if ($param['isOptional']) {
      $default = $param['default'];
      invariant(
        $default !== null,
        'optional parameter without a default',
      );
      $s .= ' = '.$default;
    }
    return $s;
  }
}
