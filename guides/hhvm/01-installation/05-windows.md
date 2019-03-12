There was a time when we were going down a path for HHVM building and installing via Cygwin. Technically, you can still try to build HHVM this way, but don't unless you want a lot of pain.

So, right now, we have no official Windows support for HHVM. But there is **great news**....

## MSVC

Work is being done by a [community member](https://github.com/facebook/hhvm/pulls?page=1&q=is%3Apr+author%3AOrvid&utf8=%E2%9C%93) to port HHVM to native Windows using MSVC. We are getting close to having the pull requests merged that can get HHVM to actually build on Windows directly.

The first step will be getting HHVM to build on Windows. We have a [wiki of information](https://github.com/facebook/hhvm/wiki/Building-and-installing-HHVM-on-Windows-with-MSVC) about this. The next step is being able to run code in interpretive (interp) mode. Then JIT support would be the next step after that.

[Here is a list](https://gist.github.com/Orvid/5c9bc8c54e960a604968) of the areas where solutions are being found to make this happen.
