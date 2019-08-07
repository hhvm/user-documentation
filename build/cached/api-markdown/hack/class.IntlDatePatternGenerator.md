``` yamlmeta
{
    "name": "IntlDatePatternGenerator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




Generates localized date and/or time format pattern strings suitable for use
in IntlDateFormatter




Transforms unordered skeleton formats like "MMddyyyy" to use the correct
ordering and separators for the locale (for example, one locale might use
"dd-MM-yyyy" when another uses "yyyy/MM/dd").




See Unicode UTS #35 appendix F (Date Format Patterns) for valid input format
patterns:
http://unicode.org/reports/tr35/tr35-6.html#Date_Format_Patterns




Example usage:
$locale = 'en_US';
$generator = IntlDatePatternGenerator::createInstance($locale);
$pattern = $generator->getBestPattern('MMddyyyy');
$formatter = IntlDateFormatter::create($locale, null, null);
$formatter->setPattern($pattern);
$date = $formatter->format(new DateTime());




Constants:




Pattern fields:
IntlDatePatternGenerator::ERA_PATTERN_FIELD
IntlDatePatternGenerator::YEAR_PATTERN_FIELD
IntlDatePatternGenerator::QUARTER_PATTERN_FIELD
IntlDatePatternGenerator::MONTH_PATTERN_FIELD
IntlDatePatternGenerator::WEEK_OF_YEAR_PATTERN_FIELD
IntlDatePatternGenerator::WEEK_OF_MONTH_PATTERN_FIELD
IntlDatePatternGenerator::WEEKDAY_PATTERN_FIELD
IntlDatePatternGenerator::DAY_OF_YEAR_PATTERN_FIELD
IntlDatePatternGenerator::DAY_OF_WEEK_IN_MONTH_PATTERN_FIELD
IntlDatePatternGenerator::DAY_PATTERN_FIELD
IntlDatePatternGenerator::DAYPERIOD_PATTERN_FIELD
IntlDatePatternGenerator::HOUR_PATTERN_FIELD
IntlDatePatternGenerator::MINUTE_PATTERN_FIELD
IntlDatePatternGenerator::SECOND_PATTERN_FIELD
IntlDatePatternGenerator::FRACTIONAL_SECOND_PATTERN_FIELD
IntlDatePatternGenerator::ZONE_PATTERN_FIELD




Pattern conflict status:
IntlDatePatternGenerator::PATTERN_NO_CONFLICT
IntlDatePatternGenerator::PATTERN_BASE_CONFLICT
IntlDatePatternGenerator::PATTERN_CONFLICT




## Interface Synopsis




``` Hack
class IntlDatePatternGenerator {...}
```




### Public Methods




+ [` ::createEmptyInstance(): IntlDatePatternGenerator `](</hack/reference/class/IntlDatePatternGenerator/createEmptyInstance/>)\
  Creates an empty generator, to be constructed with addPattern(...) etc

+ [` ::createInstance(string $locale): IntlDatePatternGenerator `](</hack/reference/class/IntlDatePatternGenerator/createInstance/>)\
  Creates a flexible generator according to the data for a given locale

+ [` ->addPattern(string $pattern, bool $override): int `](</hack/reference/class/IntlDatePatternGenerator/addPattern/>)\
  Adds a pattern to the generator

+ [` ->getAppendItemFormat(int $field): string `](</hack/reference/class/IntlDatePatternGenerator/getAppendItemFormat/>)

+ [` ->getAppendItemName(int $field): string `](</hack/reference/class/IntlDatePatternGenerator/getAppendItemName/>)

+ [` ->getBaseSkeleton(string $pattern): string `](</hack/reference/class/IntlDatePatternGenerator/getBaseSkeleton/>)\
  Utility to return a unique base skeleton from a given pattern

+ [` ->getBaseSkeletons(): IntlIterator `](</hack/reference/class/IntlDatePatternGenerator/getBaseSkeletons/>)

+ [` ->getBestPattern(string $skeleton): string `](</hack/reference/class/IntlDatePatternGenerator/getBestPattern/>)\
  Returns the best pattern matching the input skeleton

+ [` ->getDateTimeFormat(): string `](</hack/reference/class/IntlDatePatternGenerator/getDateTimeFormat/>)

+ [` ->getDecimal(): string `](</hack/reference/class/IntlDatePatternGenerator/getDecimal/>)\
  The decimal value is used in formatting fractions of seconds

+ [` ->getErrorCode(): int `](</hack/reference/class/IntlDatePatternGenerator/getErrorCode/>)\
  Get last error code on the object

+ [` ->getErrorMessage(): string `](</hack/reference/class/IntlDatePatternGenerator/getErrorMessage/>)\
  Get last error message on the object

+ [` ->getPatternForSkeleton(string $skeleton): string `](</hack/reference/class/IntlDatePatternGenerator/getPatternForSkeleton/>)\
  Get the pattern corresponding to a given skeleton

+ [` ->getSkeleton(string $pattern): string `](</hack/reference/class/IntlDatePatternGenerator/getSkeleton/>)\
  Utility to return a unique skeleton from a given pattern

+ [` ->getSkeletons(): IntlIterator `](</hack/reference/class/IntlDatePatternGenerator/getSkeletons/>)

+ [` ->replaceFieldTypes(string $pattern, string $skeleton): string `](</hack/reference/class/IntlDatePatternGenerator/replaceFieldTypes/>)\
  Adjusts the field types (width and subtype) of a pattern to match what is
  in a skeleton

+ [` ->setAppendItemFormat(int $field, string $value): void `](</hack/reference/class/IntlDatePatternGenerator/setAppendItemFormat/>)\
  An append item format is a pattern used to append a field if there is no
  good match

+ [` ->setAppendItemName(int $field, string $name): void `](</hack/reference/class/IntlDatePatternGenerator/setAppendItemName/>)\
  Sets the name of a field, eg "era" in English for ERA

+ [` ->setDateTimeFormat(string $dateTimeFormat): void `](</hack/reference/class/IntlDatePatternGenerator/setDateTimeFormat/>)\
  The date time format is a message format pattern used to compose date and
  time patterns

+ [` ->setDecimal(string $decimal): void `](</hack/reference/class/IntlDatePatternGenerator/setDecimal/>)\
  The decimal value is used in formatting fractions of seconds








### Private Methods




* [` ->__construct(): void `](</hack/reference/class/IntlDatePatternGenerator/__construct/>)\
  Private constructor for disallowing instantiation



<!-- HHAPIDOC -->
