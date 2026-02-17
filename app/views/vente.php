<?php
require_once __DIR__ . '/header.php';
?>
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <p class="section-title bg-white text-start text-primary pe-3">Besoin</p>
                    <h1 class="display-6 mb-4 wow fadeIn" data-wow-delay="0.2s">Mila anzao izay!
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
                            <div class="col-md-17">
                                <div class="form-floating">
                                   <select name="ville" class="form-select">
                                        <?php foreach($stockDispo as $s) { ?>
                                            <option value="<?= $s['nom_besoin'] ?>"><?= $s['nom_besoin'] ?></option> 
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Subject" max="<?= $s['total_quantite'] ?>">
                                    <label for="quantite">Habetsahany</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Vendre</button>
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
