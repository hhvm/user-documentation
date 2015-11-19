<?hh // strict

namespace HHVM\UserDocumentation;

use phpDocumentor\Reflection\DocBlock\Tag\ReturnTag;

class Stringify {
  public static function typehint(TypehintDocumentation $typehint): string {
    $s = $typehint['nullable'] ? '?' : '';
    $s .= $typehint['typename'];

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
    ?ReturnTag $tag,
  ): string {
    $name = $param['name'];

    $s = '';
    $types = $tag?->getTypes();
    if ($types !== null && $types !== []) {
      $s .= implode('|',$types).' ';
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
      // TODO: It looked like @fredemmott's ScannedParameter class handled
      // normalizing an empty string to "\"\"", but it gets lost somewhere
      // before here. This allows default "" parameters to show up though. It
      // just may be in a non-optimal place in the pipeline.
      if ($default === "") {
        $default = "\"\"";
      }
      invariant(
        $default !== null,
        'optional parameter without a default',
      );
      $s .= ' = '.$default;
    }
    return $s;
  }
}
