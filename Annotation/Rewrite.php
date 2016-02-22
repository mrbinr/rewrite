<?php

namespace Mrbinr\RewriteBundle\Annotation;
use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
final class Rewrite extends Annotation
{
    /**
     * @var string
     */
    public $fields;
    public $wordSeparator;
    public $ancestors=[];
    public $separatorWithAncestors;

    /**
     * @return mixed
     */
    public function getSeparatorWithAncestors()
    {
        return $this->separatorWithAncestors;
    }

    /**
     * @return mixed
     */
    public function getAncestors()
    {
        return $this->ancestors;
    }

    /**
     * @return mixed
     */
    public function getWordSeparator()
    {
        return $this->wordSeparator;
    }

    /**
     * @return string
     */
    public function getFields()
    {
        return $this->fields;
    }
}
