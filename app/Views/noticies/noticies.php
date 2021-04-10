<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-xs-12 col-md-12">
                <h1>Llistat de noticies</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-center pt-5">
            <?php
                foreach($noticies as $noticia):
            ?>
            <div class="col-xs-3 col-md-3">
                <div class="card">
                    <div class="card-header">
                        <img class="card-img-top"
                            src="<?php echo('http:\\\\'.$_SERVER['SERVER_NAME'].':8080'.'/img/'.esc($noticia['imatge_nom'])); ?>"
                            alt="Card image cap">
                        <h2>
                            <a href="/noticia/<?php echo($noticia['noticia_id'])?>"><?= esc($noticia['Titol'])?></a>
                        </h2>
                        <span class="badge badge-primary"><?php echo($noticia['categoria_nom']);?></span>
                    </div>
                    <div class="card-body">
                        <p><?= esc($noticia['Contingut'])?></p>
                    </div>
                </div>
            </div>

            <?php 
                endforeach;
            ?>
        </div>
    </div>

    <script>
        < script src = "https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity = "sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin = "anonymous" >
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    </script>
</body>

</html>