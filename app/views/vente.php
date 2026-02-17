<?php
require_once __DIR__ . '/header.php';
?>
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <p class="section-title bg-white text-start text-primary pe-3">Vente</p>
                <h1 class="display-6 mb-4">Hivarotra vokatra</h1>
                
                <?php if ($item) { 
                    $imgSrc = !empty($item['icone_type']) ? '/' . ltrim($item['icone_type'], '/') : '/assets/img/default.png';
                ?>
                <div class="bg-light p-4 rounded shadow-sm">
                    <div class="d-flex align-items-center mb-3">
                        <img src="<?= htmlspecialchars($imgSrc) ?>" alt="icone" style="max-width:50px;margin-right:15px;" />
                        <h4 class="mb-0"><?= htmlspecialchars($item['nom_besoin']) ?></h4>
                    </div>
                    <p class="mb-1"><strong>Sokajy:</strong> <?= htmlspecialchars($item['nom_type']) ?></p>
                    <p class="mb-1"><strong>Tahiry:</strong> <span id="stock-max"><?= htmlspecialchars($item['quantite']) ?></span></p>
                    <p class="mb-0"><strong>Vidiny fototra:</strong> <span id="base-price"><?= htmlspecialchars($item['prix_unitaire']) ?></span> Ar</p>
                </div>
                <?php } ?>
            </div>
            
            <div class="col-lg-7 wow fadeIn" data-wow-delay="0.3s">
                <form action="/traitementinsererVente" method="post" id="vente-form">
                    <input type="hidden" name="id_stock" value="<?= $item['id_stock'] ?? '' ?>">
                    <input type="hidden" name="prix_unitaire" value="<?= $item['prix_unitaire'] ?? 0 ?>">
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="number" step="0.01" class="form-control" id="quantite" name="quantite" placeholder="Nombre" min="0.01" max="<?= $item['quantite'] ?? 0 ?>" required>
                                <label for="quantite">Habetsahany (Quantité)</label>
                                <?php if (!empty($errors['quantite'])) { ?>
                                    <small class="text-danger"><?= $errors['quantite'] ?></small>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select name="id_remise" id="id_remise" class="form-select">
                                    <option value="0" data-pct="0">Tsy misy (0%)</option>
                                    <?php foreach($remises as $remise) { ?>
                                        <option value="<?= $remise['id_remise'] ?>" data-pct="<?= $remise['pourcentage'] ?>">
                                            <?= htmlspecialchars($remise['type_remise']) ?> (<?= $remise['pourcentage'] ?>%)
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="id_remise">Karazana fihenam-bidy (Remise)</label>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div class="bg-dark text-white p-4 rounded text-end shadow">
                                <p class="mb-1 fs-5">Zitiny feno (Sous-total) : <span id="sub-total">0.00</span> Ar</p>
                                <p class="mb-1 text-warning">Fihenam-bidy (Remise) : - <span id="discount-val">0.00</span> Ar</p>
                                <hr class="bg-secondary">
                                <h3 class="text-primary mb-0">Vola aloa (Total) : <span id="grand-total">0.00</span> Ar</h3>
                            </div>
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <a href="/catalogue" class="btn btn-light rounded-pill py-3 px-5 me-2">Miverina</a>
                            <button type="submit" class="btn btn-primary rounded-pill py-3 px-5">Varotana</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantiteInput = document.getElementById('quantite');
    const remiseSelect = document.getElementById('id_remise');
    const basePrice = parseFloat(document.getElementById('base-price')?.innerText || 0);
    
    function calculate() {
        const qte = parseFloat(quantiteInput.value || 0);
        const subTotal = qte * basePrice;
        
        const selectedOpt = remiseSelect.options[remiseSelect.selectedIndex];
        const pct = parseFloat(selectedOpt.getAttribute('data-pct') || 0);
        
        const discountVal = subTotal * (pct / 100);
        const grandTotal = subTotal - discountVal;
        
        document.getElementById('sub-total').innerText = subTotal.toLocaleString('fr-FR', { minimumFractionDigits: 2 });
        document.getElementById('discount-val').innerText = discountVal.toLocaleString('fr-FR', { minimumFractionDigits: 2 });
        document.getElementById('grand-total').innerText = grandTotal.toLocaleString('fr-FR', { minimumFractionDigits: 2 });
    }
    
    quantiteInput.addEventListener('input', calculate);
    remiseSelect.addEventListener('change', calculate);
});
</script>

<?php
require_once __DIR__ . '/footer.php';
?>
