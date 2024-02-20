<?php $this->assign('title', 'Confirmación de email'); ?>
<?= $this->Email->para(null,"Bienvenido {$user['first_name']}")?>

<?= $this->Email->para(null,"Por favor confirme su cuenta de correo electrónico haciendo clic en el siguiente enlace:")?>
<?= $this->Email->para(null,$this->Email->link('Confirmar cuenta', '/users/confirm/'.$user->validation_hash ) )?>
<?= $this->Email->para(null,"")?>
<?= $this->Email->para(null,"Si, por algún motivo, no puede hacer clic en el enlace anterior, copie y pegue lo siguiente en la barra de direcciones de su navegador:")?>

<?= $this->Email->para(null,\Cake\Routing\Router::url('/users/confirm/'.$user->validation_hash ,true))?>

<?= $this->Email->para(null,"")?>
<?= $this->Email->para(null,"Un abrazo,")?>
<?= $this->Email->para(null,"Jugada AFA")?>
<?= $this->Email->image('/img/logo.png') ?>

