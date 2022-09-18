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
        <span class="breadcrumb-item active">Page Clientèle</span>
    </nav>
    <!-- Results -->
    <div class="p-10 bg-white push">
        <ul class="nav nav-pills" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#client">Client</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#versement">Versement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#remises">Historique</a>
            </li>
        </ul>
    </div>
    <div class="block-content block-content-full tab-content overflow-hidden">
        <!-- clients -->
        <div class="tab-pane fade show active" id="client" role="tabpanel">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> Liste des clients </h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableClient" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Client</th>
                                        <th>Solde</th>
                                        <th>Contact</th>
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
                            <h3 class="block-title text-center"> Nouveau client</h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="js-validation-material1" id="formClient">
                                {!! csrf_field() !!}
                                <input type="hidden" name="idClient" id="idClient">
                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="nomClient" name="nomClient" placeholder="Entrez le nom du client">
                                        <label for="nomClient">Nom & Prénom client</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-material">
                                        <input type="text" class="form-control" id="telephoneClient" name="telephoneClient" data-height="34px">
                                        <label for="telephoneClient">Téléphone client</label>
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

        <!-- Versemenv Versement -->
        <div class="tab-pane fade show " id="versement" role="tabpanel">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title">Les Versements</h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableVersement" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>date</th>
                                        <th>Client</th>
                                        <th class="d-none d-sm-table-cell">somme Versee</th>
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
                            <h3 class="block-title text-center"> Nouveau Versement </h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="js-validation-material2" id="formVersement">
                                {!! csrf_field() !!}
                                <input type="hidden" name="idVersement" id="idVersement" value="">
                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="clientVersement" name="clientVersement" disabled>
                                        <label for="clientVersement">Client</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="integer" id="soldeClient" name="soldeClient" disabled>
                                        <label for="soldeClient">Solde client</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-material">
                                        <input class="form-control" type="integer" id="sommeVersee" name="sommeVersee" placeholder="Entrez le nom de la famille de produit">
                                        <label for="sommeVersee">Somme versée</label>
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

        <!-- remises produits -->
        <div class="tab-pane fade show " id="remises" role="tabpanel">
            <div class="row">
                
                <div class="col-xl-8">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title">Historique <span id="cli"> nom</span></h3>
                            <div class="block-options">

                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableHistorique" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th>date</th>
                                        <th class="d-none d-sm-table-cell">somme Versee</th>
                                        </tr>
                                </thead>
                            </table>
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
<script>jQuery(function(){ Codebase.helpers(['select2','tags-inputs']); });</script>
<script src="js/lib/Clients.js"></script>

@endsection

<script type="text/javascript">
var urlGetClient = '{{route('getClient')}}';
var urlGetVersement = '{{route('getVersement')}}';
var urlGetHistorique = '{{route('getHistorique')}}';
    

</script>

@endsection
