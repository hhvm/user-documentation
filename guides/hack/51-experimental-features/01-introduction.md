The following pages of documentation describe Hack language features in the *experimental* phase.

## About Experimental Features
We _do not_ recommend using any of these features until they are formally announced and integrated into the main documentation set.

## Enabling an Experimental Feature
To use an experimental feature, add the `__EnableUnstableFeatures` file attribute to any files containing that feature.

```
<<file:__EnableUnstableFeatures('experimental_feature_name')>>
```

You can also specify multiple features:

```
<<file:__EnableUnstableFeatures('experimental_feature_name', 'other_experimental_feature_name')>>
```
