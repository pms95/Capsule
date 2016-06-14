<?php namespace MLS\Capsule\Associations;

class HasManyProxy
{
    public function __construct($parent, $targetClass)
    {
        $this->parent = $parent;
        $this->targetClass = $targetClass;
    }
}
