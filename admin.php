<?php require_once('dbdata.php'); ?>
<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="utf-8">
        <title>Admin Solidário</title>
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
                        <a href="index.html">Voltar ao Leilão</a>
                    </li>

                </ul>
                <a href="index.html" style="text-decoration:none">
                    <p class="btitle">Admin Solidário</p>
                </a>
            </div>
            <hr>
			<?php

			//Database mambo-jambo
			//DANGER: using mysqli for improved security, require this package on server.

			$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
			mysqli_set_charset($mysqli, "utf8");

			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}

			$query = "select * from quadros";

			$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) { ?>
					 <div class="row">
			                <div class="span10">
			                    	<h4><?php echo $row['nome'];?></h4>

									<table class="table">
									<thead>
										<tr>
											<th>Ultima Licitação</th>
											<th>Nome</th>
											<th>Email</th>
											<th>Relação ISCTe</th>
											<th>Morada</th>
											<th>Localidade</th>
											<th>CP</th>
											<th>NIF</th>

										</tr>
									</thead>
										<tbody>
											<?php
											$query2 = "select * from licitacao where id_quadro = $row[id_quadro]";

											$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
											if($result2->num_rows > 0) {
												while($row2 = $result2->fetch_assoc()) {?>
													<tr>
													<td><?php echo $row2['valor'];?></td>
													<td><?php echo $row2['nome'];?></td>
													<td><?php echo $row2['email'];?></td>
													<td><?php echo $row2['relacao'];?></td>
													<td><?php echo $row2['morada'];?></td>
													<td><?php echo $row2['localidade'];?></td>
													<td><?php echo $row2['codpostal'];?></td>
													<td><?php echo $row2['nif'];?></td>
													</tr>
													<?php
													//echo "----<br/>";
													//echo stripslashes("Nome:" . $row2['nome'].'<br/>');
													//echo stripslashes("Valor:" . $row2['valor'].'<br/>');
													//echo "----<br/>";
												}
											}
											else {?>
												<tr>
												<td>Não existem licitações</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												</tr>
											<?php }

											?>

										</tbody>
									</table>
			                </div>
							</div>
							<?php
					//echo stripslashes($row['id_quadro'].'<br/>');
					//echo stripslashes($row['info'].'<br/>');
					//echo stripslashes($row['preco_actual'].'<br/>');
					//echo stripslashes('<img src="'.$row['img_url'].'" width="100px"/><br/>');
					//echo 'licitações: <br/>';

					//echo "########<br/>";
				}
			}
			else {
				//echo 'NO RESULTS';
			}

			// CLOSE CONNECTION
			mysqli_close($mysqli);



			?>


            <hr>
            <div class="footer">
                <p>&copy; Clube ISCTE 2013</p>
            </div>
        </div>


		<div id="responsive" class="modal hide fade" tabindex="-1" data-width="760">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="quadro">&nbsp;</h3>
		  </div>
		  <div class="modal-body">
			<div class="row-fluid">
			 <form method='POST' action='mobilesend.php'>
			  <div class="span6">
				<input type="hidden" name="numero" value="1" id='numero'/>
				<label>Nome Completo</label> <input type='text' id='nome' name='nome' /> <br />
				<label>NIF</label>  <input type='number' name='nif' required/> <br />
				<label>Codigo-Postal</label>  <input type='text' placeholder='0000-000' name='codpostal' required/> <br />
				<label>Relação com o ISCTE-IUL</label>
					<select name='relacao-iscte'>
					  <option value='Antigo Aluno'>Antigo Aluno</option>
					  <option value='Aluno'>Aluno</option>
					  <option value='Familiar de Aluno/ Antigo Aluno'>Familiar de Aluno/ Antigo Aluno</option>
					  <option value='Funcionário'>Funcionário</option>
					  <option value='Professor'>Professor</option>
					  <option value='Amigo do ISCTE-IUL'>Amigo do ISCTE-IUL</option>
					</select>  <br />
			  </div>
			  <div class="span6">
				<label>E-mail</label> <input type='email' name='email_from' required/> <br />
				<label>Morada</label>  <input type='text' name='morada' required/> <br />
				<label>Localidade</label>  <input type='text' name='localidade' required/> <br />
				<label>Apoio com</label> <div class='input-prepend'> <span class='add-on'>&euro;</span>
					<input class='span1' width="100" id='prependedInput' name='valor' type='text' placeholder='1000'></div>
			  </div>

			</div>
		  </div>
		  <div class="modal-footer">
			<center><input class='btn btn-info' value='Submeter' type='submit'></center>
				</form>
		  </div>
		</div>

        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="js/bootstrap-modal.js"></script>
        <script src="js/bootstrap-modalmanager.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

</html>