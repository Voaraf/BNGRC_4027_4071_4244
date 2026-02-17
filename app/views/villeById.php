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
                                <h3><?= htmlspecialchars($besoin['besoin']) ?></h3>
                                <p class="mb-2"><strong>Habetsahana: </strong><?= htmlspecialchars($besoin['quantite_besoin']) ?></p>
                                <p class="mb-2"><strong>Sokajy: </strong><?= htmlspecialchars($besoin['nom_type']) ?></p>
                                <a href=""></a>
                            </div>
                        </div>
                        <?php $i++; } ?>
                    </div>
                </div>
            </div>

            <div class="row g-5 mt-5">
                <div class="col-md-12 wow fadeIn" data-wow-delay="0.1s">
                    <div class="service-title">
                        <p class="fs-5 mb-0">Ireo tohana voaray (Achats sy Distributions)</p>
                        <h2 class="display-6 mb-4">Tantaran'ny fanampiana tonga tamin'ny fomba ofisialy</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>Loharano</th>
                                    <th>Zavatra voaray</th>
                                    <th>Karazany</th>
                                    <th>Habetsahany</th>
                                    <th>Daty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($distributions) && !empty($distributions)) { 
                                    foreach($distributions as $dist) { ?>
                                    <tr>
                                        <td>
                                            <span class="badge <?= $dist['source'] === 'Achat' ? 'bg-info' : 'bg-success' ?>">
                                                <?= htmlspecialchars($dist['source']) ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($dist['besoin']) ?></td>
                                        <td><?= htmlspecialchars($dist['nom_type']) ?></td>
                                        <td><?= htmlspecialchars($dist['quantite']) ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($dist['date_mouv'])) ?></td>
                                    </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Mbola tsy nisy fanomezana voaray tamin'ny fomba ofisialy.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once __DIR__ . '/footer.php';
?>