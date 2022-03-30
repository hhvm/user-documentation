When working with [XHP objects](/hack/XHP/introduction), the `->:` operator can be used to retrieve the value of an object's [attributes](/hack/XHP/basic-usage#attributes). 

{XHP Attribute Selection Example}

An XHP object can have 0 or any number of attributes.

## Static Attributes
If an attribute is statically known, use [$this](/hack/source-code-fundamentals/names#the-current-instance-variable) (`$this->:name`) to refer to the attribute.

{XHP Static Attribute Selection Example}