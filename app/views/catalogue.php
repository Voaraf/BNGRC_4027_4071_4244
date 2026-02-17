<?php
require_once __DIR__ . '/header.php';
?>
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.1s">
                <div class="service-title">
                    <p class="fs-5 mb-0">Tokantrano sy kojakoja azo amidy</p>
                    <h1 class="display-6 mb-4">Katalaogin'ny vokatra</h1>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="row g-4">
                    <?php foreach($stockDispo as $item) { 
                        $imgSrc = !empty($item['icone_type']) ? '/' . ltrim($item['icone_type'], '/') : '/assets/img/default.png';
                    ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item h-100 p-5 bg-light">
                            <div class="btn-square bg-white mb-4 d-flex align-items-center justify-content-center" style="height:60px;width:60px;">
                                <img src="<?= htmlspecialchars($imgSrc) ?>" alt="icone" style="max-width:38px;max-height:38px;" />
                            </div>
                            <h4 class="mb-3"><?= htmlspecialchars($item['nom_besoin']) ?></h4>
                            <p class="mb-2"><strong>Karazany:</strong> <?= htmlspecialchars($item['nom_type']) ?></p>
                            <p class="mb-2 text-primary"><strong>Tahiry misy:</strong> <?= htmlspecialchars($item['total_quantite']) ?></p>
                            <p class="mb-4"><strong>Vidiny (PU):</strong> <?= number_format($item['prix_unitaire'], 2, ',', ' ') ?> Ar</p>
                            <a href="/vente?id_stock=<?= $item['id_stock'] ?>" class="btn btn-primary px-4 py-2 rounded-pill">Hivarotra</a>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if (empty($stockDispo)) { ?>
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Tsy misy vokatra azo amidy amin'izao fotoana izao.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/footer.php';
?>
