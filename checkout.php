<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <script>
            window.addEventListener("load", function(event){
                $.ajax({
                    url: 'config.php',
                    dataType:'json',
                    success:function(dados){
                        PagSeguroDirectPayment.setSessionld(dados.id);
                        MetodosPag();//chama a função MetodosPad().
                    }
                }); 
            });      
                 
        //Função MetodosPag()
        function MetodosPag(){
            PagSeguroDirectPayment.getPaymentMethods({
                amount: 500.00,
                success: function(dados){
                    console.log(dados.paymentMethods.CREDIT_CARD.name);
                },error:function(dados){
                    console.log(dados);
                }
            });
        }

        /*Bandeira do Cartão */
        function Brand(){
            var num = document.getElementsByName("num-cartao")[0].value;
            if(num.length == 6){
                PagSeguroDirectPayment.getBrand({
                    cardBin: num, //Recebe os 6 primeiros digitos
                    success: function(dados){
                        console.log(dados);
                    },
                    error: function(dados){
                        console.log(dados);
                    }
                });
            }
        }
        </script>

        <title>Sitema de pagamento</title>
        <style>
            div{
                width: 400px; height: auto; margin:10px;
            }

            input{
                width: 100%; height: 40px;
                border-radius: 3px; border: .5px solid #9e9e9e;
                padding: 5px; box-sizing: border-box;
            }

            .venc{
                width: 60px;
            }
            input[name="num-cartao"]{width:80%;}
            input[name="band"]{width:19%}
            input[type="submit"]{background-color:#84EA84;}
        </style>
    </head> 
    <body>
        <form method="POST" action="checkout.php">
            <input type="hidden" name="id-session" value=""/>
            <div>Email<input type="email" name="email"/></div>
            <div>Senha<input type="password" name="pass"/></div>
            <div>Nome cartão<input type="text" name="nome-cartao"/></div>
            <div>Número cartão
                <input type="number" name="num-cartao" onKeyUp="Brand()" />
                <input type="text" name="band"/>
            </div>
            <div>CVV<input type="number" name="n-cvv"/></div>
            <div>Venc.
                <input type="number" name="n-mes" class="venc" placeholder="12"/>
                <input type="number" name="n-ano" class="venc" placeholder="2020"/>
            </div>
            <div>CPF<input type="number" name="n-cpf"/></div>
            <div><input type="submit" value="Confirmar"/></div>
        </form>
    </body>