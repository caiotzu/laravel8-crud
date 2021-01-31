$(function(){

    // Variáveis Globais
    _token = $('[name=_token]').val();
    URL    = $('#ActionControl').val().substring(0, $('#ActionControl').val().lastIndexOf('/'));

    // Faz verificação antes de excluir
    $('button[name=btnExcluir]').on('click', function(e) {
        const produto = $(this).attr('data-produto')

        if(confirm(`Deseja realmente excluir o produto: ${produto} ?` ))
            $(this).closest('form').submit()
        else
            return false
    });

    // Mostra ou esconde o botão de deletar todos
    $(':input[name^=checkProduto]').on('click', function(e) {
        let isCheck = false;

        $(':input[name^=checkProduto]').each(function() {
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
        $(':input[name^=checkProduto]').each(function() {
            if($(this).prop('checked'))
                arr.push($(this).prop('name'))
        })
        
        
        axios({
            method: 'post',
            url: `${URL}/ajax/destroyProdutosSelected`, // url
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
    
} );