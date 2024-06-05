<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Produtos</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <!-- Estrutracao do header, onde ele foi separdo em tres divs para que possa ser separados conforme layout -->
    <header>
        <div>
            <a href="contato.html">Contatos</a>
            <a href="#">Produtos</a>
        </div>
        <div>
            <a href="index.html"><h2>Florentine</h2></a>
        </div>
        <div>
            <img src="img/coracao.png" alt="Notificações">
            <img src="img/sacola.png" alt="Sacola">
            <a class="profile-link" href="login.php">
                <img src="img/pessoa.png" alt="Perfil">
            </a>
        </div>
    </header>

    <!-- Conteudo da pagina inicial -->
    <div class="pginicial_content">

        <div class="wellcome-product">
            <img src="img/TelaProd.png" alt="flores">
        </div>

        <div class="inicial_content_catalogo">
            <h1 class="title-catalog">Catálogo</h1>
        </div>
        <hr>

        <!-- Vitrine de produtos -->
        <div class="showcase">

            <h3>Arranjos Florais</h3>
            <div class="div_showcase_content">
            <div class="anterior"><img src="./img/anterior 1.png" alt=""></div>
                <div class="showcase_content">
                    <img src="img/Primaveril.png" alt="Arranjo">
                    <p>Primaveril</p>
                    <p>R$95,00</p>
                </div>
                <div class="showcase_content">
                    <img src="img/elegancia.png" alt="Suculentas">
                    <p>Elegância</p>
                    <p>R$110,00</p>
                </div>
                <div class="showcase_content">
                    <img src="img/tropical.png" alt="Presentes e acessórios">
                    <p>Tropical</p>
                    <p>R$125,00</p>
                </div>
                <div class="proximo"><img src="./img/proximo 1.png" alt=""></div>
            </div>
        </div>

        <div class="showcase">
            <h3>Plantas e Suculentas</h3>
            <div class="div_showcase_content">
            <div class="anterior"><img src="./img/anterior 1.png" alt=""></div>
                <div class="showcase_content">
                    <img src="img/cacto.png" alt="Arranjo">
                    <p>Cacto Bola</p>
                    <p>R$30,00</p>
                </div>
                <div class="showcase_content">
                    <img src="img/suculentaJad.png" alt="Suculentas">
                    <p>Suculenta Jade</p>
                    <p>R$35,00</p>
                </div>
                <div class="showcase_content">
                    <img src="img/miniJardim.png" alt="Presentes e acessórios">
                    <p>Jardim de Suculentas</p>
                    <p>R$60,00</p>
                </div>
                <div class="proximo"><img src="./img/proximo 1.png" alt=""></div>
            </div>
        </div>

        <div class="showcase">
            <h3>Presentes e Acessórios</h3>
            <div class="div_showcase_content">
            <div class="anterior"><img src="./img/anterior 1.png" alt=""></div>
                <div class="showcase_content">
                    <img src="img/vela.png" alt="Arranjo">
                    <p>Vela Ar. Lavanda</p>
                    <p>R$40,00</p>
                </div>
                <div class="showcase_content">
                    <img src="img/carta.png" alt="Suculentas">
                    <p>Cartões Personalizados</p>
                    <p>R$25,00</p>
                </div>
                <div class="showcase_content">
                    <img src="img/cesta.png" alt="Presentes e acessórios">
                    <p>Cesta de Café da Manhã</p>
                    <p>R$120,00</p>
                </div>
                <div class="proximo"><img src="./img/proximo 1.png" alt=""></div>
            </div>
        </div>

        <div class="showcase">
            <h3>Decorações para Eventos</h3>
            <div class="div_showcase_content">
            <div class="anterior"><img src="./img/anterior 1.png" alt=""></div>
                <div class="showcase_content">
                    <img src="img/arco.png" alt="Arranjo">
                    <p>Arco de flores</p>
                    <p>A partir de R$500,00</p>
                </div>
                <div class="showcase_content">
                    <img src="img/centro.png" alt="Suculentas">
                    <p>Centro de Mesa</p>
                    <p>A partir de R$30,00</p>
                </div>
                <div class="showcase_content">
                    <img src="img/parede.png" alt="Presentes e acessórios">
                    <p>Parede de Flores</p>
                    <p>A partir de R$1000,00</p>
                </div>
                <div class="proximo"><img src="./img/proximo 1.png" alt=""></div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <div>
            <span>.</span>
            <div>
                <h2>Florentine</h2>
            </div>
        </div>
        <div class="content-footer">
            <div>
                <a href="contato.php">Contato</a>
                <a href="">Localização</a>
            </div>
            <div>
                <h4>Produtos</h4>
                <a href="">Arranjos florais</a>
                <a href="">Plantas e suculentas</a>
                <a href="">Presentes e acessorios</a>
                <a href="">Decoração para eventos</a>
            </div>
            <div id="sociais">
                <img src="img/telegram_footer.png" alt="Telegram">
                <img src="img/wpp_footer.png" alt="WhatsApp">
                <img src="img/instagran_footer.png" alt="Instagram">
            </div>
        </div>
    </footer>
</body>

</html>