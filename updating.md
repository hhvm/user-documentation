# Updating to a new version of HHVM

For example, when updating from 4.1 to 4.4:

```
$ php ~/composer.phar require hhvm:4.4.*
$ php ~/composer.phar update
$ gsed -i s/4.1-latest/4.4-latest/ .travis.yml Dockerfile`
$ (cd api-sources/hhvm; git fetch --tags; git reset --hard HHVM-4.4.0)
```

Update `api-sources/hsl` in the same way as `api-sources/hhvm` if a new release
is needed.

You will then need to make the typechecker and unit tests pass on the new
version.
