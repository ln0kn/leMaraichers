@extends('layouts.main')

@section('style')
<link rel="stylesheet" href="js/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="js/plugins/jquery-tags-input/jquery.tagsinput.min.css">
@endsection

@section('content')

<!-- Page Content -->
<div class="content">
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="javascript:void(0)">GESTION</a>
        <span class="breadcrumb-item active">Page Stock</span>
    </nav>
    <!-- Results -->
    <div class="p-10 bg-white push">
        <ul class="nav nav-pills" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#stock">Stock</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#rebut">Rebut </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#retour"> Retour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#reconditionnement">Reconditionnement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#ajustement">Ajustement</a>
            </li>
        </ul>
    </div>
    <div class="block-content block-content-full tab-content overflow-hidden">
        <!-- clients -->
        <div class="tab-pane fade show active" id="stock" role="tabpanel">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> État du stock </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableStock" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th> Produits </th>
                                        <th> Quantité (conditionnement)</th>
                                        <th class="text-center" style="width: 15%;">option</th>
                                    </tr>
                                </thead>
                                

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END produits -->

        <!-- Rebut-->
        <div class="tab-pane fade show " id="rebut" role="tabpanel">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> Rebut </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableRebut" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>date</th>
                                        <th>produit</th>
                                        <th>Quantité</th>
                                        
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block block-themed my-block">
                        <div class="block-header">
                            <h3 class="block-title text-center"> Nouveau rebut </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="js-validation-material2" id="formRebut">
                                {!! csrf_field() !!}
                                <input type="text" name="idRebut" id="idRebut">


                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" id="produitRebut" name="produitRebut" disabled>
                                            
                                        <label for="produitRebut">Produit concernée</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="quantiteRebut" name="quantiteRebut" placeholder="Entrez la quantite concernée par le rebut">
                                        <label for="quantiteRebut">Quantite concernée</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary">Enregistrer</button>
                                    <button class="btn btn-alt-danger" onclick="cleanForm('formFamilleProduits')">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Versemenv produiits -->

        <!-- RebutRetourd -->
        <div class="tab-pane fade show " id="retour" role="tabpanel">
            <div class="row">
                <div class="col-xl-6">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> Retour </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableFamilleProduits" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Client(vente)</th>
                                        <th>Opération</th>
                                        <th>Quantité</th>
                                        <th class="d-none d-sm-table-cell">Statut</th>
                                        <th class="text-center" style="width: 15%;">option</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="block block-themed my-block">
                        <div class="block-header">
                            <h3 class="block-title text-center"> Nouveau retour </h3>
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
                                                <th>Four.</th>
                                                <th>Prod.</th>
                                                <th>Cdt</th>
                                                <th>Qte</th>
                                                <th>P.U.</th>
                                                <th>P.T.</th>
                                            </tr>
                                        </thead>
                                        <tbody class="approvissionnements">

                                        </tbody>
                                    </table>
                                </div>
                                <form id="formRetourd" >
<!--                                <form id="formRetourd" class="js-validation-material3">-->
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="idRetourd" id="idRetourd">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="ventreRetourd" name="ventreRetourd" style="width: 100%;" data-placeholder="faites votre choix">
                                                    <option></option>
                                                </select>
                                                <label for="ventreRetourd">Vente concernée</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="produitRetournee" name="produitRetournee" style="width: 100%;" data-placeholder="faites votre choix">
                                                    <option></option>
                                                </select>
                                                <label for="produitRetournee">Produit concernée</label>
                                            </div>
                                            </div>
                                            <div class="col-sm-4">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="qunatiteRetourd" name="qunatiteRetourd" placeholder="Entrez la quantite concernée par le rebut">
                                        <label for="qunatiteRetourd">Quantite retournée</label>
                                            </div>
                                        </div>
                                    </div>
                                   
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
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-alt-primary">Enregistrer</button>
                                        <button onclick="cleanForm('formApprovissionnements')" class="btn btn-alt-danger btnAnnuler">Annuler</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Versemenv produiits -->

        <!-- remises produits -->
        <div class="tab-pane fade show " id="reconditionnement" role="tabpanel">
            <div class="row">
                <div class="col-xl-6">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> Reconditionnement éffectué </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableMarqueProduits" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Nom</th>
                                        <th class="d-none d-sm-table-cell">Statut</th>
                                        <th class="text-center" style="width: 15%;">option</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="block block-themed my-block">
                        <div class="block-header">
                            <h3 class="block-title text-center"> nom Client Historique</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END remises produits -->


        <!-- remises produits -->
        <div class="tab-pane fade show " id="ajustement" role="tabpanel">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title">Ajustements éffectués</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableAjustement" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>date</th>
                                        <th>produit</th>
                                        <th>Ancien stock</th>
                                        <th>nouveau stock</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block block-themed my-block">
                        <div class="block-header">
                            <h3 class="block-title text-center"> Nouvel ajustement </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="js-validation-material3" id="formAjustement">
                                {!! csrf_field() !!}
                                <input type="hidden" name="idAjustement" id="idAjustement">
                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" id="produitAjustement" name="produitAjustement" disabled >
                                        <label for="produitAjustement">Produit concerné</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="quantiteNumerique" name="quantiteNumerique" disabled>
                                        <label for="quantiteNumerique">Quantite numérique</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="number" id="quantitePhysique" name="quantitePhysique" placeholder="Entrez la quantite Physique par l operation" min="1">
                                        <label for="quantitePhysique">Quantite physique</label>
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
        <!-- END remises produits -->



    </div>
    <!-- END  -->
</div>
<!-- END Page Content -->

@section('script')
<script src="js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script src="js/plugins/select2/js/select2.full.min.js"></script>
<script>
    jQuery(function() {
        Codebase.helpers(['select2', 'tags-inputs']);
    });

</script>
<script src="js/lib/Stocks.js"></script>

@endsection

<script type="text/javascript">
var urlGetStock = '{{route('getStock')}}';
var urlGetAjustement = '{{route('getAjustement')}}';
var urlGetRebut = '{{route('getRebut')}}';

</script>

@endsection
