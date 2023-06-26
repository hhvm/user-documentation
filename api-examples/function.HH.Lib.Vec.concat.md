```basic-usage.hack
$original_vec = vec["abc", "def", "ghi"];
$rest = vec["xxx", "yyy"];
$concat_vec = Vec\concat($original_vec, $rest);
echo "Resulting concat vec: \n";
\print_r($concat_vec);
//Output: Resulting concat vec: 
//vec["abc", "def", "ghi", "xxx", "yyy"]
```