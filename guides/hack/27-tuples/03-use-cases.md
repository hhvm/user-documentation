There are two primary use-cases for tuples:

- The most common use case is to return multiple values from a function. Tuples allow you to avoid using something like reference (&) parameters to mimic returning multiple values. Tuples get around the fact that functions allow only one return value by allowing you to bundle a bunch values in one type.
- Grouping common values together that are not necessarily of the same type. For example, you may want to bundle a user id (`int`) and a user name (`string`) as part of database query.
