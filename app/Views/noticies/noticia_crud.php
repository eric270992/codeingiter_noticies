<!DOCTYPE html>
<html lang="en">
<?php 
foreach($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <h1>Detall de noticia</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 d-flex flex-column">
                <?php echo $output; ?>
            </div>
        </div>
    </div>

    <?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>


</body>

</html>