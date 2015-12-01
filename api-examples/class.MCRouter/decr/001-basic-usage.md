The following example shows how to decrement a value of a key by a specified integer using `MCRouter::incr`. The value **must** be numeric.

Note that you can't decrement below 0. So if your value is 1 and you try to decrement 3, the value you get back will be 0. 
