``` yamlmeta
{
    "name": "Redis",
    "sources": [
        "api-sources/hhvm/hphp/system/php/redis/Redis.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_redis.hhi"
    ],
    "class": "Redis"
}
```




## Interface Synopsis




``` Hack
class Redis {...}
```




### Public Methods




+ [` ->__call($fname, $args) `](</hack/reference/class/Redis/__call/>)\
  Dispatches all commands in the Redis::$map list
+ [` ->__construct() `](</hack/reference/class/Redis/__construct/>)
+ [` ->_prefix($value) `](</hack/reference/class/Redis/_prefix/>)
+ [` ->_serialize($str) `](</hack/reference/class/Redis/_serialize/>)
+ [` ->_unserialize($value) `](</hack/reference/class/Redis/_unserialize/>)
+ [` ->append($key, $value) `](</hack/reference/class/Redis/append/>)
+ [` ->auth($password) `](</hack/reference/class/Redis/auth/>)
+ [` ->bgrewriteaof() `](</hack/reference/class/Redis/bgrewriteaof/>)
+ [` ->bgsave() `](</hack/reference/class/Redis/bgsave/>)
+ [` ->bitCount($key) `](</hack/reference/class/Redis/bitCount/>)
+ [` ->bitOp($operation, $retKey, $key1, $key2, $key3 = NULL) `](</hack/reference/class/Redis/bitOp/>)
+ [` ->blPop(array $keys) `](</hack/reference/class/Redis/blPop/>)
+ [` ->brPop(array $keys) `](</hack/reference/class/Redis/brPop/>)
+ [` ->brpoplpush($srcKey, $dstKey, $timeout) `](</hack/reference/class/Redis/brpoplpush/>)
+ [` ->clearLastError() `](</hack/reference/class/Redis/clearLastError/>)
+ [` ->client($command, ...$args = '') `](</hack/reference/class/Redis/client/>)
+ [` ->close() `](</hack/reference/class/Redis/close/>)
+ [` ->config($operation, $key, $value = '') `](</hack/reference/class/Redis/config/>)
+ [` ->connect($host, $port = 6379, $timeout = 0) `](</hack/reference/class/Redis/connect/>)
+ [` ->dbSize() `](</hack/reference/class/Redis/dbSize/>)
+ [` ->decr($key) `](</hack/reference/class/Redis/decr/>)
+ [` ->decrBy($key, $value) `](</hack/reference/class/Redis/decrBy/>)
+ [` ->del($key1, $key2 = NULL, $key3 = NULL) `](</hack/reference/class/Redis/del/>)
+ [` ->delete($key1, $key2 = NULL, $key3 = NULL) `](</hack/reference/class/Redis/delete/>)
+ [` ->discard() `](</hack/reference/class/Redis/discard/>)
+ [` ->dump($key) `](</hack/reference/class/Redis/dump/>)
+ [` ->eval($script, array $args = array ( ), $numKeys = 0) `](</hack/reference/class/Redis/eval/>)
+ [` ->evalSha($scriptSha, array $args = array ( ), $numKeys = 0) `](</hack/reference/class/Redis/evalSha/>)
+ [` ->evaluate($script, array $args = array ( ), $numKeys = 0) `](</hack/reference/class/Redis/evaluate/>)
+ [` ->evaluateSha($scriptSha, array $args = array ( ), $numKeys = 0) `](</hack/reference/class/Redis/evaluateSha/>)
+ [` ->exec() `](</hack/reference/class/Redis/exec/>)
+ [` ->exists($key) `](</hack/reference/class/Redis/exists/>)
+ [` ->expire($key, $ttl) `](</hack/reference/class/Redis/expire/>)
+ [` ->expireAt($key, $timestamp) `](</hack/reference/class/Redis/expireAt/>)
+ [` ->flushAll() `](</hack/reference/class/Redis/flushAll/>)
+ [` ->flushDB() `](</hack/reference/class/Redis/flushDB/>)
+ [` ->get($key) `](</hack/reference/class/Redis/get/>)
+ [` ->getBit($key, $offset) `](</hack/reference/class/Redis/getBit/>)
+ [` ->getDBNum() `](</hack/reference/class/Redis/getDBNum/>)
+ [` ->getHost() `](</hack/reference/class/Redis/getHost/>)
+ [` ->getKeys($pattern) `](</hack/reference/class/Redis/getKeys/>)
+ [` ->getLastError() `](</hack/reference/class/Redis/getLastError/>)
+ [` ->getMultiple(array $keys) `](</hack/reference/class/Redis/getMultiple/>)
+ [` ->getOption($name) `](</hack/reference/class/Redis/getOption/>)
+ [` ->getPassword() `](</hack/reference/class/Redis/getPassword/>)
+ [` ->getPersistentId() `](</hack/reference/class/Redis/getPersistentId/>)
+ [` ->getPort() `](</hack/reference/class/Redis/getPort/>)
+ [` ->getRange($key, $start, $end) `](</hack/reference/class/Redis/getRange/>)
+ [` ->getReadTimeout() `](</hack/reference/class/Redis/getReadTimeout/>)
+ [` ->getSet($key, $value) `](</hack/reference/class/Redis/getSet/>)
+ [` ->getTimeout() `](</hack/reference/class/Redis/getTimeout/>)
+ [` ->hDel($key, $hashKey1, $hashKey2 = NULL, $hashKeyN = NULL) `](</hack/reference/class/Redis/hDel/>)
+ [` ->hExists($key, $hashKey) `](</hack/reference/class/Redis/hExists/>)
+ [` ->hGet($key, $hashKey) `](</hack/reference/class/Redis/hGet/>)
+ [` ->hGetAll($key) `](</hack/reference/class/Redis/hGetAll/>)
+ [` ->hIncrBy($key, $hashKey, $value) `](</hack/reference/class/Redis/hIncrBy/>)
+ [` ->hIncrByFloat($key, $field, $increment) `](</hack/reference/class/Redis/hIncrByFloat/>)
+ [` ->hKeys($key) `](</hack/reference/class/Redis/hKeys/>)
+ [` ->hLen($key) `](</hack/reference/class/Redis/hLen/>)
+ [` ->hMGet($key, array $hashKeys) `](</hack/reference/class/Redis/hMGet/>)
+ [` ->hMSet($key, array $pairs) `](</hack/reference/class/Redis/hMSet/>)
+ [` ->hMset($key, $hashKeys) `](</hack/reference/class/Redis/hMset/>)
+ [` ->hScan($key, &$iterator, $pattern = NULL, $count = NULL) `](</hack/reference/class/Redis/hScan/>)
+ [` ->hSet($key, $hashKey, $value) `](</hack/reference/class/Redis/hSet/>)
+ [` ->hSetNx($key, $hashKey, $value) `](</hack/reference/class/Redis/hSetNx/>)
+ [` ->hVals($key) `](</hack/reference/class/Redis/hVals/>)
+ [` ->incr($key) `](</hack/reference/class/Redis/incr/>)
+ [` ->incrBy($key, $value) `](</hack/reference/class/Redis/incrBy/>)
+ [` ->incrByFloat($key, $increment) `](</hack/reference/class/Redis/incrByFloat/>)
+ [` ->info($option = NULL) `](</hack/reference/class/Redis/info/>)
+ [` ->isConnected() `](</hack/reference/class/Redis/isConnected/>)
+ [` ->keys($pattern) `](</hack/reference/class/Redis/keys/>)
+ [` ->lGet($key, $index) `](</hack/reference/class/Redis/lGet/>)
+ [` ->lGetRange($key, $start, $end) `](</hack/reference/class/Redis/lGetRange/>)
+ [` ->lIndex($key, $index) `](</hack/reference/class/Redis/lIndex/>)
+ [` ->lInsert($key, $position, $pivot, $value) `](</hack/reference/class/Redis/lInsert/>)
+ [` ->lLen($key) `](</hack/reference/class/Redis/lLen/>)
+ [` ->lPop($key) `](</hack/reference/class/Redis/lPop/>)
+ [` ->lPush($key, $value1, $value2 = NULL, $valueN = NULL) `](</hack/reference/class/Redis/lPush/>)
+ [` ->lPushx($key, $value) `](</hack/reference/class/Redis/lPushx/>)
+ [` ->lRange($key, $start, $end) `](</hack/reference/class/Redis/lRange/>)
+ [` ->lRem($key, $value, $count) `](</hack/reference/class/Redis/lRem/>)
+ [` ->lRemove($key, $value, $count) `](</hack/reference/class/Redis/lRemove/>)
+ [` ->lSet($key, $index, $value) `](</hack/reference/class/Redis/lSet/>)
+ [` ->lSize($key) `](</hack/reference/class/Redis/lSize/>)
+ [` ->lTrim($key, $start, $stop) `](</hack/reference/class/Redis/lTrim/>)
+ [` ->lastSave() `](</hack/reference/class/Redis/lastSave/>)
+ [` ->listTrim($key, $start, $stop) `](</hack/reference/class/Redis/listTrim/>)
+ [` ->mSet(array $data) `](</hack/reference/class/Redis/mSet/>)
+ [` ->mSetNx(array $data) `](</hack/reference/class/Redis/mSetNx/>)
+ [` ->mget(array $array) `](</hack/reference/class/Redis/mget/>)
+ [` ->migrate($host, $port, $key, $db, $timeout) `](</hack/reference/class/Redis/migrate/>)
+ [` ->move($key, $dbindex) `](</hack/reference/class/Redis/move/>)
+ [` ->mset(array $array) `](</hack/reference/class/Redis/mset/>)
+ [` ->msetnx(array $array) `](</hack/reference/class/Redis/msetnx/>)
+ [` ->multi() `](</hack/reference/class/Redis/multi/>)
+ [` ->object($string = '', $key = '') `](</hack/reference/class/Redis/object/>)
+ [` ->open($host, $port = 6379, $timeout = 0) `](</hack/reference/class/Redis/open/>)
+ [` ->pExpire($key, $ttl) `](</hack/reference/class/Redis/pExpire/>)
+ [` ->pExpireAt($key, $timestamp) `](</hack/reference/class/Redis/pExpireAt/>)
+ [` ->pconnect($host, $port = 6379, $timeout = 0) `](</hack/reference/class/Redis/pconnect/>)
+ [` ->persist($key) `](</hack/reference/class/Redis/persist/>)
+ [` ->ping() `](</hack/reference/class/Redis/ping/>)
+ [` ->pipeline() `](</hack/reference/class/Redis/pipeline/>)
+ [` ->popen($host, $port = 6379, $timeout = 0) `](</hack/reference/class/Redis/popen/>)
+ [` ->psetex($key, $ttl, $value) `](</hack/reference/class/Redis/psetex/>)
+ [` ->psubscribe($patterns, $callback) `](</hack/reference/class/Redis/psubscribe/>)
+ [` ->pttl($key) `](</hack/reference/class/Redis/pttl/>)
+ [` ->publish($channel, $message) `](</hack/reference/class/Redis/publish/>)
+ [` ->rPop($key) `](</hack/reference/class/Redis/rPop/>)
+ [` ->rPush($key, $value1, $value2 = NULL, $valueN = NULL) `](</hack/reference/class/Redis/rPush/>)
+ [` ->rPushx($key, $value) `](</hack/reference/class/Redis/rPushx/>)
+ [` ->randomKey() `](</hack/reference/class/Redis/randomKey/>)
+ [` ->rename($srcKey, $dstKey) `](</hack/reference/class/Redis/rename/>)
+ [` ->renameKey($srcKey, $dstKey) `](</hack/reference/class/Redis/renameKey/>)
+ [` ->renameNx($srcKey, $dstKey) `](</hack/reference/class/Redis/renameNx/>)
+ [` ->resetStat() `](</hack/reference/class/Redis/resetStat/>)
+ [` ->restore($key, $ttl, $value) `](</hack/reference/class/Redis/restore/>)
+ [` ->rpoplpush($srcKey, $dstKey) `](</hack/reference/class/Redis/rpoplpush/>)
+ [` ->sAdd($key, $value1, $value2 = NULL, $valueN = NULL) `](</hack/reference/class/Redis/sAdd/>)
+ [` ->sCard($key) `](</hack/reference/class/Redis/sCard/>)
+ [` ->sContains($key, $value) `](</hack/reference/class/Redis/sContains/>)
+ [` ->sDiff($key1, $key2, $keyN = NULL) `](</hack/reference/class/Redis/sDiff/>)
+ [` ->sDiffStore($dstKey, $key1, $key2, $keyN = NULL) `](</hack/reference/class/Redis/sDiffStore/>)
+ [` ->sGetMembers($key) `](</hack/reference/class/Redis/sGetMembers/>)
+ [` ->sInter($key1, $key2, $keyN = NULL) `](</hack/reference/class/Redis/sInter/>)
+ [` ->sInterStore($dstKey, $key1, $key2, $keyN = NULL) `](</hack/reference/class/Redis/sInterStore/>)
+ [` ->sIsMember($key, $value) `](</hack/reference/class/Redis/sIsMember/>)
+ [` ->sMembers($key) `](</hack/reference/class/Redis/sMembers/>)
+ [` ->sMove($srcKey, $dstKey, $member) `](</hack/reference/class/Redis/sMove/>)
+ [` ->sPop($key) `](</hack/reference/class/Redis/sPop/>)
+ [` ->sRandMember($key) `](</hack/reference/class/Redis/sRandMember/>)
+ [` ->sRem($key, $member1, $member2 = NULL, $memberN = NULL) `](</hack/reference/class/Redis/sRem/>)
+ [` ->sRemove($key, $member1, $member2 = NULL, $memberN = NULL) `](</hack/reference/class/Redis/sRemove/>)
+ [` ->sScan($key, &$iterator, $pattern = NULL, $count = NULL) `](</hack/reference/class/Redis/sScan/>)
+ [` ->sUnion($key1, $key2, $keyN = NULL) `](</hack/reference/class/Redis/sUnion/>)
+ [` ->sUnionStore($dstKey, $key1, $key2, $keyN = NULL) `](</hack/reference/class/Redis/sUnionStore/>)
+ [` ->save() `](</hack/reference/class/Redis/save/>)
+ [` ->scan(&$iterator, $pattern = NULL, $count = NULL) `](</hack/reference/class/Redis/scan/>)
+ [` ->script($command, ...$script) `](</hack/reference/class/Redis/script/>)
+ [` ->select($dbNumber) `](</hack/reference/class/Redis/select/>)
+ [` ->set($key, $value, $optionArrayOrExpiration = -1) `](</hack/reference/class/Redis/set/>)
+ [` ->setBit($key, $offset, $value) `](</hack/reference/class/Redis/setBit/>)
+ [` ->setOption($name, $value) `](</hack/reference/class/Redis/setOption/>)
+ [` ->setRange($key, $offset, $value) `](</hack/reference/class/Redis/setRange/>)
+ [` ->setTimeout($key, $ttl) `](</hack/reference/class/Redis/setTimeout/>)
+ [` ->setex($key, $ttl, $value) `](</hack/reference/class/Redis/setex/>)
+ [` ->setnx($key, $value) `](</hack/reference/class/Redis/setnx/>)
+ [` ->slaveOf($host = '', $port = -1) `](</hack/reference/class/Redis/slaveOf/>)
+ [` ->slaveof($host = '127.0.0.1', $port = 6379) `](</hack/reference/class/Redis/slaveof/>)
+ [` ->slowlog($command) `](</hack/reference/class/Redis/slowlog/>)
+ [` ->sort($key, array $option = NULL) `](</hack/reference/class/Redis/sort/>)
+ [` ->sortAsc($key, $pattern = NULL, $get = NULL, $start = -1, $count = -1, $store = NULL) `](</hack/reference/class/Redis/sortAsc/>)
+ [` ->sortAscAlpha($key, $pattern = NULL, $get = NULL, $start = -1, $count = -1, $store = NULL) `](</hack/reference/class/Redis/sortAscAlpha/>)
+ [` ->sortDesc($key, $pattern = NULL, $get = NULL, $start = -1, $count = -1, $store = NULL) `](</hack/reference/class/Redis/sortDesc/>)
+ [` ->sortDescAlpha($key, $pattern = NULL, $get = NULL, $start = -1, $count = -1, $store = NULL) `](</hack/reference/class/Redis/sortDescAlpha/>)
+ [` ->strlen($key) `](</hack/reference/class/Redis/strlen/>)
+ [` ->subscribe($channels, $callback) `](</hack/reference/class/Redis/subscribe/>)
+ [` ->substr($key, $start, $end) `](</hack/reference/class/Redis/substr/>)
+ [` ->time() `](</hack/reference/class/Redis/time/>)
+ [` ->ttl($key) `](</hack/reference/class/Redis/ttl/>)
+ [` ->type($key) `](</hack/reference/class/Redis/type/>)
+ [` ->unwatch() `](</hack/reference/class/Redis/unwatch/>)
+ [` ->watch($key) `](</hack/reference/class/Redis/watch/>)
+ [` ->zAdd($key, $score1, $value1, ...$more_scores = NULL) `](</hack/reference/class/Redis/zAdd/>)
+ [` ->zCard($key) `](</hack/reference/class/Redis/zCard/>)
+ [` ->zCount($key, $start, $end) `](</hack/reference/class/Redis/zCount/>)
+ [` ->zDelete($key, $member1, $member2 = NULL, $memberN = NULL) `](</hack/reference/class/Redis/zDelete/>)
+ [` ->zDeleteRangeByRank($key, $start, $end) `](</hack/reference/class/Redis/zDeleteRangeByRank/>)
+ [` ->zDeleteRangeByScore($key, $start, $end) `](</hack/reference/class/Redis/zDeleteRangeByScore/>)
+ [` ->zIncrBy($key, $value, $member) `](</hack/reference/class/Redis/zIncrBy/>)
+ [` ->zInter($Output, $ZSetKeys, array $Weights = array ( ), $aggregateFunction = 'SUM') `](</hack/reference/class/Redis/zInter/>)
+ [` ->zInterStore($key, array $keys, array $weights = NULL, $op = '') `](</hack/reference/class/Redis/zInterStore/>)
+ [` ->zRange($key, $start, $end, $withscores = false) `](</hack/reference/class/Redis/zRange/>)
+ [` ->zRangeByScore($key, $start, $end, array $options = array ( )) `](</hack/reference/class/Redis/zRangeByScore/>)
+ [` ->zRank($key, $member) `](</hack/reference/class/Redis/zRank/>)
+ [` ->zRem($key, $member1, $member2 = NULL, $memberN = NULL) `](</hack/reference/class/Redis/zRem/>)
+ [` ->zRemRangeByRank($key, $start, $end) `](</hack/reference/class/Redis/zRemRangeByRank/>)
+ [` ->zRemRangeByScore($key, $start, $end) `](</hack/reference/class/Redis/zRemRangeByScore/>)
+ [` ->zRevRange($key, $start, $end, $withscores = false) `](</hack/reference/class/Redis/zRevRange/>)
+ [` ->zRevRangeByScore($key, $start, $end, array $options = array ( )) `](</hack/reference/class/Redis/zRevRangeByScore/>)
+ [` ->zRevRank($key, $member) `](</hack/reference/class/Redis/zRevRank/>)
+ [` ->zScan($key, &$iterator, $pattern = NULL, $count = NULL) `](</hack/reference/class/Redis/zScan/>)
+ [` ->zScore($key, $member) `](</hack/reference/class/Redis/zScore/>)
+ [` ->zSize($key) `](</hack/reference/class/Redis/zSize/>)
+ [` ->zUnion($Output, $ZSetKeys, array $Weights = array ( ), $aggregateFunction = 'SUM') `](</hack/reference/class/Redis/zUnion/>)
+ [` ->zUnionStore($key, array $keys, array $weights = NULL, $op = '') `](</hack/reference/class/Redis/zUnionStore/>)







