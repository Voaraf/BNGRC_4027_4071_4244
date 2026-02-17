<?php
require_once __DIR__ . '/header.php';
?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">Besoin</p>
                    <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">Mila an'izao izahay!
                    </h1>
                    <img class="w-100"
                        src="assets/img/donn.png"
                        style="height: 425px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></img>
                </div>
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                   <h3>Ny mangataka tsy mba mahamenatra, fa ny tsy mifanampy no mahamenatra.</h3>
                    <p class="mb-4">Ity pejy ity dia natao hanehoana ireo olona sy toerana tena mila fanampiana. 
                        Ny fangatahana dia atao amin-kitsim-po sy fahatsorana, 
                        mba hahafahana mahazo tohana sy fanohanana avy amin’ireo vonona hanampy. 
                        Miaraka isika no afaka manamaivana ny fahasahiranana
                    </p>
                    <form action="/traitementinsererBesoin" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                   <select name="id_produit" class="form-select" id="id_produit">
                                        <option value="">Safidio ny vokatra</option>
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
                            <div class="col-md-6">
                                <div class="form-floating">
                                   <select name="ville" class="form-select" id="ville">
                                        <option value="">Safidio ny tanàna</option>
                                        <?php foreach($data as $ville) { ?>
                                            <option value="<?= $ville['id_ville'] ?>" <?= (isset($values['ville']) && $values['ville'] == $ville['id_ville']) ? 'selected' : '' ?>><?= $ville['nom_ville'] ?></option> 
                                        <?php } ?>
                                    </select>
                                    <label for="ville">Tanàna (Ville)</label>
                                    <?php if(!empty($errors['ville'])) { ?>
                                        <small class="text-danger"><?= $errors['ville'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="quantite" name="quantite" placeholder="Nombre" value="<?= htmlspecialchars($values['quantite'] ?? '') ?>">
                                    <label for="quantite">Habetsahany (Quantité)</label>
                                    <?php if(!empty($errors['quantite'])) { ?>
                                        <small class="text-danger"><?= $errors['quantite'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Hampiditra</button>
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
