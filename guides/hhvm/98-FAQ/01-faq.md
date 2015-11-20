This will contain some helpful hints and frequently asked questions re: HHVM. This is a living document and may be molded into something more user-interactive in the future.

## General

### What is the history of HHVM?

For a history of what is now HHVM, please visit [our Wikipedia page](http://en.wikipedia.org/wiki/HHVM).

### How does Facebook use and run HHVM?

Facebook's entire site runs on HHVM (desktop, api and mobile), both in development and production.

### What platforms is HHVM supported on?

* **Linux**: HHVM has official [Linux](../installation/linux.md) support on flavors of Ubuntu and Debian.
* **Mac OS X**: HHVM has [experimental support](../installation/mac.md) on Mac OS X.
* **Windows**: HHVM is currently being ported over to [Windows](../installation/windows.md).

### Are there are any videos, presentations, etc. about HHVM?

* For a discussion about HHVM and its benefits, please see [this PHP UK Conference 2013 presentation]
 (http://www.youtube.com/watch?v=Dwek7dZDFN0).
* For a deep dive into the HHVM internals, please see [this QCon 2012 presentation](http://www.infoq.com/presentations/PHP-HHVM-Facebook).
* Other information can be found in the references of [our Wikipedia page](http://en.wikipedia.org/wiki/HHVM).
* Presentations from the [HACK Dev Days 2014](https://www.youtube.com/playlist?list=PLb0IAmt7-GS2fdbb1vVdP8Z8zx1l2L8YS).

## Users

### How do I install HHVM? Where are the binaries?

New users may want to try our high-level overview [getting started guide](../getting-started/getting-started.md).

You can find more detailed installation information [here](../installation/introduction.md).

### When does HHVM release a new version?

[Every 8 weeks](https://github.com/facebook/hhvm/wiki/Release%20Schedule).

### How do I configure HHVM? What are my options?

Many times, HHVM can be run directly from the command line without any additional configuration: `hhvm file.php` or, for a server, `sudo hhvm -m server`.

However, we understand that more fine tuned configuration may be necessary, particularly in server mode.

HHVM allows for many [runtime option variations](../configuration/introduction.md). For some configuration options, they can be set at the command line (e.g., `hhvm -m server -d hhvm.log.level=Error`). However, many times you will use a `config.ini` file and run HHVM with a command similar to: `hhvm -m server -c config.ini`.

For other options that can be given to HHVM, type `hhvm --help` at the command line.

### What code does HHVM currently run?

* **Facebook**: HHVM runs Facebook.com in production. 
* **WordPress**: [hhvm.com](http://hhvm.com), a WordPress blog, is running on HHVM.
* **MediaWiki**: MediaWiki installations can run on HHVM.
* All the top 20 PHP frameworks. See the [frameworks test page](http://hhvm.com/frameworks/) to see what % of their unit tests we pass. Most frameworks will run perfectly fine even if we don't pass every test, as the tests might be verifying error message matching, etc.

Here are some other places HHVM is being used: https://github.com/facebook/hhvm/wiki/Users

### What is known to be broken with HHVM?

There are definitely issues that need to be addressed with HHVM. The [HHVM GitHub issues](https://github.com/facebook/hhvm/issues?labels=&page=1&state=open) describe bugs that exist with the current implementation.

The HHVM team is working really hard to enhance functionality and fix bugs that currently exist.
 
### What do I do if I run into a problem (e.g., an error, fatal or segfault)?

Please [submit an issue](https://github.com/facebook/hhvm/wiki/How-to-Report-Issues).

Other areas for discussion and support are on [#hhvm on IRC](http://webchat.freenode.net/?channels=hhvm), [HHVM on Facebook](https://www.facebook.com/hphp)

### Should I use Proxygen or FastCGI?

[Proxygen](../basic-usage/proxygen.md) is full featured, very fast web server and generally easier to get started with out of the box. [FastCGI](../advanced-usage/fastcgi.md) is a bit more configurable, but requires a separate web server (e.g., nginx) on the front of it.

### When will HHVM support Apache or Nginx?

[We do.](../deployment/hhvm-servers#fastcgi)

### What PHP extensions does HHVM currently support?

The list of supported extensions can be found in the extensions directory of the hhvm codebase: https://github.com/facebook/hhvm/tree/master/hphp/runtime/ext
 
### What is the HHVM Wrapper?

The HHVM wrapper provides a simpler interface to the HHVM binary for many common options (e.g., running in server or interp mode, compiling a repo-authoritative repo, dumping bytecode, running gdb). It is located at `hphp/tools/hhvm_wrapper.php`. You can see all of the available options by running:

```
./hphp/tools/hhvm_wrapper.php --help
```

### How do I resolve the "Failed to initialize central HHBC repository at `/var/www/.hhvm.hhbc` error"?

Try deleting `/var/run/hhvm/hhvm.hhbc` and run your program again

## Configuration and Deployment

### HHVM keeps crashing. Why?

There can be many reasons. And it is tough to diagnose that general question. It could be a bug in HHVM. It could be that you need to increase the size of your [translation cache](../configuration/ini-settings.md#jit-translation-cache-size). Or it could be other factors.

The best thing to do is [file an issue](https://github.com/facebook/hhvm/issues) and at minimum give us the problem and a stack trace. You will get a much faster and more quality response if you also provide us as small as possible reproduction case with PHP or Hack code.

## Why is my code slow at startup?

The HHVM JIT needs time to warm up. The warmup usually occurs somewhere on the order of 10-11 requests, at which point the JIT has performed its optimizations and off we go at peak speed.

So, in HHVM server mode, you start out by running the first couple requests in interp mode to get things primed. You don't really want to be optimizing the first few requests since that is when initialization is occurring, caches are being loaded, etc. Those code paths are generally cold later on.

After the first few requests, the JIT is on its way to optimizing.

It is *advisable, but not required* if you are running an HHVM server to send the server some explicit requests that are representative of what user requests will be coming through. You can use `curl`, for example, to send these requests. This way the JIT has the information necessary to make the best optimizations for your code before any requests are actually served.

## Enabling Hack mode on PHP files in repo mode

Have you seen an error like this?

```
Fatal error: Syntax only allowed in Hack files (<?hh) or with -v Eval.EnableHipHopSyntax=true
```

If you have a `<?php` file where you want to enable Hack syntax in [repo mode](), you have to make sure that you specify `hhvm.force_hh=true` in both the *repo compilation stage* and when *running code from the repo*.

For example, if you have a file named `enable-hack-in-php.php` and you wanted to create a repo from that file and run it,  you would need to do something like the following:

```
# compilation of repo stage
% hhvm --hphp -t hhbc -v AllVolatile=true -dhhvm.force_hh=true `enable-hack-in-php.php`

# execution stage; hhvm.hhbc file location will vary
% hhvm -dhhvm.force_hh=true  --file 'enable-hack-in-php.php' -vRepo.Authoritative=true -vRepo.Central.Path="/tmp/hphp_RdsESQ/hhvm.hhbc"
