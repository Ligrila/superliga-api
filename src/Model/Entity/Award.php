<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Award Entity
 *
 * @property int $id
 * @property string $name
 * @property string $picture
 * @property string $picture_dir
 * @property int $points
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Award extends Entity
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
        'avatar'
    ];

    protected function _getAvatar()
    {
        $file = \Cake\Routing\Router::url('/img/default_avatar.jpg',true);
        if(!empty($this->_fields['picture'])){
            return $this->_fields['picture'];
        }

        return $file;
    }

    protected function _getMiniAvatar()
    {
        $file = \Cake\Routing\Router::url('/img/default_avatar.jpg',true);
        if(!empty($this->_fields['picture'])){
            $parsed = parse_url(  $this->_fields['picture']);
            if(!empty($parsed['scheme'])&&!empty($parsed['host'])&&!empty($parsed['path'])){
                return "{$_SERVER['REQUEST_SCHEME']}://jugada-afa.s3-website-sa-east-1.amazonaws.com/40x40{$parsed['path']}";
            }
            return $this->_fields['picture'];
        }

        return $file;
    }
    protected function _getSquareAvatar()
    {
        $file = \Cake\Routing\Router::url('/img/default_avatar.jpg',true);
        if(!empty($this->_fields['picture'])){
            if(!empty($this->_fields['picture'])){
                $parsed = parse_url(  $this->_fields['picture']);
                if(!empty($parsed['scheme'])&&!empty($parsed['host'])&&!empty($parsed['path'])){
                    return "{$_SERVER['REQUEST_SCHEME']}://jugada-afa.s3-website-sa-east-1.amazonaws.com/100x100{$parsed['path']}";
                }
                return $this->_fields['picture'];
            }
            return $this->_fields['picture'];
        }

        return $file;
    }
}
