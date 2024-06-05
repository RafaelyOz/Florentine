document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', event => {
            const id = event.target.dataset.id;
            const formType = event.target.closest('table').dataset.formtype;
            
            fetch(`fetchData.php?type=${formType}&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.querySelector(`input[name="id"]`).value = data.id;
                    document.querySelector(`input[name="nome"]`).value = data.nome;
                    document.querySelector(`input[name="descricao"]`).value = data.descricao;
                    document.querySelector(`input[name="preco"]`).value = data.preco;
                    document.querySelector(`input[name="estoque"]`).value = data.estoque;
                });
        });
    });
});
