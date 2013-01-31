<?php require_once('dbdata.php'); ?>
<?php

if(isset($_POST['email_from'])) {
// EDIT THE 2 LINES BELOW AS REQUIRED
$email_to = "alexakustov@gmail.com";
$email_subject = "Mais um apoiante ISCTE-IUL!";


function died($error) {
// your error code can go here
echo "We are very sorry, but there were error(s) found with the form your submitted. ";
echo "These errors appear below.<br /><br />";
echo $error."<br /><br />";
echo "Please go back and fix these errors.<br /><br />";
die();
}

// validation expected data exists

 $_POST['email_from']."<br/>".$_POST['nome']."<br/>".$_POST['nif']."<br/>".$_POST['relacao-iscte']."<br/>".$_POST['valor']."<br/>".$_POST['numero']."<br/>".$_POST['codpostal']."<br/>";

 "are they set?";
 "email: ".isset($_POST['email_from'])."<br/>";
 "nome: ".isset($_POST['nome'])."<br/>";
 "nif: ".isset($_POST['nif'])."<br/>";
 "relacao-iscte: ".isset($_POST['relacao-iscte'])."<br/>";
 "valor: ".isset($_POST['valor'])."<br/>";
 "numero: ".isset($_POST['numero'])."<br/>";
 "codpostal: ".isset($_POST['codpostal'])."<br/>";


if(
!isset($_POST['email_from']) || !isset($_POST['nome']) || !isset($_POST['nif']) || !isset($_POST['relacao-iscte']) || !isset($_POST['valor']) || !isset($_POST['numero']) || !isset($_POST['codpostal'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }


$email_from = $_POST['email_from'];
$nome = $_POST['nome'];
$nif = $_POST['nif']; 
$morada = $_POST['morada'];
$localidade = $_POST['localidade']; //
$codpostal = $_POST['codpostal']; // 
$relacao = $_POST['relacao-iscte'];
$valor = $_POST['valor'];
$numero = $_POST['numero'];

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

$query = "INSERT INTO licitacao (nome, email, nif, morada, localidade, codpostal, relacao, valor, id_quadro) VALUES ('$nome', '$email_from', $nif, '$morada', '$localidade', '$codpostal', '$relacao', $valor, $numero)";

$result = mysqli_query($mysqli, $query);

// CLOSE CONNECTION
mysqli_close($mysqli);
?>
<?php require_once('dbdata.php');?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Leilão Solidário</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--styles -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-modal.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet'
        type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet"
        type="text/css">
        <style type="text/css">
            body {
                padding-top: 20px;
                padding-bottom: 40px;
            }
            .btitle {
                color: #000;
                font-family:'Abril Fatface';
                font-size: 87px;
                font-style: normal;
                font-variant: normal;
                font-weight: 400;
                line-height: 84px;
            }
            h4 {
                color: #222;
            }
        </style>
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).on("click", ".open-AddBookDialog", function () {
				var quadroNome = $(this).data('id');
                $(".modal-header #quadro").text( quadroNome );
				var quadroNum = $(this).data('num');
                $(".modal-body #numero").val( quadroNum );
				$('#open-AddBookDialog').modal().css(
            {
                'margin-top': function () {
                    return -($(this).height() / 2);
                }
            });
				$('#open-AddBookDialog').modal('show');
			});
		</script>
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    
    <body>
        <div class="container">
            <div class="masthead">
                <ul class="nav nav-pills pull-right">
                    <li class="active">
                        <a href="index.html">Leilão</a>
                    </li>
                    <li>
                        <a href="sobre.html">Sobre</a>
                    </li>
                    <li>
                        <a href="contato.html">Contato</a>
                    </li>
                </ul>
                <a href="index.php" style="text-decoration:none">
                    <p class="btitle">Leilão Solidário</p>
                </a>
            </div>
            <hr>
            <div class="row">
				<h3>Obrigado por ter adquirido o quadro <?php echo $numero; ?>, vamos entrar em contacto em breve.</h3>
<a class="btn" href="http://leilaosolidario.iscte-iul.pt">Voltar a pagina inicial</a>


		
            </div>
            <hr>
            <div class="footer">
                <p>&copy; Clube ISCTE 2013</p>
            </div>
        </div>
		
		
		
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="js/bootstrap-modal.js"></script>
        <script src="js/bootstrap-modalmanager.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

 
</html>

<?php
}
?>