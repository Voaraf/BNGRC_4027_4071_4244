<?php
require_once __DIR__ . '/header.php';
?>
    <div class="container-fluid py-5">
        <div class="container">
            <!-- Success/Error Messages -->
            <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Succès!</strong> La vente a été enregistrée avec succès.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erreur!</strong> Une erreur s'est produite lors de l'enregistrement de la vente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Form Section -->
            <div class="row g-5 mb-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">Vente</p>
                    <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">Mila anzao izay!
                    </h1>
                    <img class="w-100"
                        src="assets/img/donn.png"
                        style="height: 425px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></img>
                </div>
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                   <h3>Ny mangataka tsy mba mahamenatra, fa ny tsy mifanampy no mahamenatra.</h3>
                    <p class="mb-4">Ity pejy ity dia natao hanehoana ireo zavatra azo amidy. 
                        Miaraka isika no afaka manamaivana ny fahasahiranana.
                    </p>
                    <form action="/traitementinsererVente" method="post" id="venteForm">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                   <select name="id_stock" id="selectStock" class="form-select" required onchange="updateFormData()">
                                        <option value="">Safidio ny zavatra</option>
                                        <?php foreach($stockDispo as $s) { ?>
                                            <option value="<?= $s['id_stock'] ?>" 
                                                    data-nom="<?= htmlspecialchars($s['nom_besoin']) ?>"
                                                    data-max="<?= $s['total_quantite'] ?>"
                                                    data-prix="<?= $s['prix_unitaire'] ?>">
                                                <?= htmlspecialchars($s['nom_besoin']) ?> (<?= number_format($s['total_quantite'], 2) ?> disponible)
                                            </option> 
                                        <?php } ?>
                                    </select>
                                    <label for="selectStock">Zavatra</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="quantite" name="quantite" 
                                           placeholder="Quantité" step="0.01" min="0.01" required 
                                           oninput="calculateFormTotal()">
                                    <label for="quantite">Habetsahany</label>
                                </div>
                                <small class="text-muted" id="maxQuantite"></small>
                            </div>
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <strong>Prix unitaire:</strong> <span id="prixUnitaire">-</span> Ar<br>
                                    <strong>Montant total:</strong> <span id="montantTotal" class="fs-5 text-success">0.00</span> Ar
                                </div>
                                <input type="hidden" name="prix_unitaire" id="prixUnitaireHidden">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Vendre</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Catalog Section -->
            <div class="text-center mx-auto wow fadeIn mb-4" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="section-title bg-white text-center text-primary px-3">Catalogue</p>
                <h2 class="mb-4">Articles Disponibles</h2>
            </div>

            <div class="row g-4">
                <?php if(empty($stockDispo)): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h5>Aucun article disponible pour le moment</h5>
                            <p>Il n'y a actuellement aucun article en stock disponible à la vente.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach($stockDispo as $item): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header bg-primary text-white text-center py-3">
                                    <img src="<?= htmlspecialchars($item['icone_type']) ?>" alt="<?= htmlspecialchars($item['nom_type']) ?>" style="width: 40px; height: 40px; object-fit: contain;">
                                    <h6 class="mt-2 mb-0"><?= htmlspecialchars($item['nom_besoin']) ?></h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <span class="badge bg-secondary"><?= htmlspecialchars($item['nom_type']) ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <small><strong>Quantité:</strong></small>
                                        <small class="text-success"><?= number_format($item['total_quantite'], 2) ?></small>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <small><strong>Prix:</strong></small>
                                        <small class="text-primary"><?= number_format($item['prix_unitaire'], 2) ?> Ar</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
    function updateFormData() {
        const select = document.getElementById('selectStock');
        const option = select.options[select.selectedIndex];
        const quantiteInput = document.getElementById('quantite');
        const maxQuantite = document.getElementById('maxQuantite');
        const prixUnitaire = document.getElementById('prixUnitaire');
        const prixUnitaireHidden = document.getElementById('prixUnitaireHidden');
        
        if (option.value) {
            const max = parseFloat(option.dataset.max);
            const prix = parseFloat(option.dataset.prix);
            
            quantiteInput.max = max;
            maxQuantite.textContent = 'Maximum: ' + max.toFixed(2);
            prixUnitaire.textContent = prix.toLocaleString('fr-FR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            prixUnitaireHidden.value = prix;
            
            calculateFormTotal();
        } else {
            quantiteInput.max = '';
            maxQuantite.textContent = '';
            prixUnitaire.textContent = '-';
            prixUnitaireHidden.value = '';
            document.getElementById('montantTotal').textContent = '0.00';
        }
    }
    
    function calculateFormTotal() {
        const quantite = parseFloat(document.getElementById('quantite').value) || 0;
        const prix = parseFloat(document.getElementById('prixUnitaireHidden').value) || 0;
        const total = quantite * prix;
        document.getElementById('montantTotal').textContent = total.toLocaleString('fr-FR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }
    </script>

<?php
require_once __DIR__ . '/footer.php';
?>
