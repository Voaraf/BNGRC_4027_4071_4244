<?php
require_once __DIR__ . '/header.php';
?>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-light p-5">
                    <h1 class="display-6 mb-4">Hampiditra Vokatra</h1>
                    <form action="/traitementinsererProduit" method="post">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nom_produit" name="nom_produit" placeholder="Anaran'ny vokatra">
                                    <label for="nom_produit">Anaran'ny vokatra (Nom)</label>
                                    <?php if(isset($errors['nom_produit'])) { ?>
                                        <small class="text-danger"><?= $errors['nom_produit'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="id_type" name="id_type">
                                        <option value="">Safidio ny karazany</option>
                                        <?php foreach($types as $type) { ?>
                                            <option value="<?= $type['id_type'] ?>"><?= htmlspecialchars($type['nom_type']) ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="id_type">Karazany (Type)</label>
                                    <?php if(isset($errors['id_type'])) { ?>
                                        <small class="text-danger"><?= $errors['id_type'] ?></small>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" step="0.01" class="form-control" id="prix_unitaire" name="prix_unitaire" placeholder="Vidiny">
                                    <label for="prix_unitaire">Vidiny isam-unit (Prix Unitaire)</label>
                                    <?php if(isset($errors['prix_unitaire'])) { ?>
                                        <small class="text-danger"><?= $errors['prix_unitaire'] ?></small>
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
            
            <div class="col-lg-7 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="display-6 mb-4">Lisitry ny vokatra</h1>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>Anarana</th>
                                <th>Karazany</th>
                                <th>Vidiny (Ar)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($produits as $p) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($p['nom_produit']) ?></td>
                                    <td><?= htmlspecialchars($p['nom_type']) ?></td>
                                    <td><?= number_format($p['prix_unitaire'], 2, ',', ' ') ?></td>
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
