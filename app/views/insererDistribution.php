<?php
require_once __DIR__ . '/header.php';
?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">Distribution</p>
                    <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">Fizarana sy fanomezana!
                    </h1>
                    <img class="w-100"
                        src="assets/img/about.jpg"
                        style="height: 425px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></img>
                </div>
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                   <h3>Hazo tokana, tsy mba hala</h3>
                    <p class="mb-4">Ny fizarana dia fihetsika feno fitiavana sy firaisankina, 
                        entina hanampiana ireo sahirana. Na kely aza ny fizarana, 
                        dia afaka mitondra fiovana lehibe eo amin’ny fiainan’ny hafa.
                    </p>
                    <form action="/traitementinsererDistribution" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="besoin" name="besoin" placeholder="Ny Filanao" value="<?= htmlspecialchars($values['besoin']) ?>">
                                    <label for="besoin">Filana</label>
                                    <?php if (!empty($errors['besoin'])) { ?>
                                        <small class="text-danger"><?= $errors['besoin'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                   <select name="ville" class="form-select">
                                        <?php foreach($data as $ville) { ?>
                                            <option value="<?= $ville['id_ville'] ?>" <?= ($values['ville'] == $ville['id_ville']) ? 'selected' : '' ?>><?= $ville['nom_ville'] ?></option> 
                                        <?php } ?>
                                    </select>
                                    <?php if (!empty($errors['ville'])) { ?>
                                        <small class="text-danger"><?= $errors['ville'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="quantite" name="quantite" placeholder="Subject" value="<?= htmlspecialchars($values['quantite']) ?>">
                                    <label for="quantite">Habetsahany</label>
                                    <?php if (!empty($errors['quantite'])) { ?>
                                        <small class="text-danger"><?= $errors['quantite'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Distribuer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="row g-4 mb-5">
                <?php foreach($stock as $stock) { ?>
                        <div class="col-md-3">
                            <div class="card p-3">
                                <h5><?= $stock['nom_besoin'] ?></h5>
                                <p class="fs-4" id="dons-dispatches"><?= $stock['total_quantite'] ?></p>
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
require_once __DIR__ . '/footer.php';
?>
