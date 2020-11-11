# Building the Site Details

Assuming you have [prepared to build the site](README.md#build-the-site-locally), you just:

```
$ hhvm bin/build.php
```

This will:

 - parse the API definitions in HHVM and Hack, storing machine-readable.
   data and documentation in YAML files.
 - create canonical definitions, combining the data obtained from Hack and HHVM.
 - generate CSS files from the SCSS source.
 - generate Markdown files for the API documentation based on these YAML files.
 - render all Markdown (API reference and written guides) to HTML.
