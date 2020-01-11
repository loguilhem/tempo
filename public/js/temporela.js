$(document).ready(function() {
    /*Date picker plugin*/
    $('.datePick').datepicker({
        dateFormat: 'dd-mm-yy',
        altField: "#appbundle_temps_date",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.'
    });

    /*To disable date pickers in recap forms */
    $('.disDatePickForm1').click(function(){
        if($('.disDatePickForm1').prop('checked')){
            $('.form1').prop('disabled', true)
        }
        else{
            $('.form1').prop('disabled', false)
        }
    });

    $('.disDatePickForm2').click(function(){
        if($('.disDatePickForm2').prop('checked')){
            $('.form2').prop('disabled', true)
        }
        else{
            $('.form2').prop('disabled', false)
        }
    });

    $.fn.dataTable.moment( 'DD/MM/YYYY' );

    /* Datatable plugin*/
    $('.list_table').DataTable({
        autoFill: true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5'
        ],
        "orderMulti": true,
        "language": {
            "decimal":        "",
            "emptyTable":     "Pas de données à afficher",
            "info":           "De _START_ à _END_ des _TOTAL_ données",
            "infoEmpty":      "0 à 0 de 0 données",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      " ",
            "lengthMenu":     "Montrer _MENU_ données",
            "loadingRecords": "Chargement...",
            "processing":     "En cours...",
            "search":         "Rechercher:",
            "zeroRecords":    "pas de données trouvées",
            "paginate": {
                "first":      "Première",
                "last":       "Dernière",
                "next":       "Suivante",
                "previous":   "Précédente"
            },
            "aria": {
                "sortAscending":  ": Ordonner par ordre croissant",
                "sortDescending": ": Ordonner par odre décroissant"
            }}
    });

    /*Select input plugin*/
    $(".chosen-select").chosen({
        no_results_text: "Oops, rien de trouvé!",
        width: "150px"
    });
});