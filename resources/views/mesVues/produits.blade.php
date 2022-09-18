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
        <span class="breadcrumb-item active">Page Produits</span>
    </nav>
    <!-- Results -->
    <div class="p-10 bg-white push">
        <ul class="nav nav-pills" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#produits">Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#fournisseurs">Fournisseurs</a>
            </li>
            
        </ul>
    </div>
    <div class="block-content block-content-full tab-content overflow-hidden">
        <!-- produits -->
        <div class="tab-pane fade show active" id="produits" role="tabpanel">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title">Liste des produits</h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableProduits" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Produit</th>
                                        <th>Calibre</th>
                                        <th class="text-center" style="width: 15%;">option</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block block-themed my-block">
                        <div class="block-header">
                            <h3 class="block-title text-center"> Nouveau produit</h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="js-validation-material1" id="formProduit">
                                {!! csrf_field() !!}
                                <input type="text" name="idProduit" id="idProduit">
                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="designationProduit" name="designationProduit" placeholder="Entrez la designation du produit">
                                        <label for="designationProduit">Désignation produit</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-material">
                                        <select class="js-select2 form-control" id="conditionnementProduit" name="conditionnementProduit" style="width: 100%;" data-placeholder="Faites votre choix">
                                            <option></option>
                                            <option value="1">En carton</option>
                                            <option value="2">Par sac</option>
                                        </select>

                                        <label for="conditionnementProduit">Conditionnement du produit </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-material">
                                        <input type="text" class="js-tags-input form-control" id="calibreProduit" name="calibreProduit" data-height="34px">
                                        <label for="calibreProduit">Calibre du produit</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-material">

                                        <textarea class="form-control" id="caracteristiqueProduit" name="caracteristiqueProduit" placeholder="Caracteristique d'Produit" rows="2"></textarea>
                                        <label for="caracteristiqueProduit">Caractéristique produits </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-alt-primary">Enregistrer</button>
                                    <button type="reset" class="btn btn-alt-danger btnAnnuler">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END produits -->

        <!-- fournisseurs produiits -->
        <div class="tab-pane fade show " id="fournisseurs" role="tabpanel">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title">Les fournisseurs</h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableFournisseur" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Fournisseur</th>
                                        <th>Contact</th>
                                        <th class="d-none d-sm-table-cell">Produit Fourni(s)</th>
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
                            <h3 class="block-title text-center"> Nouveau fournisseur </h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="js-validation-material2" id="formFournisseur">
                                {!! csrf_field() !!}
                                <input type="text" name="idFournisseur" id="idFournisseur" value="">
                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="designationFournisseur" name="designationFournisseur" placeholder="Entrez la désignation du fournisseur">
                                        <label for="designationFournisseur">Designation fournisseur </label>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="contactFournisseur" name="contactFournisseur" placeholder="Entrez le contact du  fournisseur">
                                        <label for="contactFournisseur">Contact fournisseur </label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="form-material">
                                        <select class="js-select2 form-control" multiple id="produitFournisseur" name="produitFournisseur[]" style="width: 100%;" data-placeholder="Faites votre choix">
                                            @foreach($produits as $val)
                                                <option></option>
                                                <option value="{{$val -> id}}"> {{$val -> designationProduit}}</option>
                                              @endforeach
                                        </select>

                                        <label for="produitFournisseur">Produit fourni(s) </label>
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
        <!-- END fournisseurs produiits -->

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
<script src="js/lib/Produits.js"></script>

@endsection
<script type="text/javascript">
    var urlGetProduits = '{{route('getProduit')}}';
    var urlGetFournisseur = '{{route('getFournisseur')}}';

</script>

@endsection
