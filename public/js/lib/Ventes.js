$(function () {

    var ligne = 0;
    var sommeTotal = 0;
    var Send = {};

    $('.add-row').click(function () {
        var labelProduit = document.getElementById('produitVente')[document.getElementById('produitVente').selectedIndex].innerHTML;
        var quantite = $('#quantiteVente').val();
        var prixU = $('#prixUnitaire').val();


        if (labelProduit && quantite > 0 && prixU > 0) {

            var pq = parseInt(prixU) * parseInt(quantite)
            sommeTotal += pq

            var markup = "<tr><td><input type='checkbox' name='record' id=" + ligne + "></td><td>" + labelProduit + "</td><td>" + quantite + "</td><td>" + prixU + "</td><td>" + pq + "</td></tr>";

            $('#sommeTotal').html(sommeTotal)
            $(".ventes").append(markup);
            Send[ligne] = {
                'id': $('#idVente').val(),
                'produit': $('#produitVente').val(),
                'calibre': $("#produitVente").select2("data")[0].element.dataset.ide,
                'quantite': $("#quantiteVente").val(),
                'prixU': $("#prixUnitaire").val(),
            }
            $('#produitVente').val(null).trigger('change');
            $('#quantiteVente').val(' ')
            $('#prixUnitaire').val(' ')
            ligne++;
        }
    })

    $('.del-row').click(function () {
        $(".ventes").find('input[name="record"]').each(function () {
            if ($(this).is(":checked")) {
                $(this).parents("tr").remove();
                sommeTotal -= Send[this.id].prixU * Send[this.id].quantite
                $('#sommeTotal').html(sommeTotal)
                delete Send[this.id];
            }
        })
    })

    $('#formVente').submit(function (e) {
        e.preventDefault();
        var dataToSend = {};
        sommeTotal = 0 ;

        console.log(Object.keys(Send).length)
        if (Object.keys(Send).length > 0) {

            $.each(Send, function (key, value) {
                dataToSend[key] = {
                    'produit': value['produit'],
                    'calibre': value['calibre'],
                    'quantite': value['quantite'],
                    'prixU': value['prixU'],
                    'montantPayer': $('#montantPayer').val(),
                    'nomClient': $('#saisieClient').val(),
                    'idClient': $('#clientVente').val(),
                    'remise': $('#montantReduction').val(),
                    'idVente': $('#idVente').val(),
                    'sommeTotal': parseInt($('#sommeTotal').html()),
                }
            })
            console.log(dataToSend)

            if ($('#idVente').val() > 0) {
                reqAjax('formVente', 'updateVente', 'PUT', dataToSend)
            } else
                reqAjax('formVente', 'addVente', 'POST', dataToSend)

            //            console.log(dataToSend)

            Vente_table.ajax.reload();
            $(".ventes").find('input[name="record"]').each(function () {
                $(this).parents("tr").remove();
                $('#sommeTotal').html(sommeTotal)
                delete Send[this.id];
            })
        }
    })

    $('#montantReduction').blur(function () {
        if ((Object.keys(Send).length > 0)) {
            sommeTotal -= parseInt($('#montantReduction').val())
            $('#sommeTotal').html(sommeTotal)
        }
    })



    var Vente_table = $('#datatableVentes').DataTable({
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
            "url": urlGetVente,
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
                        "<a href='#' class='dropdown-item facture'>FACTURE</a>" +
                        "<a href='#' class='dropdown-item modifier'>MODIFIER</a>" +
                        "<a href='#' class='dropdown-item supprimer'>ANNULER</a>" +
                        "</div>";
                }
      },
    ],
        "columns": [{
                "data": "id"
    },
            {
                "data": "identifiantVentes"
    },
            {
                "data": ""
    }
  ],
    });



    //supprimer une veente
    $('#datatableVentes tbody ').on('click', '.supprimer', function () {

        var data = Vente_table.row($(this).parents('tr')).data();
        $('#idVente').val(data.id)
        reqAjax('formVente', 'deleteVente', 'DELETE')
        Vente_table.ajax.reload();
    })


    //modifer une veente
    $('#datatableVentes tbody ').on('click', '.modifier', function () {
        var data = Vente_table.row($(this).parents('tr')).data();
        ligne = 0;
        
        $(".ventes").find('input[name="record"]').each(function () {
                $(this).parents("tr").remove();
                $('#sommeTotal').html(0)
                delete Send[this.id];

        })
        
        $('#montantReduction').val(data['montantRemise']);
        $('#sommeTotal').html(data['montantVente'])
        sommeTotal = data['montantVente']
        console.log(data['montantVente'])
        $('#saisieClient').val(data['nomClients']);
        $('#clientVente').val(data['client_id']).trigger('change');
        $('#montantPayer').val(data['sommePayer']);

       
        
        $('#idVente').val(data.id)
        
        $.each(data.produit, function (key, value) {
            
             var markup = "<tr><td><input type='checkbox' name='record' id=" + ligne + "></td><td>" + value.prod['designationProduit']+' '+ value.cal['calibre'] + "</td><td>" + value.quantite + "</td><td>" + value.prix + "</td><td>" + parseInt(value.prix) * parseInt(value.quantite) + "</td></tr>";
            
            
            
            $(".ventes").append(markup);
            Send[ligne] = {
                'id': $('#idVente').val(),
                'produit': value['produit_id'],
                'calibre': value['calibre_id'],
                'quantite': value['quantite'],
                'prixU': value['prix'],
            }
            
            console.log(Send)
            ligne++;
            
            
      });  
        
        
    })


    
    ////////////facture
    $('#datatableVentes tbody ').on('click', '.facture', function() {
      var data = Vente_table.row($(this).parents('tr')).data();

        console.log(data)
      $.ajax({
        type: 'POST',
        url: 'factureVente',
        data: {
          'date': data['id'],
          _token: $('meta[name="csrf-token"]').attr('content')
        },

        //xhrFields is what did the trick to read the blob to pdf
        xhrFields: {
          responseType: 'blob'
        },
        success: function(response, status, xhr) {
          var filename = "";
          var disposition = xhr.getResponseHeader('Content-Disposition');

          if (disposition) {
            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
            var matches = filenameRegex.exec(disposition);
            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
          }
          var linkelem = document.createElement('a');
          try {
            var blob = new Blob([response], {
              type: 'application/octet-stream'
            });

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
              //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
              window.navigator.msSaveBlob(blob, filename);
            } else {
              var URL = window.URL || window.webkitURL;
              var downloadUrl = URL.createObjectURL(blob);

              if (filename) {
                // use HTML5 a[download] attribute to specify filename
                var a = document.createElement("a");

                // safari doesn't support this yet
                if (typeof a.download === 'undefined') {
                  window.location = downloadUrl;
                } else {
                  a.href = downloadUrl;
                  a.download = filename;
                  document.body.appendChild(a);
                  a.target = "_blank";
                  a.click();
                }
              } else {
                window.location = downloadUrl;
              }
            }

          } catch (ex) {
            console.log(ex);
          }
        }
      });
  })

    
    /////////////////cloture journne submit
    $('#formCloture').submit(function (e) {
        e.preventDefault();
        reqAjax('formCloture', 'addCloture', 'POST')
        Cloture_table.ajax.reload();
    })

    
    /////////////////datatable cloture
    var Cloture_table = $('#datatableCloture').DataTable({
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
            "url": urlGetCloture,
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
                    return " <button class='bilan btn btn-square btn-outline-primary'>BILAN</button>" ;
                        
                }
      },
    ],
        "columns": [{
                "data": "id"
    },
            {
                "data": "identifiantCloture"
    },
            {
                "data": ""
    }
  ],
    });
    //////////////////////end datatable cloture
    
    
    
  /////////////////datatable booutoon///////////////////////////////////
  //click sur le boutton bilan
  $('#datatableCloture tbody ').on('click', '.bilan', function() {
      var data = Cloture_table.row($(this).parents('tr')).data();

      $.ajax({
        type: 'POST',
        url: 'bilan',
        data: {
          'date': data['dateCloture'],
          _token: $('meta[name="csrf-token"]').attr('content')
        },

        //xhrFields is what did the trick to read the blob to pdf
        xhrFields: {
          responseType: 'blob'
        },
        success: function(response, status, xhr) {
          var filename = "";
          var disposition = xhr.getResponseHeader('Content-Disposition');

          if (disposition) {
            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
            var matches = filenameRegex.exec(disposition);
            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
          }
          var linkelem = document.createElement('a');
          try {
            var blob = new Blob([response], {
              type: 'application/octet-stream'
            });

            if (typeof window.navigator.msSaveBlob !== 'undefined') {
              //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
              window.navigator.msSaveBlob(blob, filename);
            } else {
              var URL = window.URL || window.webkitURL;
              var downloadUrl = URL.createObjectURL(blob);

              if (filename) {
                // use HTML5 a[download] attribute to specify filename
                var a = document.createElement("a");

                // safari doesn't support this yet
                if (typeof a.download === 'undefined') {
                  window.location = downloadUrl;
                } else {
                  a.href = downloadUrl;
                  a.download = filename;
                  document.body.appendChild(a);
                  a.target = "_blank";
                  a.click();
                }
              } else {
                window.location = downloadUrl;
              }
            }

          } catch (ex) {
            console.log(ex);
          }
        }
      });
  })


/////////////////////////////end bouton




})
