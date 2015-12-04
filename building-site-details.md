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

## Local Snapshot of Site

If you don't have any desire to [build the site](README.md#build-the-site-locally) (e.g., to test [content changes](#contributing-content)), but want to run a snapshot copy of the site locally, offline, then you can use Docker to do this.

- First, install the [Docker Engine](https://docs.docker.com/) on your platform
- Then:

```
% docker pull hhvm/user-documentation # get the latest version of the site.
% docker run -p 1234:80 hhvm/user-documentation # run web server
```

-. Finally, open `http://localhost:1234` in your browser.
