<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="<?=app_name()?>" />
    <meta name="author" content="Raúl Z5avaleta Zea" />
    <title><?=app_name()?> | <?=$_APP_COMPONENTS['title']?></title>
    <link href="<?=base_url('static/css/admin/styles.css')?>" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">        
    <link rel="stylesheet" href="<?=base_url('static/js/awn/style.css')?>">
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?=base_url('app/dashboard')?>">
            <?=app_name()?>
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <?=$_APP_COMPONENTS['nav']?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?=$_APP_COMPONENTS['title']?></h1>
                    <?=$_APP_COMPONENTS['fragment']?>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted"><?=date('Y')?> &reg; <?=app_name()?>. Todos los derechos reservados</div>
                        <div>
                            <a href="javascript:alert('Todos necesitamos ayuda, un abrazo.\n\n(>\' \')>')" style="text-decoration: none !important;">
                                <i class="fas fa-headset"></i>
                                &nbsp;
                                ¿Necesitas ayuda?
                            </a>
                            &middot;
                            <a href="javascript:alert('Tu información está segura, !lo prometemos¡.')">Aviso de privacidad</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?php
    /*
    En caso de que un controlador invoque ventanas modales desde el middleware, 
    Realizamos el render en esta vista principal
     */
    if (isset($modals) && is_array($modals)) : 
        foreach($modals as $modal) :  
            echo $modal;
        endforeach; 
    endif; ?>

    <script> function baseUrl(param= '') { return `<?=base_url()?>${param}`; } </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9bf90085c5.js" crossorigin="anonymous"></script>
    <script src="<?=base_url('static/js/awn/index.var.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>    
    <script src="<?=base_url('static/js/admin/scripts.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('static/js/admin/app.js')?>"> </script>    
    <?php if (isset($js_scripts) && is_array($js_scripts)) : 
    foreach($js_scripts as $script) :?>
        <script type="text/javascript" src="<?=base_url("static/js/admin/$script")?>"></script>
    <?php endforeach;
endif; ?>
</body>
</html>
