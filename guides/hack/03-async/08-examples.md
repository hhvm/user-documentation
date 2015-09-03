# Async Examples

Here some code examples representing a slew of possible async scenarios. Obviously this does not cover all possible situations, but they should give you an idea of how and where async can be used effectively. Some of these examples are found spread out through the rest of the async documentation; they are added here again for consolidation purposes.

## Basic

This example shows the basic tenants of async, particularly the keywords used, etc.

@@ examples-examples/basic.php @@

## Joining

To get the result of a wait handle in a non-async function, you can use `join()`.

@@ guidelines-examples/join.php @@

## Closures

You can have async closures, including using the shorter [lambda](link to lambda) syntax.

@@ examples-examples/closures.php @@

## Data Fetching

This shows you a way to organize your async functions in such a way that we have a nice clean data dependency graph.

@@ guidelines-examples/data-dependencies.php @@

## Accessing MySQL

Use the async mysql extension to perform database connection and queries.

@@ extensions-examples/async-mysql.php @@

## Batching

Use rescheduling (via `HH\Asio\later()`) to batch up operations to send multiple keys in a single request over a high latency network (for example purposes, the network isn't high latency, but just returns something random).

@@ guidelines-examples/batching.php @@

## Polling

You can use rescheduling in a polling loop to allow other wait handles to run. You may need a polling loop in a case where a service does not have an async function to add to the scheduler.

@@ examples-examples/polling.php
