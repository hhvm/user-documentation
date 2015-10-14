# Compilation

Code running on HHVM can be run in interpretive mode or JIT mode. JIT mode is the default because the HHVM JIT provides massive performance benefits, particularly for high-scale, server-based applications.

In interpretive mode, all code is compiled to a bytecode and run through its bytecode interpreter. This is a generally slower mode, but can actually make debugging a lot easier since there are minimal optimizations to cloudy up code paths, etc.

In JIT mode, your code is essentially compiled directly into machine code and optimized as much as possible. If code cannot be JITted for whatever reason, we fallback to the bytecode interpreter.

## Interpretive Mode

Interpretive Mode, or interp for short, is the most direct line to run your code as it is laid out in the source files. Your code is converted to a stream of bytecodes and executed. 

While JIT mode is generally much faster, there are cases when interp mode can be a better way to go. For example, if you are running a quick script one time, interp mode might be a better bet since it takes a while for the HHVM JIT to warmup.

Here is how you run HHVM in interp mode:

```
hhvm -d hhvm.jit=0 script.php
```

While you can run in interp mode when using HHVM as a server, it is generally not recommended unless you are debugging since your code will run much, much slower.

```
# don't normally do this unless you are debugging
hhvm -m server -d hhvm.jit=0
```

## JIT Mode

You will want to run a majority of your long lasting code in JIT mode. You will get the benefit of direct machine code compilation, complete with all of the optimizations that HHVM can provide.

JIT mode is enabled by default for both command-line scripts and server mode.

### Warmup

As noted above in interp mode, the HHVM JIT needs time to warm up. The warmup usually occurs somewhere on the order of 10-11 requests, at which point the JIT has performed its optimizations and off we go at peak speed.

So, in HHVM server mode, you start out by running the first couple requests in interp mode to get things primed. You don't really want to be optimizing the first few requests since that is when initialization is occurring, caches are being loaded, etc. Those code paths are generally cold later on.

After the first few requests, the JIT is on its way to optimizing.

It is *advisable, but not required* if you are running an HHVM server to send the server some explicit requests that are representative of what user requests will be coming through. You can use `curl`, for example, to send these requests. This way the JIT has the information necessary to make the best optimizations for your code before any requests are actually served.

## Resources

There have been some great blog posts about HHVM compilation:

* http://hhvm.com/blog/6323/the-journey-of-a-thousand-bytecodes
* http://hhvm.com/blog/2027/faster-and-cheaper-the-evolution-of-the-hhvm-jit
