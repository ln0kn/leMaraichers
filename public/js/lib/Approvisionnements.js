$(function () {
    var ligne = 0;
    var Send = {};
    
    $('.add-row').click(function (e) {
        var labelProduit = document.getElementById('produitApprovisionnement')[document.getElementById('produitApprovisionnement').selectedIndex].innerHTML;
        var quantite = $('#qunatiteApprovisionnement').val();
        var markup = "<tr><td><input type='checkbox' name='record' id=" + ligne + "></td><td>" + labelProduit + "</td><td>" + quantite + "</td></tr>";

        if (labelProduit && quantite > 0) {
            $(".approvisionnements").append(markup);
            Send[ligne] = {
                'id': $('#idApprovisionnement').val(),
                'produit': $('#produitApprovisionnement').val(),
                'calibre': $("#produitApprovisionnement").select2("data")[0].element.dataset.ide,
                'quantite': $('#qunatiteApprovisionnement').val(),
            }
            console.log(Send);
            console.log($("#produitApprovisionnement").select2("data")[0].element.dataset.ide);
            $('#produitApprovisionnement').val(null).trigger('change');
            $('#qunatiteApprovisionnement').val(' ')
            ligne++;
        }
    })

    $('.del-row').click(function (e) {
        $(".approvisionnements").find('input[name="record"]').each(function () {
            if ($(this).is(":checked")) {
                $(this).parents("tr").remove();
                delete Send[this.id];
            }
        })
    })


    //envoyer le formulaire
    $('#formApprovisionnement').submit(function (e) {
        e.preventDefault();
        if (ligne > 0) {
            
            if ($('#idApprovisionnement').val() > 0){
                reqAjax('formApprovisionnement', 'updateApprovisionnement', 'PUT', Send)
            } 
            else
               reqAjax('formApprovisionnement', 'addApprovisionnement', 'POST', Send)

            Approvisionnement_table.ajax.reload();
            $(".approvisionnements").find('input[name="record"]').each(function () {
                $(this).parents("tr").remove();
                delete Send[this.id];
            })
        }
    })

    //////////////////////datatable

    var Approvisionnement_table = $('#datatableApprovisionnement').DataTable({
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
            "url": urlGetApprovisionnement,
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
                "data": "identifiant"
    },
            {
                "data": ""
    }
  ],
    });

    ////////////////////////////fin datatable

    ////////////////////////datatable boutton action 
    //click sur le boutton modifier approvisionnement
    $('#datatableApprovisionnement tbody ').on('click', '.modifier', function () {
        $(".approvisionnements").find('input[name="record"]').each(function () {
            $(this).parents("tr").remove();
            delete Send[this.id];
        })
        var data = Approvisionnement_table.row($(this).parents('tr')).data();
        
        $('#idApprovisionnement').val(data.id)
        $.each(data.produit, function (key, value) {
            ligne = key+1
            $('#produitApprovisionnement').val(value['produit_id']).trigger('change');
            var labelProduit = document.getElementById('produitApprovisionnement')[document.getElementById('produitApprovisionnement').selectedIndex].innerHTML;

            var markup = "<tr><td><input type='checkbox' name='record' id=" + key + "></td><td>" + labelProduit + "</td><td>" + value['quantite'] + "</td></tr>";

            $(".approvisionnements").append(markup);
            Send[key] = {
                'id': data.id,
                'produit': value['produit_id'],
                'calibre': $("#produitApprovisionnement").select2("data")[0].element.dataset.ide,
                'quantite': value['quantite'],
            }
            
            

        });

        $('#produitApprovisionnement').val(null).trigger('change');
        $('#qunatiteApprovisionnement').val(' ')
      })
    
    //supprimer un approvisionnement
    $('#datatableApprovisionnement tbody ').on('click', '.supprimer', function () {

        var data = Approvisionnement_table.row($(this).parents('tr')).data();
        $('#idApprovisionnement').val(data.id)
        reqAjax('formApprovisionnement', 'deleteApprovisionnement', 'DELETE')
        Approvisionnement_table.ajax.reload();
    })

    //////////////////////////////





})
