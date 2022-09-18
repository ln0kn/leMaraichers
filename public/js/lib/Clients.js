$(function () {

    ////////////////////////////////////////////
    // envoie du formulaire client
    $('#formClient').submit(function (e) {
        e.preventDefault();

        if ($('#idClient').val() > 0)
            validateForm('formClient', 'updateClient', 'PUT')
        else
            validateForm('formClient', 'addClient', 'POST')

        //        rechargera le datatable
        Client_table.ajax.reload()
    })

    // envoie du formulaire fournisseur
    $('#formVersement').submit(function (e) {
        e.preventDefault();

        if ($('#idVersement').val() > 0)
            validateForm('formVersement', 'addVersement', 'POST')

        //        rechargera le datatable
        Versement_table.ajax.reload()
        Client_table.ajax.reload()
    })
    /////////////////////////////////////////////fin envoie formulaire
    //////////////////////////////////////////////////////////////////



    /////////////////////////////////     Datatable     //////////////////////////////////
    ///////////////////////////////////////////////////////////////
    ///////////////////datatable client 

    var Client_table = $('#datatableClient').DataTable({
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
            "url": urlGetClient,
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
                            "<a href='#' class='dropdown-item versement'>VERSEMENT</a>" +
                            "<a href='#' class='dropdown-item historique'>HISTORIQUE</a>" +
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
                "data": "nomClient"
    },
            {
                "data": "solde"
    }, {
                "data": "telephoneClient"
    },
            {
                "data": ""
    }
  ],
    });

    ///////////////////////fin datatable client


    ///////datatable versement

    var Versement_table = $('#datatableVersement').DataTable({
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
            "url": urlGetVersement,
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
                            "<a href='#' class='dropdown-item versement'>VERSEMENT</a>" +
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
                "data": "created_at"
    }, {
                "data": "client.nomClient"
    },
            {
                "data": "sommeVersee"
    },
            {
                "data": ""
    }
  ],
    });

    //////fin versement datatable
    ////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////



    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////datatable button action

    //click sur le boutton modifier client
    $('#datatableClient tbody ').on('click', '.modifier', function () {
        //obtenir les donnees de la ligne cliquée
        var data = Client_table.row($(this).parents('tr')).data();
        $('#telephoneClient').val(data.telephoneClient);
        $('#nomClient').val(data.nomClient);
        $('#idClient').val(data.id)

    })
    //supprimer un clietn
    $('#datatableClient tbody ').on('click', '.supprimer', function () {
        var data = Client_table.row($(this).parents('tr')).data();
        $('#idClient').val(data.id)
        reqAjax('formClient', 'deleteClient', 'DELETE')
        Client_table.ajax.reload();
    })

    //versement client
    $('#datatableClient tbody ').on('click', '.versement', function () {
        var data = Client_table.row($(this).parents('tr')).data();
        $('#idVersement').val(data.id)
        $('#clientVersement').val(data.nomClient)
        $('#sommeVersée').val(data.solde)
        $('.nav a:eq(1)').tab('show');
    })


    //histprique client
    $('#datatableClient tbody ').on('click', '.historique', function () {
        var data = Client_table.row($(this).parents('tr')).data();
        $('#cli').html(data.nomClient);


        if ($.fn.DataTable.isDataTable("#datatableHistorique")) {
            $('#datatableHistorique').DataTable().clear().destroy();
        }

        var Historique_table = $('#datatableHistorique').DataTable({
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
                "url": urlGetHistorique,
                "dataSrc": "",
                "data": function (d) {
                    d.data = data.id
                }
            },

            "columns": [{
                    "data": "created_at"
            },
                {
                    "data": "sommeVersee"
            },
          ]
        });


        $('.nav a:eq(2)').tab('show');

    })
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Fin datatble button action








})
