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
        <span class="breadcrumb-item active">Page Approvisionnement</span>
    </nav>
    <!-- Results -->
    <div class="p-10 bg-white push">
        <ul class="nav nav-pills" data-toggle="tabs" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" href="#approvisionnement"> Approvisionnement</a>
            </li>

        </ul>
    </div>
    <div class="block-content block-content-full tab-content overflow-hidden">

        <!-- approvisionnement -->
        <div class="tab-pane fade show active" id="approvisionnement" role="tabpanel">
            <div class="row">
                <div class="col-xl-6">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> Approvisionnement </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableApprovisionnement" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Identifiant</th>
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
                            <h3 class="block-title text-center"> Nouvel approvisionnement</h3>
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
                                                <th>Produits</th>
                                                <th>Quantité</th>
                                            </tr>
                                        </thead>
                                        <tbody class="approvisionnements">

                                        </tbody>
                                    </table>
                                </div>
                                <form id="formApprovisionnement" class="js-validation-material3">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="idApprovisionnement" id="idApprovisionnement">
                                    <div class="form-group row">

                                        <div class="col-sm-4">
                                            <div class="form-material">
                                                <select class="js-select2 form-control" id="produitApprovisionnement" name="produitApprovisionnement" style="width: 100%;" data-placeholder="faites votre choix">
                                                    <option></option>
                                                    @foreach($produits as $produit)
                                                        @foreach($produit -> calibre as $prod)
                                                            <option data-ide="{{$prod -> id}}" value="{{$produit -> id}}"> {{$produit -> designationProduit}} {{$prod -> calibre}} </option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                                <label for="produitApprovisionnement">Produit concernée</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-material">
                                                <input class="form-control" type="number" min="1" id="qunatiteApprovisionnement" name="qunatiteApprovisionnement" placeholder="Entrez la quantite concernée par le rebut">
                                                <label for="qunatiteApprovisionnement">Quantite </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-20">
                                            <button type="button" class="add-row btn btn-alt-info mr-5 mb-5">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button type="button" class="del-row btn btn-alt-danger mr-5 mb-5">
                                                <i class="fa fa-close"></i>
                                            </button>


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
        <!-- END approvisionnement -->


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
<script src="js/lib/Approvisionnements.js"></script>

@endsection

<script type="text/javascript">
var urlGetApprovisionnement = '{{route('getApprovisionnement')}}';


</script>

@endsection
