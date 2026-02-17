<?php
require_once __DIR__ . '/header.php';

?>
<body>
    <div class="container-fluid py-5">
        <div class="container">
            <!-- Recap Section -->
            <div class="text-center mx-auto wow fadeIn" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="section-title bg-white text-center text-primary px-3">Récapitulatif</p>
                <h1 class="display-6 mb-4">Statistiques Globales</h1>
                <button id="btn-refresh-recap" class="btn btn-primary mb-4">Actualiser</button>
            </div>
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card p-3">
                        <h5>Besoins Totaux</h5>
                        <p class="fs-4" id="total-besoins">Chargement...</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h5>Besoins Satisfaits</h5>
                        <p class="fs-4" id="besoins-satisfaits">Chargement...</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h5>Dons Reçus</h5>
                        <p class="fs-4" id="dons-recus">Chargement...</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <h5>Dons Dispatchés</h5>
                        <p class="fs-4" id="dons-dispatches">Chargement...</p>
                    </div>
                </div>
            </div>

            <!-- City Section Removed (Moved to villes.php) -->
        </div>
    </div>

    <!-- Script for AJAX Recap -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function loadRecap() {
            fetch('/dashboard/recap')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-besoins').innerText = parseFloat(data.total_besoins || 0).toLocaleString() + ' Ar';
                    document.getElementById('besoins-satisfaits').innerText = parseFloat(data.besoins_satisfaits || 0).toLocaleString() + ' Ar';
                    document.getElementById('dons-recus').innerText = parseFloat(data.dons_recus || 0).toLocaleString() + ' Ar';
                    document.getElementById('dons-dispatches').innerText = parseFloat(data.dons_dispatches || 0).toLocaleString() + ' Ar';
                })
                .catch(error => console.error('Error fetching recap:', error));
        }

        // Load on start
        loadRecap();

        // Button listener
        document.getElementById('btn-refresh-recap').addEventListener('click', loadRecap);
    });
    </script>

<?php
require_once __DIR__ . '/footer.php';
?>