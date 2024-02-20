<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HomeBanner Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate|null $end_date
 * @property array|null $data
 * @property string|null $picture
 * @property string|null $picture_dir
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class HomeBanner extends Entity
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

    protected $_virtual = [
        'banner',
        'type'
    ];
    protected function _getType(){
        return 'banner';
    }
    protected function _getBanner()
    {
        $file = \Cake\Routing\Router::url('/img/default_home_banner.png',true);
        if(!empty($this->_fields['picture'])){
            return $this->_fields['picture'];
        }

        return $file;
    }
}
