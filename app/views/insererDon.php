<?php
require_once __DIR__ . '/header.php';
?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">Donation</p>
                    <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">Misaotra mialoha !
                    </h1>
                    <img class="w-100"
                        src="assets/img/don.png"
                        style="border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></img>
                </div>
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                   <h3>Tsy ny haben’ny fanomezana no zava-dehibe, fa ny fo madio manome</h3>
                    <p class="mb-4">Ny fanomezana dia fihetsika feno fitiavana sy firaisankina, 
                        entina hanampiana ireo sahirana. Na kely aza ny fanomezana, 
                        dia afaka mitondra fiovana lehibe eo amin’ny fiainan’ny hafa. 
                    </p>
                    <form action="/traitementinsererDon" method="post">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select name="id_produit" class="form-select" id="id_produit">
                                        <option value="">Safidio ny vokatra vokatra</option>
                                        <?php foreach($produits as $produit) { ?>
                                            <option value="<?= $produit['id_produit'] ?>" <?= (isset($values['id_produit']) && $values['id_produit'] == $produit['id_produit']) ? 'selected' : '' ?>><?= htmlspecialchars($produit['nom_produit']) ?> (<?= htmlspecialchars($produit['nom_type']) ?>)</option> 
                                        <?php } ?>
                                    </select>
                                    <label for="id_produit">Vokatra (Produit)</label>
                                    <?php if(!empty($errors['id_produit'])) { ?>
                                        <small class="text-danger"><?= $errors['id_produit'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="quantite" name="quantite_donnee" placeholder="Nombre" value="<?= htmlspecialchars($values['quantite_donnee'] ?? '') ?>">
                                    <label for="quantite">Habetsahany (Quantité)</label>
                                    <?php if(!empty($errors['quantite_donnee'])) { ?>
                                        <small class="text-danger"><?= $errors['quantite_donnee'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="donneur" name="donneur" placeholder="Anarana" value="<?= htmlspecialchars($values['donneur'] ?? '') ?>">
                                    <label for="donneur">Avy amin'i (Donneur)</label>
                                    <?php if(!empty($errors['donneur'])) { ?>
                                        <small class="text-danger"><?= $errors['donneur'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Hanome</button>
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
