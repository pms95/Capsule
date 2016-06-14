<?php namespace MLS\Capsule;

class Capsule {

  /**
   * The HTTP Connection
   *
   * @var MLS\Capsule\Connection
   */
  protected $connection;

  /**
   * Create a new instance of Capsule
   *
   * @param MLS\Capsule\Connection $connection
   * @return void
   */
  public function __construct(Connection $connection)
  {
    $this->connection = $connection;
  }

  /**
   * Return a new Party model
   *
   * @return MLS\Capsule\Party
   */
  public function party()
  {
    return new Party($this->connection);
  }

}
