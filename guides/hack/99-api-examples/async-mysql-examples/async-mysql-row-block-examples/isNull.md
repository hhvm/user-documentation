The following example uses `AsyncMysqlRowBlock::isNull` to check if a field value is `null` (e.g., if a field was set in SQL to something like `age SMALLINT NULL`, then that field *could* be `null`).
