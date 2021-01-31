$(function(){
    // Configuração dataTables
    $(document).ready(function() {
        $('#dataTable').DataTable( {
            language: {
                sEmptyTable: "Nenhum registro encontrado",
                sInfo:	"Mostrando de _START_ até _END_ de _TOTAL_ registros",
                sInfoEmpty:	"Mostrando 0 até 0 de 0 registros", 
                sInfoFiltered: "(Filtrados de _MAX_ registros)",
                sInfoThousands: ".",
                sLengthMenu: "_MENU_ resultados por página",
                sLoadingRecords: "Carregando...",
                sProcessing: "Processando...",
                sZeroRecords:"Nenhum registro encontrado",
                sSearch: "",
                searchPlaceholder: "Pesquisar...",
                oPaginate: {
                    sNext: "Próximo",
                    sPrevious: "Anterior",
                    sFirst: "Primeiro",
                    sLast: "Último"
                },
            },
            pageLength: 20,
            lengthMenu: [[10, 20, 30, 50, -1], [10, 20, 30, 50, "All"]],
            pagingType: "full_numbers",
            sInfo:	"Mostrando de _START_ até _END_ de _TOTAL_ registros"
        } );
    } );

    // Select 2
    $('.select2').select2();

    // Máscaras
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.money').mask('000000000.00', {reverse: true});

} );