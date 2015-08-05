# Async General Guidelines

It might be tempting to just throw `async`, `await` and `Awaitable` on all your code and go on with your life. And while it it ok to have more `async` functions than not -- in fact, you should generally not be afraid to make a function `async` since there is no performance penalty for doing so -- there are some guidelines you should follow in order to make the most efficient use of `async`.

## Use async extensions

## Ensure async is being used efficiently

## Do not use async in loops

## Considering data dependencies is important

## Consider batching

## Don't forget to await a wait handle

## Memoziation may be good. But only wait handles

## Use lambdas where possible

## Use `join` in non-async functions


