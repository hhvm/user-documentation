``` yamlmeta
{
    "name": "setDateTimeFormat",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/icu/ext_icu_date_pattern_gen.php"
    ],
    "class": "IntlDatePatternGenerator"
}
```




The date time format is a message format pattern used to compose date and
time patterns




``` Hack
public function setDateTimeFormat(
  string $dateTimeFormat,
): void;
```




The default value is "{0} {1}", where {0} will be replaced by the date
pattern and {1} will be replaced by the time pattern.




This is used when the input skeleton contains both date and time fields,
but there is not a close match among the added patterns. For example,
suppose that this object was created by adding "dd-MMM" and "hh:mm", and
its datetimeFormat is the default "{0} {1}". Then if the input skeleton is
"MMMdhmm", there is not an exact match, so the input skeleton is broken up
into two components "MMMd" and "hmm". There are close matches for those two
skeletons, so the result is put together with this pattern, resulting in
"d-MMM h:mm".




## Parameters




+ ` string $dateTimeFormat ` - Format pattern. {0} replaced by the date
  pattern, {1} replaced by the time pattern.




## Returns




* ` void `
<!-- HHAPIDOC -->
