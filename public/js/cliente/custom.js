$(function(){

    // Variáveis Globais
    _token = $('[name=_token]').val();
    URL    = $('#ActionControl').val().substring(0, $('#ActionControl').val().lastIndexOf('/'));

    // Faz verificação antes de excluir
    $('button[name=btnExcluir]').on('click', function(e) {
        const cliente = $(this).attr('data-nome')

        if(confirm(`Deseja realmente excluir o cliente: ${cliente} ?` ))
            $(this).closest('form').submit()
        else
            return false
    });


    // Mostra ou esconde o botão de deletar todos
    $(':input[name^=checkCliente]').on('click', function(e) {
        let isCheck = false;

        $(':input[name^=checkCliente]').each(function() {
            if($(this).prop('checked')) 
                isCheck = true;
        })

        if(isCheck)
            $('a[name=btnExcluirAll]').show()
        else
            $('a[name=btnExcluirAll]').hide()
    });

    // Exclui os registro selecionados
    $('a[name=btnExcluirAll]').on('click', function(e) {
        let arr = []

        // Pega todos os registros selecionados na tabela
        $(':input[name^=checkCliente]').each(function() {
            if($(this).prop('checked'))
                arr.push($(this).prop('name'))
        })
        
        
        axios({
            method: 'post',
            url: `${URL}/ajax/destroyClientesSelected`, // url
            data: {
                arr: arr,
            }
        })
        .then(response => {
            let result = JSON.parse(response.request.response);
            if(result.error) {
                $('#contentMain').prepend(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${result.msg}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `)
            } else {
                window.location.href = `?msg=${result.msg}`;
            }
        })
        .catch(error => {
            $('#contentMain').prepend(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${error}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `)
            // console.log(error)
        })
    });
});