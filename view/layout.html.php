<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swag Alert!!</title>
</head>
<body>
    <header>Header here</header>
    <footer>Footer here</footer>

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
</body>
</html>