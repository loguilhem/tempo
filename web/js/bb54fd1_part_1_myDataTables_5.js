$(document).ready(function() {
    $('.list_table').DataTable({
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
} );