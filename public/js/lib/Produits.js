$(function () {
    ////////////////////////////////////////////
    // envoie du formulaire produti
    $('#formProduit').submit(function (e) {
        e.preventDefault();

        if ($('#idProduit').val() > 0)
            validateForm('formProduit', 'updateProduit', 'PUT')
        else
            validateForm('formProduit', 'addProduit', 'POST')

        //        rechargera le datatable
        Produit_table.ajax.reload()
    })

    // envoie du formulaire fournisseur
    $('#formFournisseur').submit(function (e) {
        e.preventDefault();

        if ($('#idFournisseur').val() > 0)
            validateForm('formFournisseur', 'updateFournisseur', 'PUT')
        else
            validateForm('formFournisseur', 'addFournisseur', 'POST')

        //        rechargera le datatable
        Fournisseur_table.ajax.reload()
    })


    /////////////////////////////////////////////fin envoie formulaire

    //////////////////////////////////database initialisation

    var Produit_table = $('#datatableProduits').DataTable({
        responsive: true,
        bLengthChange: false,
        searching: false,
        autoWidth: !1,
        language: {
            searchPlaceholder: 'Chercher...',
            sSearch: '',
            lengthMenu: '_MENU_ lignes/page',
            oPaginate: {
                "sFirst": "Premier",
                "sLast": "Dernier",
                "sNext": "Suivant",
                "sPrevious": "Précédent"
            },
            sZeroRecords: "Aucun résultat trouvé",
            sEmptyTable: "Aucune donnée disponible",
            sInfo: "Lignes _START_ à _END_ sur _TOTAL_",
        },

        "ajax": {
            "url": urlGetProduits,
            "deferRender": true,
            "dataSrc": ""
        },
        "order": [
      [0, "desc"]
    ],
        "columnDefs": [
      //cache la colonne des id
            {
                "targets": 0,
                "visible": false
      },
            {
                "targets": -1,
                "data": null,
                "render": function (data, type, row, meta) {
                    if (row.deleted_at == null)
                        return " <button data-toggle='dropdown' class='btn btn-square btn-outline-primary'>Autres <i class='fa fa-caret-down fa-1x'></i> </button>" +
                            "<div class='dropdown-menu'>" +
                            "<a href='#' class='dropdown-item modifier' >MODIFIER</a>" +
                            "<a href='#' class='dropdown-item supprimer'>SUPPRIMER</a>" +
                            "</div>";

                    else
                        return " <button class='btn btn-outline-success toggle'>ACTIVER </button>";

                }
      },
//            {
//                "targets": 2,
//                "data": null,
//                "render": function (data, type, row, meta) {
//                    return row.calibre;
//                }
//      }
    ],
        "columns": [{
                "data": "id"
    },
            {
                "data": "designationProduit"
    },
            {
                "data": "cal"
    },
            {
                "data": ""
    }
  ],
    });

    var Fournisseur_table = $('#datatableFournisseur').DataTable({
        responsive: true,
        bLengthChange: false,
        searching: false,
        autoWidth: !1,
        language: {
            searchPlaceholder: 'Chercher...',
            sSearch: '',
            lengthMenu: '_MENU_ lignes/page',
            oPaginate: {
                "sFirst": "Premier",
                "sLast": "Dernier",
                "sNext": "Suivant",
                "sPrevious": "Précédent"
            },
            sZeroRecords: "Aucun résultat trouvé",
            sEmptyTable: "Aucune donnée disponible",
            sInfo: "Lignes _START_ à _END_ sur _TOTAL_",
        },

        "ajax": {
            "url": urlGetFournisseur,
            "deferRender": true,
            "dataSrc": ""
        },
        "order": [
      [0, "desc"]
    ],
        "columnDefs": [
      //cache la colonne des id
            {
                "targets": 0,
                "visible": false
      },
            {
                "targets": -1,
                "data": null,
                "render": function (data, type, row, meta) {
                    if (row.deleted_at == null)
                        return " <button data-toggle='dropdown' class='btn btn-square btn-outline-primary'>Autres <i class='fa fa-caret-down fa-1x'></i> </button>" +
                            "<div class='dropdown-menu'>" +
                            "<a href='#' class='dropdown-item modifier' >MODIFIER</a>" +
                            "<a href='#' class='dropdown-item supprimer'>SUPPRIMER</a>" +
                            "</div>";

                    else
                        return " <button class='btn btn-outline-success toggle'>ACTIVER </button>";

                }
      },
    ],
        "columns": [{
                "data": "id"
    },
            {
                "data": "designationFournisseur"
    },
            {
                "data": "contactFournisseur"
    },
            {
                "data": "prod"
    },
            {
                "data": ""
    }
  ],
    });

    /////////////////////////////////////////////////////////


    ////////////////////////datatable boutton action 
    //click sur le boutton modifier d produit
    $('#datatableProduits tbody ').on('click', '.modifier', function () {
        $('#conditionnementProduit').val(null).trigger('change');
        //obtenir les donnees de la ligne cliquée
        var data = Produit_table.row($(this).parents('tr')).data();
        $('#caracteritiqueProduit').html('data.caracteristiqueProduits');
        $('#conditionnementProduit').val(data.conditionnementProduit).trigger('change');
        $('#designationProduit').val(data.designationProduit);
        $('#idProduit').val(data.id)
      $.each(data.calibre, function (key, value) {
          $('#calibreProduit').addTag(value['calibre']);
      });  
    })
    //supprimer un produit
    $('#datatableProduits tbody ').on('click', '.supprimer', function() {

      var data = Produit_table.row($(this).parents('tr')).data();
      $('#idProduit').val(data.id)
      reqAjax('formProduit', 'deleteProduit', 'DELETE')
      Produit_table.ajax.reload();
    })

    //////////////////////////////
    //supprimer un fournisseur
    $('#datatableFournisseur tbody ').on('click', '.supprimer', function() {

      var data =Fournisseur_table.row($(this).parents('tr')).data();
      $('#idFournisseur').val(data.id)
      reqAjax('formFournisseur', 'deleteFournisseur', 'DELETE')
      Fournisseur_table.ajax.reload();
    })
    //click sur le boutton modifier d produit
    $('#datatableFournisseur tbody ').on('click', '.modifier', function () {
        $('#produitFournisseur').val(null).trigger('change');
        var data = Fournisseur_table.row($(this).parents('tr')).data();
        console.log(data.designationFournisseur)
        $('#designationFournisseur').val(data.designationFournisseur);
        $('#contactFournisseur').val(data.contactFournisseur);
        $('#idFournisseur').val(data.id)
        var tab = []
      $.each(data.produits, function (key, value) {
          console.log(value)
          tab[key]=value['id']
          
      });  
        $('#produitFournisseur').val(tab).trigger('change');
    })

    
    ////////////////////////////////////////////////////////


})
