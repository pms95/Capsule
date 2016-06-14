<?php namespace MLS\Capsule;

use MLS\Capsule\Querying\Findable;

class Party extends Model {

  use Findable;
  use Associations;
  use Serializable;

  /**
   * The model's queryable options
   *
   * @var array
   */
  protected $queryableOptions = [
    'plural' => 'party'
  ];

  /**
   * The model's serializble config
   *
   * @var array
   */
  protected $serializableConfig = [
    'root' => ['person', 'organisation'],
  ];

  /**
   * The model's child classes
   *
   * @return array
   */
  public function childClasses()
  {
    return ['person', 'organisation'];
  }

  /**
   * Create a new instance of the model
   *
   * @param MLS\Capsule\Connection $connection
   * @return void
   */
  public function __construct(Connection $connection)
  {
    $this->connection = $connection;

    $this->hasMany('tasks');
  }

}
