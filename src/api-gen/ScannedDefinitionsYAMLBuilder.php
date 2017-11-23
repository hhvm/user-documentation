<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation;

use Facebook\DefinitionFinder\FileParser;
use Facebook\DefinitionFinder\ScannedClass;
use Facebook\DefinitionFinder\ScannedBase;
use Facebook\DefinitionFinder\ScannedFunctionAbstract;
use Facebook\DefinitionFinder\ScannedMethod;
use Facebook\DefinitionFinder\ScannedTypehint;
use Facebook\DefinitionFinder\ScannedGeneric;
use Facebook\DefinitionFinder\ScannedParameter;
use Facebook\DefinitionFinder\HasScannedGenerics;

use namespace HH\Lib\{Str, Vec};

class ScannedDefinitionsYAMLBuilder {
  private Vector<ScannedDefinitionFilter> $filters = Vector { };

  public function __construct(
    private DocumentationSource $source,
    private FileParser $parser,
    private string $destination,
  ) {
  }

  public function addFilter(ScannedDefinitionFilter $filter): this {
    $this->filters[] = $filter;
    return $this;
  }

  public function build(): vec<string> {
    $files = Vec\concat(
      $this->buildDefinitions(
        APIDefinitionType::CLASS_DEF,
        $this->parser->getClasses(),
        $x ==> $this->getClassDocumentation($x),
      ),
      $this->buildDefinitions(
        APIDefinitionType::INTERFACE_DEF,
        $this->parser->getInterfaces(),
        $x ==> $this->getClassDocumentation($x),
      ),
      $this->buildDefinitions(
        APIDefinitionType::TRAIT_DEF,
        $this->parser->getTraits(),
        $x ==> $this->getClassDocumentation($x),
      ),
      $this->buildDefinitions(
        APIDefinitionType::FUNCTION_DEF,
        $this->parser->getFunctions(),
        $x ==> $this->getFunctionDocumentation($x),
      ),
    );
    return $files;
  }

  private function buildDefinitions<T as ScannedBase>(
    APIDefinitionType $type,
    \ConstVector<T> $defs,
    (function(T):shape('name' => string, ...)) $converter,
  ): vec<string> {
    if ($type === APIDefinitionType::FUNCTION_DEF) {
      $shape_type = FunctionYAML::class;
    } else {
      $shape_type = ClassYAML::class;
    }

    $defs = $this->filtered($defs);
    $writer = new YAMLWriter($this->destination);
    return Vec\map(
      $defs,
      $def ==> $writer->write(
        $shape_type,
        shape(
          'sources' => vec[$this->source],
          'type' => $type,
          'data' => $converter($def),
        ),
      ),
    );
  }

  private function filtered<T as ScannedBase>(
    \ConstVector<T> $list,
  ): \ConstVector<T> {
    foreach ($this->filters as $filter) {
      // https://github.com/facebook/hhvm/issues/5919
      $list = $list->filter($v ==> $filter($v));
    }
    return $list;
  }

  private function getClassDocumentation(
    ScannedClass $class,
  ): ClassDocumentation {
    $type = APIDefinitionType::CLASS_DEF;
    if ($class->isInterface()) {
      $type = APIDefinitionType::INTERFACE_DEF;
    } else if ($class->isTrait()) {
      $type = APIDefinitionType::TRAIT_DEF;
    }

    $name = $class->getName();
    $namespace = $class->getNamespaceName();
    $shortName = $class->getShortName();

    return shape(
      'name' => $name,
      'namespace' => $namespace,
      'shortName' => $shortName,
      'type' => $type,
      'methods' => $class
        ->getMethods()
        ->map($m ==> $this->getMethodDocumentation($type, $name, $m))
        |> vec($$),
      'generics' => $class
        ->getGenericTypes()
        ->map($gt ==> self::GetGenericDocumentation($gt))
        |> vec($$),
      'parent' =>
        self::GetNullableTypehintDocumentation($class->getParentClassInfo()),
      'interfaces' => $class
        ->getInterfaceInfo()
        ->map($interface ==> self::GetTypehintDocumentation($interface))
        |> vec($$),
      'docComment' => $class->getDocComment(),
    );
  }

  private function getFunctionDocumentation(
    ScannedFunctionAbstract $function,
  ): FunctionDocumentation {
    $deprecationMessage =
      $function->getAttributes()->get('__Deprecated')?->at(0);
    return shape(
      'name' => $function->getName(),
      'returnType' =>
        self::GetNullableTypehintDocumentation($function->getReturnType()),
      'generics' => $function
        ->getGenericTypes()
        ->map($gt ==> self::GetGenericDocumentation($gt))
        |> vec($$),
      'docComment' => $function->getDocComment(),
      'parameters' => $function
        ->getParameters()
        ->map($p ==> self::GetParameterDocumentation($p))
        |> vec($$),
      'deprecation' => $deprecationMessage !== null ?
        (string) $deprecationMessage : null,
    );
  }

  private function getMethodDocumentation(
    APIDefinitionType $class_type,
    string $class_name,
    ScannedMethod $method,
  ): MethodDocumentation {
    $ret = $this->getFunctionDocumentation($method);

    $ret['static'] = $method->isStatic();

    if ($method->isPublic()) {
      $ret['visibility'] = MemberVisibility::PUBLIC;
    } else if ($method->isPrivate()) {
      $ret['visibility'] = MemberVisibility::PRIVATE;
    } else {
      invariant(
        $method->isProtected(),
        'method with no visibility: %s',
        var_export($method, true),
      );
      $ret['visibility'] = MemberVisibility::PROTECTED;
    }

    $ret['className'] = $class_name;
    $ret['classType'] = $class_type;

    return $ret;
  }

  private static function GetParameterDocumentation(
    ScannedParameter $param,
  ): ParameterDocumentation {
    return shape(
      'name' => $param->getName(),
      'typehint' =>
        self::GetNullableTypehintDocumentation($param->getTypehint()),
      'isVariadic' => $param->isVariadic(),
      'isPassedByReference' => $param->isPassedByReference(),
      'isOptional' => $param->isOptional(),
      'default' =>
        $param->isOptional() ? $param->getDefaultString() : null,
    );
  }

  private static function GetGenericDocumentation(
    ScannedGeneric $g,
  ): GenericDocumentation {
    if ($g->getConstraints()->isEmpty()) {
       return shape(
         'name' => $g->getName(),
         'constraint' => null,
       );
    }
    return shape(
      'name' => $g->getName(),
      'constraint' => $g->getConstraints()
        |> Vec\map($$, $it ==> $it['relationship'].' '.$it['type'])
        |> Str\join($$, ' '),
    );
  }

  private static function GetTypehintDocumentation(
    ScannedTypehint $typehint,
  ): TypehintDocumentation {
    return shape(
      'typename' => $typehint->getTypeName(),
      'typetext' => $typehint->getTypeText(),
      'nullable' => $typehint->isNullable(),
      'genericTypes' =>
        $typehint
        ->getGenericTypes()
        ->map($th ==> self::GetTypehintDocumentation($th))
        |> vec($$),
    );
  }

  private static function GetNullableTypehintDocumentation(
    ?ScannedTypehint $typehint,
  ): ?TypehintDocumentation {
    if ($typehint === null) {
      return null;
    }
    return self::GetTypehintDocumentation($typehint);
  }
}
