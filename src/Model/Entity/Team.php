<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Team Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Team extends Entity
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

    protected $_virtual = ['avatar'];

    private function createImg ($dest, $width, $height) {
        $img = imagecreatetruecolor($width, $height);
        imagesavealpha($img, true);
        $color = imagecolorallocatealpha($img, 0, 0, 0, 127);
        imagefill($img, 0, 0, $color);
        imagepng($img, $dest);
    }
    protected function _getAvatar(){
        $avatar = $this->getRealAvatar();
        if($avatar){
            return $avatar;
        }

        $defaultFile = \Cake\Routing\Router::url('/img/teams/generic-team-logo.png',true);

        $slug = \Cake\Utility\Text::slug(strtolower($this->_fields['name']));
        $file = \Cake\Routing\Router::url('/img/teams/'.$slug.'.png?v=3',true);
        $localFile = WWW_ROOT .  '/img/teams/'.$slug.'.png';
        // solo para debug, necesitamos que siempre este el avatar del equipo presente en la app movil
        // si falta este assets lo necesitamos si o si
        // por convencion los avatar van en el directorio teams con el nombre del equipo en slug
        if(!file_exists($localFile)){
            return $defaultFile;
        }
        return $file;
    }
    private  function getRealAvatar()
    {
        $file = false;
        if(!empty($this->_fields['picture'])){
            return $this->_fields['picture'];
        }

        return $file;
    }
}
