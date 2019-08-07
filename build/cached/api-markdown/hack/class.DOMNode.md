``` yamlmeta
{
    "name": "DOMNode",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/domdocument/ext_domdocument.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_dom.hhi"
    ],
    "class": "DOMNode"
}
```




## Interface Synopsis




``` Hack
class DOMNode {...}
```




### Public Methods




+ [` ->C14N(bool $exclusive = false, bool $with_comments = false, ?darray $xpath = NULL, ?varray $ns_prefixes = NULL): string `](</hack/reference/class/DOMNode/C14N/>)
+ [` ->C14NFile(string $uri, bool $exclusive = false, bool $with_comments = false, ?darray $xpath = NULL, ?varray $ns_prefixes = NULL): int `](</hack/reference/class/DOMNode/C14NFile/>)
+ [` ->__construct(): void `](</hack/reference/class/DOMNode/__construct/>)
+ [` ->__debuginfo(): array `](</hack/reference/class/DOMNode/__debuginfo/>)
+ [` ->appendChild<T as DOMNode>(DOMNode $newnode): T `](</hack/reference/class/DOMNode/appendChild/>)\
  This functions appends a child to an existing list of children or creates
  a new list of children
+ [` ->c14n(bool $exclusive = false, bool $with_comments = false, mixed $xpath = NULL, mixed $ns_prefixes = NULL): mixed `](</hack/reference/class/DOMNode/c14n/>)
+ [` ->c14nfile(string $uri, bool $exclusive = false, bool $with_comments = false, mixed $xpath = NULL, mixed $ns_prefixes = NULL): mixed `](</hack/reference/class/DOMNode/c14nfile/>)
+ [` ->cloneNode(bool $deep = false): this `](</hack/reference/class/DOMNode/cloneNode/>)\
  Creates a copy of the node
+ [` ->getLineNo(): int `](</hack/reference/class/DOMNode/getLineNo/>)\
  Gets line number for where the node is defined
+ [` ->getNodePath(): mixed `](</hack/reference/class/DOMNode/getNodePath/>)
+ [` ->hasAttributes(): bool `](</hack/reference/class/DOMNode/hasAttributes/>)\
  This method checks if the node has attributes
+ [` ->hasChildNodes(): bool `](</hack/reference/class/DOMNode/hasChildNodes/>)\
  This function checks if the node has children
+ [` ->insertBefore<T as DOMNode>(DOMNode $newnode, DOMNode $refnode = NULL): T `](</hack/reference/class/DOMNode/insertBefore/>)\
  This function inserts a new node right before the reference node
+ [` ->isDefaultNamespace(string $namespaceuri): bool `](</hack/reference/class/DOMNode/isDefaultNamespace/>)\
  Tells whether namespaceURI is the default namespace
+ [` ->isSameNode(DOMNode $node): bool `](</hack/reference/class/DOMNode/isSameNode/>)\
  This function indicates if two nodes are the same node
+ [` ->isSupported(string $feature, string $version): bool `](</hack/reference/class/DOMNode/isSupported/>)\
  Checks if the asked feature is supported for the specified version
+ [` ->lookupNamespaceUri(mixed $namespaceuri): string `](</hack/reference/class/DOMNode/lookupNamespaceUri/>)\
  Gets the namespace URI of the node based on the prefix
+ [` ->lookupPrefix(string $namespaceURI): string `](</hack/reference/class/DOMNode/lookupPrefix/>)\
  Gets the namespace prefix of the node based on the namespace URI
+ [` ->normalize(): void `](</hack/reference/class/DOMNode/normalize/>)\
  Normalizes the node
+ [` ->removeChild(DOMNode $node): DOMNode `](</hack/reference/class/DOMNode/removeChild/>)\
  This functions removes a child from a list of children
+ [` ->replaceChild<T as DOMNode>(DOMNode $newchildobj, DOMNode $oldchildobj): T `](</hack/reference/class/DOMNode/replaceChild/>)\
  This function replaces the child oldnode with the passed new node
<!-- HHAPIDOC -->
