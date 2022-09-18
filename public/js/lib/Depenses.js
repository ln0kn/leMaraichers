$(function () {


    $('#formDepense').submit(function (e) {
        e.preventDefault();
        if ($('#idDepense').val() > 0) {
            reqAjax('formDepense', 'updateDepense', 'PUT')
        } else
            reqAjax('formDepense', 'addDepense', 'POST')



                    Depense_table.ajax.reload();


    })


    var Depense_table = $('#datatableDepense').DataTable({
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
            "url": urlGetDepense,
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
                    return " <button data-toggle='dropdown' class='btn btn-square btn-outline-primary'>Autres <i class='fa fa-caret-down fa-1x'></i> </button>" +
                        "<div class='dropdown-menu'>" +
                        "<a href='#' class='dropdown-item modifier' >MODIFIER</a>" +
                        "<a href='#' class='dropdown-item supprimer'>SUPPRIMER</a>" +
                        "</div>";
                }
      },
    ],
        "columns": [{
                "data": "id"
    },
            {
                "data": "designationDepense"
    }, {
                "data": "dateDepense"
    }, {
                "data": "montantDepense"
    },
            {
                "data": ""
    }
  ],
    });

    
    //click sur le boutton modifier d produit
    $('#datatableDepense tbody ').on('click', '.modifier', function () {
        //obtenir les donnees de la ligne cliquée
        var data = Depense_table.row($(this).parents('tr')).data();
        $('#designationDepense').val(data.designationDepense);
        $('#dateDepense').val(data.dateDepense);
        $('#montantDepense').val(data.montantDepense);
        $('#idDepense').val(data.id)
     
    })
    
    //click sur le boutton modifier d produit
    $('#datatableDepense tbody ').on('click', '.supprimer', function () {
        //obtenir les donnees de la ligne cliquée
        var data = Depense_table.row($(this).parents('tr')).data();
        $('#idDepense').val(data.id)
        reqAjax('formDepense', 'deleteDepense', 'DELETE')
        Depense_table.ajax.reload();
     
    })



})
