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
                    
                    <!-- Filter Form -->
                    <form action="/achats" method="get" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <select name="ville" class="form-select" onchange="this.form.submit()">
                                    <option value="">Toutes les villes</option>
                                    <?php foreach ($villes as $v): ?>
                                        <option value="<?= $v['id_ville'] ?>" <?= (isset($selected_ville) && $selected_ville == $v['id_ville']) ? 'selected' : '' ?>>
                                            <?= $v['nom_ville'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-secondary w-100" type="submit">Filtrer</button>
                            </div>
                        </div>
                    </form>

                    <form action="/traitementinsererAchat" method="post">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating" >
                                   <select name="besoin_ville" class="form-select" >
                                        <?php foreach ($besoin as $b): ?>
                                            <option value="<?= $b['id_besoin'] ?>"><?= $b['besoin'] ?> (<?= $b['nom_type'] ?>) - <?= $b['nom_ville'] ?> - <?= $b['quantite_besoin'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="quantite" name="quantite" placeholder="Subject" value="<?= isset($values['quantite']) ? $values['quantite'] : '' ?>">
                                    <label for="quantite">Habetsahany</label>
                                    <?php if (isset($errors['quantite']) && $errors['quantite']): ?>
                                        <div class="text-danger"><?= $errors['quantite'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Acheter</button>
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
