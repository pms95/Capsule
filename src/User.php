<?php namespace MLS\Capsule;

use MLS\Capsule\Querying\FindAll;
use MLS\Capsule\Querying\Configuration;

class User extends Model {

  use FindAll;
  use Associations;
  use Configuration;
  use Serializable;

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'username',
    'name',
    'currency',
    'timezone',
    'logged_in',
    'party_id'
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

    if (isset($attributes['username'])) {
      $attributes['id'] = $attributes['username'];
    }

    $this->fill($attributes);

    $this->belongsTo('party', ['class_name' => 'Party']);
  }

  public function findByUserName($username)
  {
    foreach($this->all() as $user) {
      if ($user->username == $username) {
        return $user;
      }
    }
  }

}
