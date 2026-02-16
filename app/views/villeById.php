<?php
require_once __DIR__ . '/header.php';   
?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-12 col-lg-4 col-xl-3 wow fadeIn" data-wow-delay="0.1s">
                    <?php if (isset($ville) && !empty($ville)) { ?>
                    <div class="service-title">
                        <p class="fs-5 mb-0">Ny filàna sy fanomezana azon'ny</p>
                        <h1 class="display-6 mb-4" style="font-size: 2rem"><?= $ville['nom_ville'] ?></h1>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <div class="row g-5">
                        <?php 
                        $delays = ["0.1s", "0.3s", "0.5s"];
                        $i = 0;
                        foreach($data as $besoin) { 
                            $delay = $delays[$i % count($delays)];
                            $imgSrc = !empty($besoin['icone_type']) ? '/' . ltrim($besoin['icone_type'], '/') : '/assets/img/default.png';
                        ?>
                        <div class="col-sm-6 col-md-4 wow fadeIn" data-wow-delay="<?= $delay ?>">
                            <div class="service-item h-100">
                                <div class="btn-square bg-light mb-4 d-flex align-items-center justify-content-center" style="height:60px;width:60px;">
                                    <img src="<?= htmlspecialchars($imgSrc) ?>" alt="icone" style="max-width:38px;max-height:38px;" />
                                </div>
                                <h3><?= htmlspecialchars($besoin['nom_type']) ?></h3>
                                <p class="mb-2"><strong>Habetsahana: </strong><?= htmlspecialchars($besoin['quantite_besoin']) ?></p>
                                <p class="mb-2"><strong>Zavatra hilaina: </strong><?= htmlspecialchars($besoin['besoin']) ?></p>
                                <a href=""></a>
                            </div>
                        </div>
                        <?php $i++; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once __DIR__ . '/footer.php';
?>