<!-- Modal for displaying cargo details -->
<div id="detailsModal" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center" style="display:none;">
  <div class="bg-white p-6 rounded shadow-md w-2/3 h-3/4 overflow-auto">
    <h2 class="text-2xl font-bold mb-4">Détails de la Cargaison</h2>
    <div id="cargoDetails">
        </div>
    <table class="table">
        <thead class="bg-custom-blue-sky text-black">
        <tr>
            <th>id</th>
            <th>code</th>
            <th>Poids</th>
            <th>Statut</th>
            <th>Type</th>
            <th>Etat</th>
        </tr>
        </thead>
        <tbody id="tbody-details">    
        </tbody>
    </table>

    <button type="button" class="btn btn-error text-white" onclick="closeModal()">Fermer</button>
    
  </div>
</div>
<script type="module" src="./dist/model/product.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script type="module" src="./dist/map.js"></script>