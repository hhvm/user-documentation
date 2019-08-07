``` yamlmeta
{
    "name": "XMLWriter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xmlwriter/ext_xmlwriter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xmlwriter.hhi"
    ],
    "class": "XMLWriter"
}
```




## Interface Synopsis




``` Hack
class XMLWriter {...}
```




### Public Methods




+ [` ->__construct() `](</hack/reference/class/XMLWriter/__construct/>)
+ [` ->endAttribute(): bool `](</hack/reference/class/XMLWriter/endAttribute/>)
+ [` ->endCData(): bool `](</hack/reference/class/XMLWriter/endCData/>)
+ [` ->endComment(): bool `](</hack/reference/class/XMLWriter/endComment/>)
+ [` ->endDTD(): bool `](</hack/reference/class/XMLWriter/endDTD/>)
+ [` ->endDTDAttlist(): bool `](</hack/reference/class/XMLWriter/endDTDAttlist/>)
+ [` ->endDTDElement(): bool `](</hack/reference/class/XMLWriter/endDTDElement/>)
+ [` ->endDTDEntity(): bool `](</hack/reference/class/XMLWriter/endDTDEntity/>)
+ [` ->endDocument(): bool `](</hack/reference/class/XMLWriter/endDocument/>)
+ [` ->endElement(): bool `](</hack/reference/class/XMLWriter/endElement/>)
+ [` ->endPI(): bool `](</hack/reference/class/XMLWriter/endPI/>)
+ [` ->flush(?bool $empty = true): mixed `](</hack/reference/class/XMLWriter/flush/>)
+ [` ->fullEndElement(): bool `](</hack/reference/class/XMLWriter/fullEndElement/>)
+ [` ->openMemory(): bool `](</hack/reference/class/XMLWriter/openMemory/>)
+ [` ->openURI(string $uri): bool `](</hack/reference/class/XMLWriter/openURI/>)
+ [` ->outputMemory(?bool $flush = true): string `](</hack/reference/class/XMLWriter/outputMemory/>)
+ [` ->setIndent(bool $indent): bool `](</hack/reference/class/XMLWriter/setIndent/>)
+ [` ->setIndentString(string $indentstring): bool `](</hack/reference/class/XMLWriter/setIndentString/>)
+ [` ->startAttribute(string $name): bool `](</hack/reference/class/XMLWriter/startAttribute/>)
+ [` ->startAttributeNS(string $prefix, string $name, string $uri): bool `](</hack/reference/class/XMLWriter/startAttributeNS/>)
+ [` ->startCData(): bool `](</hack/reference/class/XMLWriter/startCData/>)
+ [` ->startComment(): bool `](</hack/reference/class/XMLWriter/startComment/>)
+ [` ->startDTD(string $qualifiedname, ?string $publicid = NULL, ?string $systemid = NULL): bool `](</hack/reference/class/XMLWriter/startDTD/>)
+ [` ->startDTDAttlist(string $name): bool `](</hack/reference/class/XMLWriter/startDTDAttlist/>)
+ [` ->startDTDElement(string $qualifiedname): bool `](</hack/reference/class/XMLWriter/startDTDElement/>)
+ [` ->startDTDEntity(string $name, bool $isparam): bool `](</hack/reference/class/XMLWriter/startDTDEntity/>)
+ [` ->startDocument(?string $version = '1.0', ?string $encoding = NULL, ?string $standalone = NULL): bool `](</hack/reference/class/XMLWriter/startDocument/>)
+ [` ->startElement(string $name): bool `](</hack/reference/class/XMLWriter/startElement/>)
+ [` ->startElementNS(mixed $prefix, string $name, mixed $uri): bool `](</hack/reference/class/XMLWriter/startElementNS/>)
+ [` ->startPI(string $target): bool `](</hack/reference/class/XMLWriter/startPI/>)
+ [` ->text(string $content): bool `](</hack/reference/class/XMLWriter/text/>)
+ [` ->writeAttribute(string $name, string $value): bool `](</hack/reference/class/XMLWriter/writeAttribute/>)
+ [` ->writeAttributeNS(string $prefix, string $name, string $uri, string $content): bool `](</hack/reference/class/XMLWriter/writeAttributeNS/>)
+ [` ->writeCData(string $content): bool `](</hack/reference/class/XMLWriter/writeCData/>)
+ [` ->writeComment(string $content): bool `](</hack/reference/class/XMLWriter/writeComment/>)
+ [` ->writeDTD(string $name, ?string $publicid = NULL, ?string $systemid = NULL, ?string $subset = NULL): bool `](</hack/reference/class/XMLWriter/writeDTD/>)
+ [` ->writeDTDAttlist(string $name, string $content): bool `](</hack/reference/class/XMLWriter/writeDTDAttlist/>)
+ [` ->writeDTDElement(string $name, string $content): bool `](</hack/reference/class/XMLWriter/writeDTDElement/>)
+ [` ->writeDTDEntity(string $name, string $content, bool $pe = false, string $publicid = '', string $systemid = '', string $ndataid = ''): bool `](</hack/reference/class/XMLWriter/writeDTDEntity/>)
+ [` ->writeElement(string $name, ?string $content = NULL): bool `](</hack/reference/class/XMLWriter/writeElement/>)
+ [` ->writeElementNS(?string $prefix, string $name, ?string $uri, ?string $content = NULL): bool `](</hack/reference/class/XMLWriter/writeElementNS/>)
+ [` ->writePI(string $target, string $content): bool `](</hack/reference/class/XMLWriter/writePI/>)
+ [` ->writeRaw(string $content): bool `](</hack/reference/class/XMLWriter/writeRaw/>)
<!-- HHAPIDOC -->
