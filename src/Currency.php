<?php namespace MLS\Capsule;

use MLS\Capsule\Querying\FindAll;
use MLS\Capsule\Querying\Configuration;

class Currency extends Model {

  use FindAll;
  use Configuration;
  use Serializable;

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'code'
  ];

  /**
   * The model's serializble config
   *
   * @var array
   */
  protected $serializableConfig = [
    'attribute_to_assign' => 'code'
  ];

  /**
   * Create a new instance of the model
   *
   * @param MLS\Capsule\Connection $connection
   * @param array $attributes;
   * @return void
   */
  public function __construct(Connection $connection,  array $attributes = [])
  {
    $this->connection = $connection;

    $this->fill($attributes);
  }

}
