<!DOCTYPE html>
<html>
    <head>
        <title><?= $data['title']; ?></title>

        <meta charset="UTF-8">       
    </head>
    <body>
        <div style="height: 150px; border:  1px solid blue">
            <?php
            include $data['header'];
            ?>
        </div>
        <div style="border: 1px solid red">
            <?php
            include $data['content'];
            ?>
        </div>

    </body>
</html>
