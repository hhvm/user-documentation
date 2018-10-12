Here are some examples representing a slew of possible async scenarios. Obviously, this does not cover all possible situations, but they 
provide an idea of how and where async can be used effectively. Some of these examples are found spread out through the rest of the async 
documentation; they are added here again for consolidation purposes.

## Basic

This example shows the basic tenants of async, particularly the keywords used:

@@ examples-examples/basic.php @@

## Joining

To get the result of an awaitable in a non-async function, use `join`:

@@ examples-examples/join.php @@

## Async Closures and Lambdas

Closure and lambda expressions can involve async functions:

@@ examples-examples/closures.php @@

## Data Fetching

This shows a way to organize async functions such that we have a nice clean data dependency graph:

@@ examples-examples/data-dependencies.php @@

## Accessing MySQL

Use the async mysql extension to perform database connection and queries:

@@ examples-examples/async-mysql.noexec.php @@

## Batching

Use rescheduling (via `HH\Asio\later`) to batch up operations to send multiple keys in a single request over a high latency network (for 
example purposes, the network isn't high latency, but just returns something random):

@@ examples-examples/batching.php @@

## Polling

We can use rescheduling in a polling loop to allow other awaitables to run. A polling loop may be needed where a service does not have 
an async function to add to the scheduler:

@@ examples-examples/polling.php @@
