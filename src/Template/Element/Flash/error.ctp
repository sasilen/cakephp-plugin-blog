<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-error" onclick="this.classList.add('hidden');"><?= $message ?></div>
