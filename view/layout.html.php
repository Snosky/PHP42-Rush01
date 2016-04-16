<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swag Alert!!</title>
    <link rel="stylesheet" href="<?php echo WEBROOT; ?>/web/css/reset.css">
    <link rel="stylesheet" href="<?php echo WEBROOT; ?>/web/css/style.css">
</head>
<body>
    <header><a href=<?php echo WEBROOT ?>>Home Page</a></header>

    <?php if (!empty($flash_message['error'])): ?>
        <div class="alert alert-error">
        <?php foreach ($flash_message['error'] as $msg): ?>
            <p><?php echo $msg; ?></p>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($flash_message['success'])): ?>
        <div class="alert alert-success">
            <?php foreach ($flash_message['success'] as $msg): ?>
                <p><?php echo $msg; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php echo $content_for_layout ?>
    <footer>Footer here</footer>
    <script type="text/javascript" src="<?php echo WEBROOT ?>web/js/jquery-1.12.3.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT ?>web/js/chat.js"></script>
</body>
</html>