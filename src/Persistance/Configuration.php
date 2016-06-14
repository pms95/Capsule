<?php namespace MLS\Capsule\Persistance;

trait Configuration
{
    /**
     * Return an instance of the Options object
     *
     * @return MLS\Capsule\Persistance\Options
     */
    public function persistableConfig()
    {
        return new Options($this, $this->persistableConfig);
    }
}
