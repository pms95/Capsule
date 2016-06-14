<?php namespace MLS\Capsule\Querying;

trait Configuration {

  /**
   * Return an instance of the Options object
   *
   * @return MLS\Capsule\Querying\Options
   */
  public function queryableOptions()
  {
    return new Options($this);
  }

}