### Protected Methods




* [` ->checkConnection($auto_reconnect = true) `](</hack/reference/class/Redis/checkConnection/>)
* [` ->doConnect($host, $port, $timeout, $persistent_id, $retry_interval, $persistent = false) `](</hack/reference/class/Redis/doConnect/>)
* [` ->doEval($cmd, $script, array $args, $numKeys) `](</hack/reference/class/Redis/doEval/>)
* [` ->flushCallbacks($multibulk = true) `](</hack/reference/class/Redis/flushCallbacks/>)
* [` ->process1Response() `](</hack/reference/class/Redis/process1Response/>)
* [` ->processArrayCommand($cmd, array $args) `](</hack/reference/class/Redis/processArrayCommand/>)\
  Actually send a command to the server
* [` ->processAssocResponse(array $keys, $unser_val = true) `](</hack/reference/class/Redis/processAssocResponse/>)
* [` ->processBooleanResponse() `](</hack/reference/class/Redis/processBooleanResponse/>)
* [` ->processClientListResponse() `](</hack/reference/class/Redis/processClientListResponse/>)
* [` ->processCommand($cmd, ...$args) `](</hack/reference/class/Redis/processCommand/>)
* [` ->processDoubleResponse() `](</hack/reference/class/Redis/processDoubleResponse/>)
* [` ->processInfoResponse() `](</hack/reference/class/Redis/processInfoResponse/>)
* [` ->processLongResponse() `](</hack/reference/class/Redis/processLongResponse/>)
* [` ->processMSetCommand($cmd, array $data) `](</hack/reference/class/Redis/processMSetCommand/>)
* [` ->processMapResponse($unser_key, $unser_val = true) `](</hack/reference/class/Redis/processMapResponse/>)
* [` ->processQueuedResponse() `](</hack/reference/class/Redis/processQueuedResponse/>)
* [` ->processRawResponse() `](</hack/reference/class/Redis/processRawResponse/>)
* [` ->processSerializedResponse() `](</hack/reference/class/Redis/processSerializedResponse/>)
* [` ->processStringResponse() `](</hack/reference/class/Redis/processStringResponse/>)
* [` ->processTypeResponse() `](</hack/reference/class/Redis/processTypeResponse/>)
* [` ->processVariantResponse() `](</hack/reference/class/Redis/processVariantResponse/>)
* [` ->processVectorResponse($unser = 0) `](</hack/reference/class/Redis/processVectorResponse/>)
* [` ->scanImpl($cmd, $key, &$cursor, $pattern, $count) `](</hack/reference/class/Redis/scanImpl/>)
* [` ->sockReadData(&$type) `](</hack/reference/class/Redis/sockReadData/>)
* [` ->sockReadLine() `](</hack/reference/class/Redis/sockReadLine/>)
* [` ->sortClause(array $arr, &$using_store) `](</hack/reference/class/Redis/sortClause/>)
* [` ->translateVarArgs(array $args, $flags) `](</hack/reference/class/Redis/translateVarArgs/>)\
  Process arguments for variadic functions based on $flags
* [` ->zInterUnionStore($cmd, $key, array $keys, array $weights = NULL, $op = '') `](</hack/reference/class/Redis/zInterUnionStore/>)
* [` ->zRangeByScoreImpl($cmd, $key, $start, $end, array $opts = NULL) `](</hack/reference/class/Redis/zRangeByScoreImpl/>)







### Private Methods




- [` ->doProcessVariantResponse() `](</hack/reference/class/Redis/doProcessVariantResponse/>)
<!-- HHAPIDOC -->
