$('.editor').jqte();

postContent('#result', '#form');

$('#imageUpload').change(function () {
    readImageUpload(this);
});

$('.btn-fa').click(function () {
    var faClass = "<i class='" + $(this).attr('class') + "'></i>";
    faClass = faClass.replace('btn-fa ', '');
    $('.icon').html(faClass);
    $('#icon').val(faClass);
    $('#close').trigger("click");
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    language: "pt-BR"
});

function newDate() {
    var d = new Date();
    var curr_date = d.getDate();
    var curr_month = ("00" + (d.getMonth() + 1)).slice(-2);
    var curr_year = d.getFullYear();

    $('#date').val(curr_date + "/" + curr_month + "/" + curr_year);
}

newDate();

$(document).ready(function () {
    $('#datatable').DataTable({
        "language": {
            "lengthMenu": "Exibir _MENU_ registros por página",
            "search": "Pesquisar",
            "loadingRecords": "Carregando...",
            "zeroRecords": "Sua pesquisa não obteve resultado!",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "infoEmpty": "Sem resultado",
            "infoFiltered": ", e filtrado a partir de _MAX_ registros",
            "paginate": {
                "first": "Primeiro ",
                "last": " Último",
                "next": " Próximo",
                "previous": "Anterior "
            },
        }
    });
});