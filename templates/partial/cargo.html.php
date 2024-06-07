
<div class="flex justify-between items-center">
    <h1 class="font-bold">Liste des cargaisons</h1>
    <div class="mt-4">
        <!-- <select id="countries_disabled" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 ml-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> -->
        <select id="cargo-type-search" class="bg-pink-800 border border-pink-900 text-gray-900  rounded-lg focus:bg-pink-300 block w-full py-3 pl-2 pr-11 ml-3 dark:bg-pink-300 dark:bg-pink-100 dark:placeholder-pink-400 dark:text-gray dark:focus:pink-100">
            <option selected disabled value="">Filter par cargaison</option>
            <option value="AIR">Aérienne</option>
            <option value="MARITIME">Maritime</option>
            <option value="ROAD">Routière</option>
        </select>
    </div>
</div>

<div class="shadow-sm border-b mt-4"></div>

<div class="flex text-black">
    <!-- <a class="flex flex-col items-center mr-5" href="#">
        <img class="h-14 w-14 rounded-full p-[1.5px] border-2 border-red-500 flex justify-center items-center hover:cursor-pointer hover:scale-110 transition-transform duration-200 ease-out" src="https://www.inc-conso.fr/sites/default/files/avion-800_1.png" alt="Cargaison Maritime">
        <p class="text-xs w-14 text-center">Aérienne</p>
    </a>
    <a class="flex flex-col items-center mr-5" href="#">
        <img class="h-14 w-14 rounded-full p-[1.5px] border-2 border-red-500 flex justify-center items-center hover:cursor-pointer hover:scale-110 transition-transform duration-200 ease-out" src="https://www.actu-environnement.com/images/illustrations/news/36586_large.jpg" alt="Cargaison Maritime">
        <p class="text-xs w-14 text-center">Maritime</p>
    </a>
    <a class="flex flex-col items-center mr-5" href="#">
        <img class="h-14 w-14 rounded-full p-[1.5px] border-2 border-red-500 flex justify-center items-center hover:cursor-pointer hover:scale-110 transition-transform duration-200 ease-out" src="https://img.freepik.com/vecteurs-libre/camion-transport-dessine-main_23-2149161394.jpg" alt="Cargaison Maritime">
        <p class="text-xs w-14 text-center">Routière</p>
    </a> -->

    <!-- <select class="py-2 pl-1 outline-none rounded-lg" id="cargo-type" name="type">
        <option value="0">Filter par cargaison</option>
        <option value="">Aérienne</option>
        <option value="">Maritime</option>
        <option value="">Routière</option>
    </select> -->
    <div class="flex gap-2 mt-6">
        <div class="relative">
            <input class="h-12 w-64 rounded-full outline-none pl-8 border border-pink-300 bg-white" type="text" id="cargo-code-search" placeholder="Rechercher par code">
            <div class="absolute top-3 left-3">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>
        <div class="relative">
            <input class="h-12 w-80 rounded-full outline-none pl-8 border border-pink-300 bg-white" type="text" id="departure-point-search" placeholder="Rechercher par lieu de départ">
            <div class="absolute top-3 left-3">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>
        <div class="relative">
            <input class="h-12 w-80 rounded-full outline-none pl-8 border border-pink-300 bg-white" type="text" id="arrival-point-search" placeholder="Rechercher par lieu de d'arrivée">
            <div class="absolute top-3 left-3">
                <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
            </div>
        </div>
    </div>

    <div class="ml-14 mt-6">
        <label>Date départ</label>
        <input type="date" class="border pl-2 py-1 px-5 rounded-xl mt-1 border-pink-300 bg-white outline-none" id="leaving-date-search">
    </div>
    <div class="mt-6">
        <label>Date arrivée</label>
        <input type="date" class="border pl-2 py-1 px-5 rounded-xl mt-1 border-pink-300 bg-white outline-none" id="arrived-date-search">
    </div>
</div>

<div class="shadow-sm border-b mt-4"></div>

<?php
   $json_data = file_get_contents('cargaisons.json');
   $cargos = json_decode($json_data, true);
?>

