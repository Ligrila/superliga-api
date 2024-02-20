<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error alert alert-danger text-center" onclick="this.classList.add('hidden');"><?= $message ?></div>
