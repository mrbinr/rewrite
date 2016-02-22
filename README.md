# mrbinr/rewrite

This bundle is used to rewrite string replacing all specials characters.

### Installation


```sh
$ composer require mrbinr/rewrite
```
### Symfony2
Now, you need to add the bundle class to AppKernel.php :
```php
# app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Mrbinr\RewriteBundle(),
        );
        // ...
    }
    // ...
}
```
Now you can use the bundle into your entity annotation like this :
```php
    /**
     * @var string $slug
     * @ORM\Column(length=150, nullable=false, unique=true)
     * @Rewrite(fields={"name"})
     */
    private $slug;
```
The example above will create a property slug based on property name of your entity.
If name value is *Hello World* slug will be set to *hello-world*.

## Parameters
* fields : field used to create rewrited string
* wordSeparator : word separator
* ancestors : field used as ancestors; useful for relation with other entity
* separatorWithAncestors : separator with ancestors

```php
    /**
     * @ORM\ManyToOne(targetEntity="myEntity")
     * @ORM\JoinColumn (name="entity_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var string $slug
     * @ORM\Column(length=150, nullable=false, unique=true)
     * @Rewrite(fields={"name"}, wordSeparator="-", ancestors={"parent"}, separatorWithAncestors="/")
     */
    private $slug;
```

## Author

* mrbinr

## License

The MIT License (MIT)

Copyright (c) 2012-2014 Florian Eckerstorfer

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
