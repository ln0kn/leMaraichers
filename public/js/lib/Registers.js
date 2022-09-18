$(function () {

    $('#formUtilisateur').submit(function (e) {
        e.preventDefault();

        if ($('#idUtilisateur').val() > 0)
            reqAjax('formUtilisateur', 'updateUser', 'PUT')
        else
            reqAjax('formUtilisateur', urlRegister, 'POST')


                User_table.ajax.reload();

    })


    var User_table = $('#datatableUtilisateur').DataTable({
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
            "url": 'getUser',
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
                responsivePriority: 1,
                targets: 0
            },
            {
                responsivePriority: 2,
                targets: -1
            },
            {
                "targets": -1,
                "data": null,
                "render": function (data, type, row, meta) {
                    if (row.statut == 0)
                        return " <button data-toggle='dropdown' class='btn btn-square btn-outline-primary'>Autres <i class='fa fa-caret-down fa-1x'></i> </button>" +
                            "<div class='dropdown-menu'>" +
                            "<a href='#' class='dropdown-item modifier' >MODIFIER</a>" +
                            "<a href='#' class='dropdown-item toggle'>DÉSACTIVER</a>" +
                            "</div>";

                    else
                        return " <button class='btn btn-outline-success toggle'>ACTIVER </button>";

                }
      },
            {
                "targets": 1,
                "data": null,
                "render": function (data, type, row, meta) {
                    return row.nom + " " + row.prenom + " " + row.telephone;
                }
      },

            {
                "targets": 2,
                "data": null,
                "render": function (data, type, row, meta) {
                    switch (row.droit) {
                        case 1:
                            return "<span class='tx-12 badge badge-info'>Ajouter</span>";

                            break;
                        case 2:
                            return "<span class='tx-12 badge badge-warning'>Modifier</span>";
                            break;
                        case 3:
                            return "<span class='badge tx-12 badge badge-info'>Ajouter</span> <span class='tx-12 badge badge-warning'>Modifier</span> ";
                            break;
                        case 4:
                            return "<span class='tx-12 badge badge-danger'>Supprimer</span>";
                            break;
                        case 5:
                            return "<span class='tx-12 badge badge-info'>Ajouter</span>" +
                                "<span class='tx-12 badge badge-danger'>Supprimer</span>";
                            break;
                        case 6:
                            return "<span class='tx-12 badge badge-warning'>Modifier</span> <span class='tx-12 badge badge-danger'>Supprimer</span>";
                            break;
                        case 7:
                            return "<span class='badge tx-12 badge badge-info'>Ajouter</span> <span class='tx-12 badge badge-warning'>Modifier</span> <span class='tx-12 badge badge-danger'>Supprimer</span>";
                            break;


                    }
                }
      },
            {
                "targets": 3,
                "data": null,
                "render": function (data, type, row, meta) {
                    if (row.statut != 0)
                        return 'Désactivé';
                    else
                        return 'Activé';
                }
      }
    ],
        "columns": [{
                "data": "id"
      },
            {
                "data": ""
      },

            {
                "data": ""
      },
            {
                "data": ""
      },

            {
                "data": ""
      }
    ],
    });

    //dsactiver un utlisateur
    $('#datatableUtilisateur tbody ').on('click', '.toggle', function () {
        //obtenir les donnees de la ligne cliquée
        var data = User_table.row($(this).parents('tr')).data();
        $('#idUtilisateur').val(data.id)
        reqAjax('formUtilisateur', 'deleteUser', 'DELETE')
        User_table.ajax.reload();
    })


    //modifier un utlisateur
    $('#datatableUtilisateur tbody ').on('click', '.modifier', function () {
        //obtenir les donnees de la ligne cliquée
        $('#pageUtilisateur').val(null).trigger('change')
        var tab = [];
        var data = User_table.row($(this).parents('tr')).data();
        var page = data['pageUtilisateur'].split(',');
        console.log(page)
        $('#idUtilisateur').val(data.id)

        $.each(page, function (key, value) {
            if (value > 0)
                tab[key] = value
        })
        $.each(page, function (key, value) {
            if (value > 0)
                tab[key] = value
        })
        $('#pageUtilisateur').val(tab).trigger('change')
        $('#nom').val(data['nom'])
        $('#prenomUtilisateur').val(data['prenom'])
        $('#nomUtilisateur').val(data['username'])
        $('#telephoneUtilisateur').val(data['telephone'])
        
        switch (data.droit) {
      case 1:
        $('#droitUtilisateur').val(1).trigger('change')
        break;

      case 2:
        $('#droitUtilisateur').val(2).trigger('change')
        break;

      case 3:
        $('#droitUtilisateur').val([1,2]).trigger('change')
        break;

      case 4:
        $('#droitUtilisateur').val([4]).trigger('change')
        break;

      case 5:
        $('#droitUtilisateur').val([1,4]).trigger('change')
        break;

      case 6:
        $('#droitUtilisateur').val([2,4]).trigger('change')
        break;

      case 7:
        $('#droitUtilisateur').val([1,2,4]).trigger('change')
        break;
      }


    })





})
