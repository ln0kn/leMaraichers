@extends('layouts.main')

@section('style')
<link rel="stylesheet" href="js/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
        
@endsection

@section('content')

<!-- Page Content -->
<div class="content">
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="javascript:void(0)">GESTION</a>
        <span class="breadcrumb-item active">Page Vente</span>
    </nav>
    <!-- Results -->
    <div class="p-10 bg-white push">
        <ul class="nav nav-pills" data-toggle="tabs" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" href="#vente"> Vente </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#cloture"> Cloture journée </a>
            </li>

        </ul>
    </div>
    <div class="block-content block-content-full tab-content overflow-hidden">

        <!-- Vente -->
        <div class="tab-pane fade show active" id="vente" role="tabpanel">
            <div class="row">
                <div class="col-xl-4">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> Liste des ventes </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableVentes" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Vente</th>
                                        
                                        <th class="text-center" style="width: 15%;">option</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="block block-themed my-block">
                        <div class="block-header">
                            <h3 class="block-title text-center"> Nouvelle vente </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">

                            <div class="tab-pane active" id="crypto-sell">
                                <div class="table-responsive">
                                    <table class="table table-striped table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Produit</th>
                                                <th>Quantite</th>
                                                <th>Prix U.</th>
                                                <th>Prix T.</th>

                                            </tr>
                                        </thead>
                                        <tbody class="ventes">

                                        </tbody>
                                    </table>
                                </div>
                                <form id="formVente" class="js-validation-material3">
                                    {!! csrf_field() !!}
                                    <input type="text" name="idVente" id="idVente">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="produitVente" name="produitVente" style="width: 100%;" data-placeholder="faites votre choix">
                                                    <option></option>
                                                    @foreach($produits as $produit)
                                                    @foreach($produit -> calibre as $prod)
                                                    <option data-ide="{{$prod -> id}}" value="{{$produit -> id}}"> {{$produit -> designationProduit}} {{$prod -> calibre}} </option>
                                                    @endforeach
                                                    @endforeach
                                                </select>
                                                <label for="produitVente">Produit</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-material">
                                                <input class="form-control" type="number" id="quantiteVente" name="quantiteVente" min="0" placeholder="Entrez la quantite concernée par le rebut">
                                                <label for="quantiteVente">Quantité</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-material">
                                                <input class="form-control" type="number" id="prixUnitaire" name="prixUnitaire" min="0" placeholder="Entrez la quantite concernée par le rebut">
                                                <label for="prixUnitaire">prix U. </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <button type="button" class="add-row btn btn-alt-info mr-5 mb-5">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button type="button" class="del-row btn btn-alt-danger mr-5 mb-5">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-sm-3">
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="clientVente" name="clientVente" style="width: 100%;" data-placeholder="faites votre choix">
                                                    <option></option>
                                                    @foreach($clients as $cli)
                                                        <option value="{{$cli -> id}}"> {{$cli -> nomClient}} </option>
                                                    @endforeach
                                                </select>
                                                <label for="clientVente">Choix client</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="saisieClient" name="saisieClient" placeholder="Entrez le nom prénom du client">
                                                <label for="saisieClient">nom prénom client </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-material">
                                                <input class="form-control" type="number" id="montantReduction" name="montantReduction" min="0" value="0">
                                                <label for="montantReduction">montant reduction </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-material">
                                                <input class="form-control" type="number" id="montantPayer" name="montantPayer" min="0">
                                                <label for="montantPayer"> montant payer </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!--
                                    <div class="form-group row">
                                        <div class="col-12 text-center">
                                            <div class="btn-group btn-group-sm my-5" role="group" aria-label="btnGroup1">
                                                <button type="button" class="btn btn-secondary addRow">Ajouter ligne</button>
                                                <button type="button" class="btn btn-secondary delRow">Supprimer ligne</button>
                                            </div>
                                            <div class="font-size-sm text-muted">
                                                <i class="fa fa-repeat"></i> <em>Actualiser</em>
                                            </div>
                                        </div>
                                    </div>
-->
                                    <div class="form-group ">
                                        <button type="submit" class="btn btn-alt-primary">Enregistrer</button>
                                        <button onclick="cleanForm('formApprovissionnements')" class="btn btn-alt-danger btnAnnuler">Annuler</button>
                                        <div class="float-right">
                                            <span id="sommeTotal">0</span> Fcfa
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Vente -->

        <!-- cloture -->
        <div class="tab-pane fade show " id="cloture" role="tabpanel">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> Cloture éffectuées</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableCloture" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">date</th>
                                        <th class="text-center" style="width: 15%;">option</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="block block-themed my-block">
                        <div class="block-header">
                            <h3 class="block-title text-center"> Nouvelle cloture </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="js-validation-material2" id="formCloture">
                                {!! csrf_field() !!}
                                <input type="hidden" name="idCloture" id="idCloture">


                                <div class="form-group">
                                    <div class="form-material">
                                        <input type="text" class="js-datepicker form-control" id="dateCloture" name="dateCloture" data-week-start="1" data-autoclose="true" data-today-highlight="true" data-date-format="dd-mm-yyyy" placeholder="dd/mm/yy">

                                        <label for="dateCloture">Date cloture</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary">Enregistrer</button>
                                    <button class="btn btn-alt-danger" onclick="cleanForm('')">Annuler</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END cloture -->


    </div>
    <!-- END  -->
</div>
<!-- END Page Content -->

@section('script')
<script src="js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="js/plugins/select2/js/select2.full.min.js"></script>
<script>
    jQuery(function() {
        Codebase.helpers(['select2', 'datepicker']);
    });

</script>
<script src="js/lib/Ventes.js"></script>

@endsection

<script type="text/javascript">
var urlGetVente = '{{route('getVente')}}';
var urlGetCloture = '{{route('getCloture')}}';


</script>

@endsection
