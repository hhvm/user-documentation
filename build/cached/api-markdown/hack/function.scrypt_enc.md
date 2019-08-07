``` yamlmeta
{
    "name": "scrypt_enc",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/scrypt/ext_scrypt.php"
    ]
}
```




Derive a key using the scrypt key derivation function




``` Hack
function scrypt_enc(
  string $password,
  string $salt,
  int $N = 0,
  int $r = 0,
  int $p = 0,
): mixed;
```




Scrypt employs salting, iteration, and memory-hardness
properties to increase the cost of brute-forcing a secret
given the derived key.




Scrypt is parameterized in order to control the amount
of time a derivation will take.  If unsure what to use
for the N, r, and p parameters, passing a zero value will
select parameters with an estimated calculation time of
.15 seconds.




## Parameters




+ ` string $password `
+ ` string $salt `
+ ` int $N = 0 `
+ ` int $r = 0 `
+ ` int $p = 0 `




## Returns




* ` mixed ` - - Returns a string of the form
  $s$N$r$p$base64(salt)$base64(output), false on failure
<!-- HHAPIDOC -->
