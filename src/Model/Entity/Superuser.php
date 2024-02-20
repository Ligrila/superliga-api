<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Superuser Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $hash
 * @property bool $enabled
 * @property string $document
 * @property string $address
 * @property string $postal_code
 * @property string $phone
 * @property string $mobile_phone
 * @property string $fax
 * @property string $dir
 * @property string $image
 * @property string $about
 * @property \Cake\I18n\FrozenTime $last_login
 * @property int $login_count
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property string $city
 * @property string $province
 * @property string $nationality
 * @property bool $deleted
 * @property bool $receive_emails
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 */
class Superuser extends Entity
{

    /**
     * Fields that can be mass assigned using newEmptyEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
}
