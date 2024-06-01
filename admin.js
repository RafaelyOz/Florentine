document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', event => {
            const id = event.target.dataset.id;
            const formType = event.target.closest('table').dataset.formType;
            // Fetch the data for the given ID and formType (Produto, Cliente, Pedido)
            fetch(`fetchData.php?type=${formType}&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the form fields with the data
                    document.getElementById(`${formType}-id`).value = data.id;
                    document.getElementById(`${formType}-nome`).value = data.nome;
                    document.getElementById(`${formType}-descricao`).value = data.descricao;
                    document.getElementById(`${formType}-preco`).value = data.preco;
                    document.getElementById(`${formType}-estoque`).value = data.estoque;
                    // Add similar lines for Cliente and Pedido forms
                });
        });
    });
});
