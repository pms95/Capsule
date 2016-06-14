<?php namespace MLS\Capsule\Meta;

use ReflectionClass;
use MLS\Capsule\Model;

class Base {

  /**
   * The ReflectionClass instance
   *
   * @var ReflectionClass
   */
  protected $reflection;

  /**
   * The class to inspect
   *
   * @param MLS\Capsule\Model $model
   * @return void
   */
  public function __construct(Model $model)
  {
    $this->reflection = new ReflectionClass($model);
  }

  /**
   * Convert the name to lowercase
   *
   * @return MLS\Capsule\Meta\Name
   */
  public function lowercase()
  {
    return $this->getNameInstance()->lowercase();
  }

  /**
   * Convert the name to uppercase
   *
   * @return MLS\Capsule\Meta\Name
   */
  public function uppercase()
  {
    return $this->getNameInstance()->uppercase();
  }

  /**
   * Convert the name to plural
   *
   * @return MLS\Capsule\Meta\Name
   */
  public function plural()
  {
    return $this->getNameInstance()->plural();
  }

  /**
   * Convert the name to singular
   *
   * @return MLS\Capsule\Meta\Name
   */
  public function singular()
  {
    return $this->getNameInstance()->singular();
  }

  /**
   * Create new Name instance
   *
   * @return MLS\Capsule\Meta\Name
   */
  protected function getNameInstance()
  {
    return new Name($this->reflection->getShortName());
  }


}