<!-- TABLEAU -->
<div class="overflow-x-auto mt-5 ">
    <table class="table text-black">
        <thead class="bg-pink-300 text-black">
        <tr>
            <th>Code</th>
            <th>Poids/Nbr Colis</th>
            <th>Lieu de départ</th>
            <th>Lieu d'arrivée</th>
            <th>Date de départ</th>
            <th>Date d'arrivée</th>
            <th>Distance</th>
            <th>Type</th>
            <th>Etat Global</th>
            <th>Etat Avancement</th>
            <th></th>
            <th>Actions</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="tbody-cargo">
            <?php foreach($cargos['cargaisons'] as $c) : ?>
                <?php 
                    // Convertir les chaînes "null" en valeurs nulles réelles
                    foreach ($c as $key => $value) {
                        if ($value === "null") {
                            $c[$key] = null;
                        }
                    }
                ?>
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-12 h-12">
                                    <img src="<?=$c['image']?>" alt="Cago image"/>
                                </div>
                            </div>
                            <div>
                                <div class="font-bold"><?=$c['reference']?></div>
                                <div class="border-2 border-white text-xs opacity-50 badge badge-xs badge-error"></div>
                            </div>
                        </div>
                    </td>
                    <td><?= !is_null($c['maxWeight']) ? $c['maxWeight'] . ' (KG)' : $c['maxNbrProduct'] ?></td>
                    <td><?= $c['departurePoint'] ?></td>
                    <td><?= $c['arrivalPoint'] ?></td>
                    <td><?= $c['leavingDate'] ?></td>
                    <td><?= $c['arrivedDate'] ?></td>
                    <td><?= $c['distance'] . ' (KM)' ?></td>
                    <td><?= $c['type'] ?></td>
                    <td><?= $c['globalState'] ?></td>
                    <td><?= $c['progressionState'] ?></td>
                    <td><button type="button" class="add-product-btn" data-id="<?= $c['id'] ?>">Ajouter cargaison</button></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="flex justify-end pr-4 mt-2">
        <button id="prev-page" class="bg-pink-600 text-white px-2 py-1 rounded" type="button"><</button>
            <span id="page-info" class="mx-2"></span>
        <button id="next-page" class="bg-pink-600 text-white px-2 py-1 rounded" type="button">></button>
    </div>
</div>

    <!-- MODAL ADD CARGO -->
<dialog id="my_modal_4" class="modal">
  <div class="modal-box w-11/12 max-w-5xl bg-pink-300">
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
      </form>
    <h3 class="font-bold text-lg">Nouvelle Cargaison</h3>

    <form action="addCargaison" id="add-cargo" class="text-black">
        <input type="hidden" name="globalState" value="OPEN" >
        <input type="hidden" name="progressionState" value="EN ATTENTE">
        <input type="hidden" name="totalAmount" value="0">
          <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
            <span class="w-36">Type:</span>
            <!-- <input type="text" class="grow" placeholder="Email" /> -->
            <select class="grow py-2 pl-1 outline-none bg-white text-black px-2 py-1 rounded hover:white" id="cargo-type" name="type">
                <option value="0">Choisir un type de cargaison</option>
                <option value="AIR">Aérienne</option>
                <option value="MARITIME">Maritime</option>
                <option value="ROAD">Routière</option>
            </select>
          </label>
          <div class="pl-2.5 text-red-600 hidden" id="err-cargo-type">error</div>
          <div class="flex justify-between">
            <div class="flex flex-col">
                <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-5">
                    <span class="">Date de départ:&nbsp;&nbsp;</span>
                    <input type="date" name="leavingDate" id="leavingDate" class="w-80 outline-none border border-gray-300 rounded-lg py-1 pl-1 bg-gray-200">
                </label>
                <div class="pl-2.5 text-red-600 hidden" id="err-leaving-date">error</div>
            </div>
            <div class="flex flex-col ">
                <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
                    <span>Date d'arrivée:&nbsp;&nbsp;</span>
                    <input type="date" name="arrivedDate" id="arrivedDate" class="w-80 border outline-none border-gray-300 rounded-lg py-1 pl-1 bg-gray-200">
                </label>
                <div class="pl-2.5 text-red-600 hidden" id="err-arrived-date">error</div>
            </div>
          </div>
          <div class="mt-5 flex flex-row gap-2 " >
            <div class="flex items-center gap-2 ">
                <input type="radio" name="radio-2" id="byWeight" class="radio radio-primary" checked /><label for="">Remplissage par poids</label>
            </div>
            <div class="flex items-center gap-2">
                <input type="radio" name="radio-2" id="byProduct" class="radio radio-primary"/>Remplissage par nombre de produit/colis
            </div>
          </div>
          <div class="pl-2.5 text-red-600 hidden mt-2" id="radio-choice">error</div>
          <div id="quantity"></div>
          <div class="mt-5">
            <div id="map" style="width: 100%; height: 265px;"></div>
          </div>
          <div class="flex gap-2 justify-between mt-4">
            <div class="flex flex-col">
                <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
                    <span class="">Départ:&nbsp;</span>
                    <input type="texte" name="departurePoint" id="departurePoint" class="grow outline-none border border-gray-300 rounded-lg py-1 pl-1 bg-gray-200" readonly>
                </label>
                <div class="pl-2.5 text-red-600 hidden" id="err-departure-point">error</div>
            </div>
            <div class="flex flex-col">
                <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
                    <span class="">Arrivée:&nbsp;</span>
                    <input type="text" name="arrivalPoint" id="arrivalPoint" class="grow border outline-none border-gray-300 rounded-lg py-1 pl-1 bg-gray-200" readonly>
                </label>
                <div class="pl-2.5 text-red-600 hidden" id="err-arrival-point">error</div>
            </div>
            <div class="flex flex-col">
                <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
                    <span class="">Distance:&nbsp;</span>
                    <input type="text" name="distance" id="distance" class="grow border outline-none border-gray-300 rounded-lg py-1 pl-1 bg-gray-200" readonly>
                </label>
                <div class="pl-2.5 text-red-600 hidden" id="err-distance">error</div>
            </div>
          </div>
          <div class="flex justify-end gap-3 mt-4">
            <button type="button" class="btn btn-error text-white" onclick="document.getElementById('my_modal_4').close()">Annuler</button>
            <button class="btn btn-primary text-white">Ajouter</button>
          </div>
    </form>

  </div>
