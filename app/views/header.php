<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BNGRC</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="/assets/img/favicon.ico" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600;700&family=Open+Sans&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="/assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid bg-secondary top-bar wow fadeIn" data-wow-delay="0.1s">
        <div class="row align-items-center h-100">
            <div class="col-lg-4 text-center text-lg-start">
                <a href="index.html">
                    <h1 class="display-5 text-primary m-0">BNGRC</h1>
                </a>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-phone-alt text-dark"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Antsoy izay</h6>
                                <span class="text-white">+261 34 05 480 68</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-envelope-open text-dark"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Mail</h6>
                                <span class="text-white">bngrc@gmail.com</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-end">
                            <div class="flex-shrink-0 btn-square bg-primary">
                                <i class="fa fa-map-marker-alt text-dark"></i>
                            </div>
                            <div class="ms-2">
                                <h6 class="text-primary mb-0">Adiresy</h6>
                                <span class="text-white">
                                    Avaratra Antanimora Route Mausolée
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-secondary px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="nav-bar">
            <nav class="navbar navbar-expand-lg bg-primary navbar-dark px-4 py-lg-0">
                <h4 class="d-lg-none m-0">Menu</h4>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav me-auto">
                        <?php 
                        $current_page = $_SERVER['REQUEST_URI'];
                        function is_active($path, $current_page) {
                            return (strpos($current_page, $path) === 0) ? 'active' : '';
                        }
                        ?>
                        <a href="/dashboard" class="nav-item nav-link <?= is_active('/dashboard', $current_page) ?>">Dashboard</a>
                        <a href="/villes" class="nav-item nav-link <?= is_active('/villes', $current_page) ?>">Villes</a>
                        <a href="/insererDon" class="nav-item nav-link <?= is_active('/insererDon', $current_page) ?>">Donation</a>
                        <a href="/insererBesoin" class="nav-item nav-link <?= is_active('/insererBesoin', $current_page) ?>">Besoin</a>
                        <a href="/achats" class="nav-item nav-link <?= is_active('/achats', $current_page) ?>">Achats</a>
                        <a href="/insererDistribution" class="nav-item nav-link <?= is_active('/insererDistribution', $current_page) ?>">Distribution</a>
                        <a href="/vente" class="nav-item nav-link <?= is_active('/vente', $current_page) ?>">Vente</a>
                    </div>
                    <div class="d-none d-lg-flex ms-auto">
                        <a class="btn btn-square btn-dark ms-2" href="https://x.com/BngrcMada"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-dark ms-2" href="https://www.facebook.com/BNGRCMID/?locale=fr_FR"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-dark ms-2" href="https://www.youtube.com/channel/UC2cc8QnBdihkr4nOyJttjrw/videos"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-11">
                    <div class="h-100 py-5 d-flex align-items-center">
                        <button type="button" class="btn btn-dark rounded-pill py-3 px-5" data-bs-toggle="modal" data-bs-target="#resetModal">Réinitialiser</button>
                        <h3 class="ms-5 mb-0">Miaraka isika afaka manangana tontolo iray izay ahafahan’ny tsirairay mivoatra sy mahomby</h3>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-1">
                    <div class="h-100 w-100 bg-secondary d-flex align-items-center justify-content-center">
                        <span class="text-white" style="transform: rotate(-90deg);">Ampidino</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white border-0 py-3">
                    <h5 class="modal-title" id="resetModalLabel">
                        <i class="fas fa-exclamation-triangle me-2 text-warning"></i>
                        Fanamarihana
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <h4 class="mb-3">Tena ho fafana ve?</h4>
                </div>
                <div class="modal-footer border-0 pb-4 d-flex justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-4 me-2" data-bs-dismiss="modal">Tsia</button>
                    <a href="/reset" class="btn btn-dark rounded-pill px-4">Eny, Fafao</a>
                </div>
            </div>
        </div>
    </div>
