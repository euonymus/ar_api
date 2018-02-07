<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;

/**
 * Locations Model
 *
 * @method \App\Model\Entity\Location get($primaryKey, $options = [])
 * @method \App\Model\Entity\Location newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Location[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Location|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Location patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Location[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Location findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LocationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('locations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('pin_image')
            ->maxLength('pin_image', 255)
            ->requirePresence('pin_image', 'create')
            ->notEmpty('pin_image');

        $validator
            ->scalar('geo')
            ->requirePresence('geo', 'create')
            ->notEmpty('geo');

        $validator
            ->scalar('altitude')
            ->maxLength('altitude', 255)
            ->requirePresence('altitude', 'create')
            ->notEmpty('altitude');

        return $validator;
    }

    public function beforeFind(Event $event ,Query $query, $options, $primary)
    {
      $columns = $this->schema()->columns();
      // remove geo column, in order not to fail data serialization for json output.
      unset($columns[array_search('geo', $columns)]);
      array_values($columns);
      // set latitude and longitude instead.
      $columns['latitude'] = $query->newExpr()->add('Y(geo)');
      $columns['longitude'] = $query->newExpr()->add('X(geo)');
      return $query->select($columns);
    }

    //public function beforeMarshal(Event $event, $data, $options)
    //{
    //}
    //public function beforeSave(Event $event, EntityInterface $entity, array $data, array $options = [])
    //{
    //}
    public function newEntity($data = null, array $options = [])
    {
      $ret = parent::newEntity( $data, $options);
      $this->patchGeo($ret, $data);
      return $ret;
    }
    public function patchEntity(EntityInterface $entity, array $data, array $options = [])
    {
      $ret = parent::patchEntity( $entity, $data, $options);
      $this->patchGeo($ret, $data);
      return $ret;
    }
    public function patchGeo(EntityInterface $entity, $data)
    {
      if (!is_array($data) || !array_key_exists('latitude', $data) || !array_key_exists('longitude', $data)) return;
      $this->setGeo($entity, $data['latitude'], $data['longitude']);
    }
    public function setGeo(EntityInterface $entity, $latitude, $longitude)
    {
      $entity->geo = $this->find()->newExpr()
        ->add('GeomFromText(\'POINT('. $longitude . ' ' . $latitude . ')\')');
    }


    /****************************************************************************/
    /* find                                                                     */
    /****************************************************************************/
    public function search($data)
    {
      return $this->find()
	->select(['distance' => self::distanceColumn($data['latitude'], $data['longitude'])])
	->where(self::whereDistanceLt($data['distance'], $data['latitude'], $data['longitude']));
    }

    /****************************************************************************/
    /* where                                                                    */
    /****************************************************************************/
    // Unit is in meter
    public static function distanceColumn($latitude, $longitude)
    {
      // ref: http://kobarin.hateblo.jp/entry/20110630/1309419551
      $latWeight = 111;
      $longWeight = 91;
      return "GLENGTH( GEOMFROMTEXT( CONCAT( 'LineString( ". ($longitude * $longWeight) ." ". ($latitude * $latWeight) ." , ', X( geo ) * " . $longWeight . " ,  ' ', Y( geo ) * " . $latWeight . " ,  ')' ) ) ) * 1000";
    }
    public static function whereDistanceLt($distance, $latitude, $longitude)
    {
      return [self::distanceColumn($latitude, $longitude) . ' <' => $distance];
    }
    public static function whereDistanceGt($distance, $latitude, $longitude)
    {
      return [self::distanceColumn($latitude, $longitude) . ' >=' => $distance];
    }
}
