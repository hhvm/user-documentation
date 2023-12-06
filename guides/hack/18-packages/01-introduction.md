Packages are an extension to modules for HHVM and Hack which allows developers to more easily configure which files to build and deploy. 

## Package definitions
A **package** is defined by a set of modules meant to be deployed together. Packages are configured in a toml file called `PACKAGES.toml` located at the root of your codebase (next to .hhconfig). 

```toml PACKAGES.toml
[packages]

[packages.production]
uses=["prod.*", "my_prod"] # Package contains all modules that start with `prod`, and the module "my_prod".

[packages.test]
uses=["test.*"]
includes=["production"] # Package depends on the production package
```

Every module can be in at most one package, so the same module cannot be part of two packages. Therefore, the same glob cannot appear in the uses clause of two different modules. 

## Overlaps in module globs
- It is an error for the same module glob to appear in multiple package definitions.  Given a module with name foo.bar, we resolve what package the module belongs to with the following precedence:
- If a package lists foo.bar directly in its use clause, foo.bar belongs to that package. If multiple packages list foo.bar directly, we throw an error at package definition. 
- If no package directly references the module, but a package has a prefix which matches foo.bar (in this case, foo.* for example), foo.bar belongs to the package with that prefix. If multiple packages list a prefix of the module, we take the most specific prefix, i.e. the longest prefix that matches.
- If no package references the module in its use clause, the module belongs to the default package. 

Once you've defined a set of packages, you can deploy them using **deployments**. 

## Deployments
A **deployment** is defined as a set of packages. Deployments are also defined in PACKAGES.toml:

```toml PACKAGES.toml
[packages]

[packages.production]
uses=["prod.*", "my_prod"] # Package contains all modules that start with `prod`, and the module "my_prod".

[packages.test]
uses=["test.*"]
includes=["production"] # Package depends on the production package

[deployments]
[deployments.production]
packages=["production"]

[deployments.test]
packages=["test", "production"] # Since the test package includes production, they must be deployed together.
```

When building in [repo authoritative](../../hhvm/advanced-usage/repo-authoritative.md) mode, you can pass in the build configuration `Eval.ActiveDeployment = <deployment>` to set the active deployment. HHVM will then include only the files in the active deployment when building. 

## Deployment domains
In CLI-server mode, HHVM can direct different domains to different deployments, allowing you to treat a web request as if it were built in repo mode with a specific deployment. You can set the `domains` value of to any deployment to a list of regexes:

```toml
[deployments.production]
packages=["production"]
domains=["^.*my_website\.com"]
```
The domains field matches on the `Host` field of any web request that HHVM serves. In this example, traffic that hits `my_website.com` will be treated as if the active deployment were production. Note that a hostname can match multiple regexes, but the **first** deployment listed which has a regex that matches the hostname will be used.
