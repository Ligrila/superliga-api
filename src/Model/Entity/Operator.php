<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;


/**
 * Operator Entity
 *
 * @property int $id
 * @property string|null $email
 * @property string $role
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $hash
 * @property int|null $enabled
 * @property string|null $document
 * @property string|null $address
 * @property string|null $postal_code
 * @property string|null $phone
 * @property string|null $mobile_phone
 * @property string|null $fax
 * @property string|null $dir
 * @property string|null $image
 * @property string|null $about
 * @property \Cake\I18n\FrozenTime|null $last_login
 * @property int|null $login_count
 * @property \Cake\I18n\FrozenDate|null $birth_date
 * @property string|null $city
 * @property string|null $province
 * @property string|null $nationality
 * @property int|null $deleted
 * @property bool|null $receive_emails
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 */
class Operator extends Entity
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
        'email' => true,
        'role' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'hash' => true,
        'enabled' => true,
        'document' => true,
        'address' => true,
        'postal_code' => true,
        'phone' => true,
        'mobile_phone' => true,
        'fax' => true,
        'dir' => true,
        'image' => true,
        'about' => true,
        'last_login' => true,
        'login_count' => true,
        'birth_date' => true,
        'city' => true,
        'province' => true,
        'nationality' => true,
        'deleted' => true,
        'receive_emails' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true
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
