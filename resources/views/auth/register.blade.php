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
        <span class="breadcrumb-item active">Page Parametre</span>
    </nav>
    <!-- Results -->
    <div class="p-10 bg-white push">
        <ul class="nav nav-pills" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#personnel">Utilisateur</a>
            </li>
        </ul>
    </div>
    <div class="block-content block-content-full tab-content overflow-hidden">
        <!-- utilisateur -->
        <div class="tab-pane fade show active" id="personnel" role="tabpanel">
            <div class="row">
                <div class="col-xl-6">
                    <div class="block block-themed">
                        <div class="block-header ">
                            <h3 class="block-title"> Liste du utilisateur </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <table id="datatableUtilisateur" class=" table table-bordered table-striped table-vcenter ">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th> Utilisateur </th>
                                        <th> droit </th>
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
                            <h3 class="block-title text-center"> Nouvel utilisateur </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form class="js-validation-material1" id="formUtilisateur">
                                {!! csrf_field() !!}
                                <input type="text" name="idUtilisateur" id="idUtilisateur">

                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom ">
                                            <label for="nom">Nom </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input type="text" class="form-control" id="prenomUtilisateur" name="prenomUtilisateur" placeholder="Entrez le prénom de l'utilisateur">
                                            <label for="prenomUtilisateur">Prénom</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input type="text" class="form-control" id="nomUtilisateur" name="nomUtilisateur" placeholder="Entrez le nom d'utilisateur">
                                            <label for="nomUtilisateur">Nom utilisateur</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input type="number" class="form-control" id="telephoneUtilisateur" name="telephoneUtilisateur" placeholder="Entrez le telephone de l'utilisateur">
                                            <label for="telephoneUtilisateur">Téléphone Utilisateur</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <select class="js-select2 form-control" id="pageUtilisateur" name="pageUtilisateur[]" style="width: 100%;" data-placeholder="Faites votre choix" multiple>
                                                <option>  </option>
                                                <option value="1">Produit</option>
                                                <option value="2">client</option>
                                                <option value="4">stock</option>
                                                <option value="8">parametre</option>
                                                <option value="16">Autre</option>
                                                <option value="32">approvisionnement</option>
                                                <option value="64">vente</option>
                                            </select>
                                            <label for="pageUtilisateur">Page utilisateur</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <select class="js-select2 form-control" id="droitUtilisateur" name="droitUtilisateur[]" style="width: 100%;" data-placeholder="Faites votre choix" multiple>
                                                <option> </option>
                                                <option value="1">Ajouter</option>
                                                <option value="2">Modifier</option>
                                                <option value="4">Supprimer</option>
                                            </select>
                                            <label for="droitUtilisateur">Droit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input type="password" class="form-control" id="motDePasse" name="motDePasse" placeholder="Entrez le mot de passe">
                                            <label for="motDePasse">Mot de passe</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-material">
                                            <input type="password" class="form-control" id="motDePasse_confirmation" name="motDePasse_confirmation" placeholder="Retaper le mot de passe">
                                            <label for="motDePasse_confirmation">Mot de passe confirmation</label>
                                        </div>
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
        <!-- END utilisateur -->


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
<script src="js/lib/Registers.js"></script>

@endsection

<script type="text/javascript">
var urlRegister = '{{ route('register')}}';


</script>

@endsection
