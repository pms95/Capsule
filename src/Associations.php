<?php namespace MLS\Capsule;

use MLS\Capsule\Associations\HasMany;
use MLS\Capsule\Associations\BelongsTo;
use MLS\Capsule\Associations\HasManyAssociation;
use MLS\Capsule\Associations\BelongsToAssociation;

trait Associations
{
    use HasMany;
    use BelongsTo;

    /**
     * Return the Has Many associations
     *
     * @return array
     */
    public function hasManyAssociations(){}

    /**
     * Return the Belongs To associations
     *
     * @return array
     */
    public function belongsToAssociations()
    {
        $associations = [];

        foreach ($this->associations as $name => $association) {
            if ($association instanceOf BelongsToAssociation) {
                $associations[$name] = $association;
            }
        }

        return $associations;
    }
}
