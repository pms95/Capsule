<?php namespace MLS\Capsule\Associations;

trait HasMany
{
    public function hasMany($name)
    {
        $association = new HasManyAssociation($name, $this);

        $this->associations[$name] = $association->proxy($this);
    }
}
