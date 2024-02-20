<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message info alert alert-info text-center" onclick="this.classList.add('hidden');"><?= $message ?></div>
