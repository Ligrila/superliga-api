<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HomeBanners Model
 *
 * @method \App\Model\Entity\HomeBanner get($primaryKey, $options = [])
 * @method \App\Model\Entity\HomeBanner newEmptyEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HomeBanner[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HomeBanner|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HomeBanner|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HomeBanner patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HomeBanner[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HomeBanner findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HomeBannersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */

    static public function actions($id=null){
        $act = [
            'navigate'=> 'Ir a sección del APP',
            'link' => 'Ir a sitio web'
        ];
        if($id){
            return $act[$id];
        }

        return $act;
    }

    static public function actionsTargets($id=null){
        $act = [
            'Home'=> 'Inicio',
            'Notification' => 'Notificaciones',
            'ChampionshipHome' => 'Torneo amigos',
            'ChallengeHome'=> 'Desafios',
            'AllChampionships'=> 'Todos los torneos',
            'LivePacks' => 'Comprar vidas',
            'Calendar'=> 'Fixture',
            'Awards'=> 'Premios',
            'Statistics'=> 'Estadísticas',
            'Tutorial'=> 'Tutorial',
            'Ranking'=> 'Ranking',
            'Contact'=> 'Contacto',
            'Profile'=> 'Perfil',
            'Rules'=> 'Reglas del juego',
            'About' => 'Acerca app / actualizar',
        ];
        if($id){
            return $act[$id];
        }

        return $act;
    }
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('home_banners');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('S3', [
            'fields'=>['picture']
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): \Cake\Validation\Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmptyString('start_date');

        $validator
            ->date('end_date')
            ->allowEmptyString('end_date');

        $validator
            ->allowEmptyString('data');


        return $validator;
    }
}
