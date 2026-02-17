<?php
require_once __DIR__ . '/header.php';
?>
<body>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeIn" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Ville</p>
                <h1 class="display-6 mb-4">Ireo toerana mila fanampiana avy aminareo</h1>
            </div>
            <div class="row g-4">
                <?php foreach($data as $ville) { ?>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="donation-item d-flex h-100 p-4">
                        <div class="donation-detail">
                            <div class="position-relative mb-4">
                                <img class="img-fluid w-100" src="<?= $ville['image_ville'] ?>" alt="">
                            </div>
                            <a href="#!" class="h3 d-inline-block"><?= $ville['nom_ville'] ?></a>
                            <p>Amin’ny alalan’ny fanomezana sy ny asa an-tsitrapo ataonao, dia manaparitaka hatsaram-panahy sy fanohanana
                            </p>
                            <p class="fw-bold">Achats: <?= number_format($ville['total_achats'], 2) ?> Ar</p>
                            <a href="/ville/<?= $ville['id_ville'] ?>" class="btn btn-primary w-100 py-3"><i class="fa fa-plus me-2"></i>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php
require_once __DIR__ . '/footer.php';
?>
