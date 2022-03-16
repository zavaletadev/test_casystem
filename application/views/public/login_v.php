<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=base_url('favicon.ico')?>" type="image/x-icon">
    <link rel="icon" href="<?=base_url('favicon.ico')?>" type="image/x-icon">
    <title><?=app_name()?> | Login</title>    
    <link rel="stylesheet" href="<?=base_url('static/css/login.css')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">        
    <link rel="stylesheet" href="<?=base_url('static/js/awn/style.css')?>">
</head>
<body>
    <div class="row d-flex justify-content-center" style="margin: 5% 0;">
        <div class="col-12 col-lg-8">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-header p-5 text-center bg-light">
                    <h3>
                        <i class="fas fa-sign-in fa-2x"></i>                        
                        <span class="d-block my-2">
                            Login
                        </span>
                    </h3>
                    
                </div>
                <form id="authForm" class="card-body p-5 text-center">
                    <div class="row">                        
                        <div class="col-12 col-md-4 col-lg-6">
                            <img src="<?=base_url('static/images/AuthenticationFlatline.png')?>" class="img-fluid">                            
                        </div>
                        <div class="col-12 col-md-8 col-lg-6">
                            <?php if ($this->session->flashdata('message')) : ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-<?=$this->session->flashdata('message_type')?> alert-dismissible fade show" role="alert">
                                            <?=$this->session->flashdata('message')?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-floating mb-4">
                                <input type="text" class="form-control validate" id="floatingUsername" required placeholder="E-mail / teléfono" maxlength="70" value="raul.zavaletazea@gmail.com">
                                <label for="floatingUsername" class="text-muted">
                                    <i class="fas fa-user"></i>
                                    &nbsp;
                                    E-mail / teléfono
                                </label>                        
                                <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                    <i class="fas fa-info-circle"></i> Ingresa tu correo electrónico o teléfono a 10 dígitos
                                </small>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control validate" id="floatingPassword" required placeholder="Contraseña" maxlength="16" minlength="8" value="1234567890">
                                <label for="floatingPassword" class="text-muted"> 
                                    <i class="fas fa-lock"></i> 
                                    &nbsp;
                                    Contraseña
                                </label>
                                <small class="d-block text-muted mx-2" style="text-align: left !important;">
                                    <i class="fas fa-info-circle"></i> Ingresa la contraseña de tu cuenta
                                </small>
                            </div>

                            <button id="authFormSubmitBtn" class="btn btn-primary btn-lg btn-block w-100" type="submit">
                                <i class="fas fa-sign-in"></i> 
                                &nbsp;&nbsp; 
                                Acceder
                            </button>                            
                        </div>
                    </div>


                    <hr class="my-5">

                    <a href="#" class="d-block text-muted mb-3 fakerecoverModalLink"> 
                        <i class="fas fa-lock"></i> 
                        Olvidé mi contraseña
                    </a>
                    <a href="#" class="d-block text-muted fakerecoverModalLink"> 
                        <i class="fas fa-user"> </i> 
                        Olvidé mi usuario o teléfono de acceso
                    </a>

                </form>
            </div>
        </div>
    </div>

    <?php 
    if (isset($modals) && is_array($modals)) :
        foreach ($modals as $modal) :
            print($modal);
        endforeach;
    endif; 
    ?>

    <script> function baseUrl(param= '') { return `<?=base_url()?>${param}`; } </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/9bf90085c5.js" crossorigin="anonymous"></script>
    <script src="<?=base_url('static/js/awn/index.var.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="<?=base_url('static/js/login.js')?>"> </script>
</body>
</html>
