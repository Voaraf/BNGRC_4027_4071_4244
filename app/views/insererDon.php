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
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="donation" name="donation" placeholder="Subject">
                                    <label for="donation">Fanomezana</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="type_donation" class="form-select">
                                        <?php foreach($types as $type) { ?>
                                            <option value="<?= $type['id_type'] ?>"><?= $type['nom_type'] ?></option> 
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="quantite" name="quantite_donnee" placeholder="Subject">
                                    <label for="quantite">Habetsahana</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="donneur" name="donneur" placeholder="Subject">
                                    <label for="donneur">Amin’ny anaran'i</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary py-3 px-4" type="submit">Insérer</button>
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