</dialog>


    <!-- MODAL ADD PRODUCT -->
<dialog id="my_modal_5" class="modal">
  <div class="modal-box w-11/12 max-w-5xl bg-pink-300">
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 product-close-top">✕</button>
      </form>
    <h3 class="font-bold text-lg">Ajout de produit à une Cargaison</h3>

    <form id="add-product" method="POST" class="text-black">
        <input type="hidden" name="action" value="addProduct">
        <input type="hidden" name="state" value="PENDING">
          <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
            <span class="w-36">Type:</span>
            <!-- <input type="text" class="grow" placeholder="Email" /> -->
            <select class="grow py-2 pl-1 outline-none rounded-lg bg-white text-black px-2 py-1 rounded hover:white" id="product-type" name="type">
                <option value="0">Choisir un type de produit</option>
                <option value="CHIMICAL">Chimique</option>
                <option value="MATERIAL">Matériel</option>
                <option value="ALIMENTARY">Alimentaire</option>
            </select>
          </label>
          <div class="pl-2.5 text-red-600 hidden" id="err-cargo-type">error</div>
          <div id="chimical-toxicity"></div>
          <div id="product-weight"></div>
          <div id="material"></div>


        <fieldset class="border p-4 rounded mt-3">
            <legend>Infos de l'expéditeur</legend>
            <div class="relative">
                <input class="h-12 w-[530px] rounded-full outline-none pl-8 border border-gray-300 bg-gray-200" type="text" id="search-sender" placeholder="Rechercher l'expédideur par son numéro de téléphone">
                <div class="absolute top-3 left-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
            </div>
            <div id="sender-info" class="mt-2"></div>
        </fieldset>

        <fieldset class="border p-4 rounded mt-3">
            <legend>Infos du destinataire</legend>
            <div class="relative">
                <input class="h-12 w-[530px] rounded-full outline-none pl-8 border border-gray-300 bg-gray-200" type="text" id="search-receiver" placeholder="Rechercher le destinataire par son numéro de téléphone">
                <div class="absolute top-3 left-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
            </div>
            <div id="receiver-info"></div>
        </fieldset>

          <!-- <div class="flex gap-2 justify-between mt-4">
            <div class="flex flex-col">
                <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
                    <span class="">Départ:&nbsp;</span>
                    <input type="texte" name="departurePoint" id="departurePoint" class="grow outline-none border border-gray-300 rounded-lg py-1 pl-1 bg-gray-200" readonly>
                </label>
                <div class="pl-2.5 text-red-600 hidden" id="err-departure-point">error</div>
            </div>
            <div class="flex flex-col">
                <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
                    <span class="">Arrivée:&nbsp;</span>
                    <input type="text" name="arrivalPoint" id="arrivalPoint" class="grow border outline-none border-gray-300 rounded-lg py-1 pl-1 bg-gray-200" readonly>
                </label>
                <div class="pl-2.5 text-red-600 hidden" id="err-arrival-point">error</div>
            </div>
            <div class="flex flex-col">
                <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
                    <span class="">Distance:&nbsp;</span>
                    <input type="text" name="distance" id="distance" class="grow border outline-none border-gray-300 rounded-lg py-1 pl-1 bg-gray-200" readonly>
                </label>
                <div class="pl-2.5 text-red-600 hidden" id="err-distance">error</div>
            </div>
          </div> -->
          <label class="border border-gray-300 rounded-xl flex items-center p-2.5 mt-4">
                <span class="">Prix total:&nbsp;&nbsp;</span>
                <input type="text" name="distance" id="total-price-product" class="grow border outline-none border-gray-300 rounded-lg py-1 pl-2 bg-gray-200" value="0" readonly>
            </label>
            <div class="pl-2.5 text-red-600 hidden" id="err-distance">error</div>

          <div class="flex justify-end gap-3 mt-4">
            <button type="button" class="btn btn-error text-white " onclick="document.getElementById('my_modal_5').close()">Annuler</button>
            <button class="btn btn-primary text-white bg-pink-600 ">Ajouter</button>
          </div>
    </form>

  </div>
</dialog>
<!-- Modal for displaying cargo details -->
<div id="detailsModal" class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center" style="display:none;">
  <div class="bg-white p-6 rounded shadow-md w-2/3 h-3/4 overflow-auto">
    <h2 class="text-2xl font-bold mb-4">Détails de la Cargaison</h2>
    <div id="cargoDetails">
        </div>
    <table class="table">
        <thead class="bg-pink-300 text-black">
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

    <button type="button" class="btn btn-error text-white " onclick="closeModal()">Fermer</button>
    
  </div>
</div>

<script>
function closeModal() {
  document.getElementById('detailsModal').style.display = 'none';
}

// Fonction pour afficher le modal (si besoin)
function openModal() {
  document.getElementById('detailsModal').style.display = 'flex';
}
</script>

<script type="module" src="./dist/cargo-impl.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script type="module" src="./dist/map.js"></script>