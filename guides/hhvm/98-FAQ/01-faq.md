This contains some helpful hints and frequently asked questions about HHVM.

## General

### What is the history of HHVM?

For a history of what is now HHVM, please visit [our Wikipedia page](http://en.wikipedia.org/wiki/HHVM).

### How does Facebook use and run HHVM?

Facebook's entire site runs on HHVM (desktop, API and mobile), both in development and production.

### What platforms is HHVM supported on?

* **Linux**: HHVM has official [Linux](/hhvm/installation/linux) support on flavors of Ubuntu and Debian.
* **Mac OS X**: HHVM has [experimental support](/hhvm/installation/mac) on Mac OS X.
* **Windows**: HHVM is currently being ported over to [Windows](/hhvm/installation/windows).

### Are there are any videos, presentations, etc. about HHVM?

* For a discussion about HHVM and its benefits, please see [this PHP UK Conference 2013 presentation]
 (http://www.youtube.com/watch?v=Dwek7dZDFN0).
* For a deep dive into the HHVM internals, please see [this QCon 2012 presentation](http://www.infoq.com/presentations/PHP-HHVM-Facebook).
* Other information can be found in the references of [our Wikipedia page](http://en.wikipedia.org/wiki/HHVM).
* Presentations from the [Hack Dev Day 2014](https://www.youtube.com/playlist?list=PLb0IAmt7-GS2fdbb1vVdP8Z8zx1l2L8YS).

## Users

### How do I install HHVM? Where are the binaries?

New users may want to try our high-level overview [getting started guide](/hhvm/getting-started/getting-started).

You can find more detailed installation information [here](/hhvm/installation/introduction).

### When does HHVM release a new version?

[Every 8 weeks](/hhvm/installation/release-schedule).

### Why is HHVM released every 8 weeks?

At Facebook, HHVM is pushed every 2 weeks (as you can see from the [NEWS](https://github.com/facebook/hhvm/blob/master/NEWS) file), but having everyone in the world update every 2 weeks would lead to too much testing and churn. After asking around this seems to be a good compromise between churn and getting new features. In the future we could switch to every 6 weeks or 10 weeks or any multiple of 2 that the community likes.

### What code does HHVM currently run?

* **Facebook**: HHVM has run [www.facebook.com](https://www.facebook.com) in production since 2013. 
* **WordPress**: [hhvm.com](http://hhvm.com), a WordPress blog, is running on HHVM.
* **MediaWiki**: MediaWiki installations can run on HHVM, and [Wikipedia](http://wikipedia.org) has run on HHVM since 2014.
* All the top 20 PHP frameworks. See the [frameworks test page](http://hhvm.com/frameworks/) to see what percent of their unit tests we pass. Most frameworks will run perfectly fine even if we don't pass every test, as the tests might be verifying error message matching, etc.

Here are some other places HHVM is being used: [https://github.com/facebook/hhvm/wiki/Users](https://github.com/facebook/hhvm/wiki/Users)

### What is known to be broken with HHVM?

There are definitely issues that need to be addressed with HHVM. The [HHVM GitHub issues](https://github.com/facebook/hhvm/issues?labels=&page=1&state=open) describe bugs that exist with the current implementation.

The HHVM team is working really hard to enhance functionality and fix bugs that currently exist.
 
### What do I do if I run into a problem (e.g., an error, fatal or segfault)?

Please [submit an issue](https://github.com/facebook/hhvm/wiki/How-to-Report-Issues).

For real-time discussion, the team tends to hang out in [#hhvm on IRC](http://webchat.freenode.net/?channels=hhvm) during working hours US Pacific time (and knowledgeable community members are often around at other times too).

### Should I use Proxygen or FastCGI?

[Proxygen](/hhvm/basic-usage/proxygen) is full featured, very fast web server and generally easier to get started with out of the box. [FastCGI](/hhvm/advanced-usage/fastCGI) is a bit more configurable, but requires a separate web server (e.g., nginx) on the front of it.

### When will HHVM support Apache or Nginx?

[We do.](/hhvm/advanced-usage/fastCGI)

### What PHP extensions does HHVM currently support?

[Here is the list](/hhvm/extensions/introduction) of supported extensions.
 
### What is the HHVM Wrapper?

The HHVM wrapper provides a simpler interface to the HHVM binary for many common options (e.g., running in server or interp mode, compiling a repo-authoritative repo, dumping bytecode, running gdb). It is located at `hphp/tools/hhvm_wrapper.php`. You can see all of the available options by running:

```
./hphp/tools/hhvm_wrapper.php --help
```

### How do I resolve the "Failed to initialize central HHBC repository at `/var/www/.hhvm.hhbc`" error?

Try deleting `/var/run/hhvm/hhvm.hhbc` and run your program again

## Configuration and Deployment

### HHVM keeps crashing. Why?

There can be many reasons. And it is tough to diagnose that general question. It could be a bug in HHVM. It could be that you need to increase the size of your [translation cache](/hhvm/configuration/INI-settings#jit-translation-cache-size). Or it could be other factors.

The best thing to do is [file an issue](https://github.com/facebook/hhvm/issues) and at minimum give us the problem and a stack trace. You will get a much faster and more quality response if you also provide us as small as possible reproduction case with PHP or Hack code.

## Why is my code slow at startup?

The HHVM JIT needs time to warm up. The warmup usually occurs somewhere on the order of 10-11 requests, at which point the JIT has performed its optimizations and off we go at peak speed.

So, in HHVM server mode, you start out by running the first couple requests in interp mode to get things primed. You don't really want to be optimizing the first few requests since that is when initialization is occurring, caches are being loaded, etc. Those code paths are generally cold later on.

After the first few requests, the JIT is on its way to optimizing.

It is advisable, but not required, if you are running an HHVM server to send the server some explicit requests that are representative of what user requests will be coming through. You can use `curl`, for example, to send these requests. This way the JIT has the information necessary to make the best optimizations for your code before any requests are actually served.

## Enabling Hack mode on PHP files in repo mode

Have you seen an error like this?

```
Fatal error: Syntax only allowed in Hack files (<?hh) or with -v Eval.EnableHipHopSyntax=true
```

If you have a `<?php` file where you want to enable Hack syntax in [repo authoritative mode](/hhvm/advanced-usage/repo-authoritative), you have to make sure that you specify `hhvm.force_hh=true` in both the *repo compilation stage* and when *running code from the repo*.

For example, if you have a file named `enable-hack-in-php.php` and you wanted to create a repo from that file and run it,  you would need to do something like the following:

```
# compilation of repo stage
% hhvm --hphp -t hhbc -v AllVolatile=true -dhhvm.force_hh=true `enable-hack-in-php.php`

# execution stage; hhvm.hhbc file location will vary
% hhvm -dhhvm.force_hh=true  --file 'enable-hack-in-php.php' -vRepo.Authoritative=true -vRepo.Central.Path="/tmp/hphp_RdsESQ/hhvm.hhbc"
```

This isn't necessary when using Hack syntax in Hack (`<?hh`) files, only when wanting to use Hack syntax in PHP (`<?php`) files, which is unusual.

## Running Code

### Why are there sometimes array sorting differences between HHVM and PHP?

You may have hit the [sorting inconsistency](/hhvm/inconsistencies/arrays-and-foreach#sorting).
