<?php
require_once __DIR__ . '/header.php';
?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">Achats</p>
                    <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">Fividianana izay ilaina!
                    </h1>
                    <img class="w-100"
                        src="assets/img/achats.png"
                        style="height: 425px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></img>
                </div>
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                   <h3>Ny vola miasa no miteraka soa.</h3>
                    <p class="mb-4">Ny fividianana dia dingana iray hanomezana izay ilaina sy hanatanterahana tanjona. 
                        Eto no ahafahanao misafidy sy mividy ireo entana ilaina mba hanohanana 
                        ny asa sy ny fanampiana atao
                    </p>

                    <form action="/traitementinsererAchat" method="post">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating" >
                                   <select name="besoin_ville" class="form-select" id="besoin_ville">
                                        <option value="">Safidio ny filana hovidiana</option>
                                        <?php foreach ($besoin as $b): ?>
                                            <option value="<?= $b['id_besoin'] ?>"><?= htmlspecialchars($b['besoin']) ?> (<?= htmlspecialchars($b['nom_type']) ?>) - <?= htmlspecialchars($b['nom_ville']) ?> (Mbola ilaina: <?= $b['quantite_besoin'] ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="besoin_ville">Filana hovidiana (Besoin à acheter)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="quantite" name="quantite" placeholder="Nombre" value="<?= isset($values['quantite']) ? $values['quantite'] : '' ?>">
                                    <label for="quantite">Habetsahany (Quantité)</label>
                                    <?php if (isset($errors['quantite']) && $errors['quantite']): ?>
                                        <div class="text-danger"><small><?= $errors['quantite'] ?></small></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Hividy</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
require_once __DIR__ . '/footer.php';
?>
