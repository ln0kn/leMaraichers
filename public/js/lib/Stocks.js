$(function () {

    ////stock
    var Stock_table = $('#datatableStock').DataTable({
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
            "url": urlGetStock,
            "deferRender": true,
            "dataSrc": ""
        },
        "order": [
      [2, "desc"]
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

                     return " <button data-toggle='dropdown' class='btn btn-square btn-outline-primary'>Autres <i class='fa fa-caret-down fa-1x'></i> </button>" +
                            "<div class='dropdown-menu'>" +
                            "<a href='#' class='dropdown-item ajustement' >AJUSTEMENT</a>" +
                            "<a href='#' class='dropdown-item rebut'> REBUT </a>" +
                            "</div>";


                }
      },

    ],
        "columns": [{
                "data": "id"
    },
            {
                "data": "designation"
    },
            {
                "data": "quantite"
    },
            {
                "data": ""
    }
  ],
    });

    
    ////////ajustement datatable
    var Ajustement_table = $('#datatableAjustement').DataTable({
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
            "url": urlGetAjustement,
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
                "targets": 2,
                "data": null,
                "render": function (data, type, row, meta) {

                    return row.cal.produit.designationProduit +' '+row.cal.calibre;


                }
      },

    ],
        "columns": [{
                "data": "id"
    },
            {
                "data": "created_at"
    },
            {
                "data": ""
    },{
                "data": "qunatiteNumerique"
    },
            {
                "data": "quantitePhysique"
    },     
  ],
    });

    ////////ajustement datatable
    var Rebut_table = $('#datatableRebut').DataTable({
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
            "url": urlGetRebut,
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
                "targets": 2,
                "data": null,
                "render": function (data, type, row, meta) {

                    return row.cal.produit.designationProduit +' '+row.cal.calibre;


                }
      },

    ],
        "columns": [{
                "data": "id"
    },
            {
                "data": "created_at"
    },
            {
                "data": ""
    },{
                "data": "qunatite"
    },
           
  ],
    });

    
    
    //click sur le boutton modifier client
    $('#datatableStock tbody ').on('click', '.ajustement', function () {
        //obtenir les donnees de la ligne cliquée
        var data = Stock_table.row($(this).parents('tr')).data();
        console.log(data)
        $('#produitAjustement').val(data.designation);
        $('#quantiteNumerique').val(data.quantite);
        $('#idAjustement').val(data.id)
        $('.nav a:eq(4)').tab('show');
    })

    
    //click sur le boutton rebut
    $('#datatableStock tbody ').on('click', '.rebut', function () {
        //obtenir les donnees de la ligne cliquée
        var data = Stock_table.row($(this).parents('tr')).data();
        $('#produitRebut').val(data.designation);
        $('#idRebut').val(data.id)
        $('.nav a:eq(1)').tab('show');
    })

    //////////submit ajustement
    $('#formAjustement').submit(function(e){
        console.log(e)
        e.preventDefault();

        if ($('#idAjustement').val() > 0)
            validateForm('formAjustement', 'addAjustement', 'POST')
        Stock_table.ajax.reload()
        Ajustement_table.ajax.reload()
    })
    //////////////////////////
    
    //////////submit rebut
    $('#formRebut').submit(function(e){
        console.log(e)
        e.preventDefault();

        if ($('#idRebut').val() > 0)
            validateForm('formRebut', 'addRebut', 'POST')
        Stock_table.ajax.reload()
//        Rebut_table.ajax.reload()
    })
    //////////////////////////
    
})
