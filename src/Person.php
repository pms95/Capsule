<?php namespace MLS\Capsule;

use MLS\Capsule\Persistance\Persistable;

class Person extends Party {

  use Validating;
  use Persistable;
  use Contactable;
  use Associations;

  /**
   * The model's validation rules
   *
   * @param array
   */
  protected $rules = [
    'first_name' => 'required',
    'last_name' => 'required'
  ];

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'title',
    'first_name',
    'last_name',
    'job_title',
    'organisation_name',
    'about',
    'created_on',
    'updated_on'
  ];

  /**
   * The model's serializble config
   *
   * @var array
   */
  protected $serializableConfig = [
    'collection_root' => 'parties',
    'additional_methods' => ['contacts']
  ];

  /**
   * Create a new instance of the model
   *
   * @param MLS\Capsule\Connection $connection
   * @param array $attributes;
   * @return void
   */
  public function __construct(Connection $connection, array $attributes =[])
  {
    parent::__construct($connection);

    $this->fill($attributes);

    $this->contacts = new Contacts;

    $this->persistableConfig = [
      'create' => function ($this){ return 'person'; },
      'delete' => function ($this){ return "party/$this->id"; }
    ];

    $this->belongsTo('organisation');
  }
}
