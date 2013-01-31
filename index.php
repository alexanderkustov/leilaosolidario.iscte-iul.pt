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
				<?php

				//Database mambo-jambo
				//DANGER: using mysqli for improved security, require this package on server.

				$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

				if (mysqli_connect_errno()) {
					printf("Connect failed: %s\n", mysqli_connect_error());
					exit();
				}

				$query = "select * from quadros";
				
				mysqli_set_charset($mysqli, "utf8");
				$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { ?>
						 <div class="span3">
			                    	<h4><?php echo $row['nome']; ?></h4>

			                    <a href="#myModal" role="button" class="" data-toggle="modal" data-target="#myModal<?php echo $row['id_quadro']; ?>">
			                        <img class="img-polaroid" src="<?php echo $row['img_url']; ?>" />
			                    </a>
			                    <div id="myModal<?php echo $row['id_quadro']; ?>" style="position: absolute; width: auto;" class="modal container hide fade" tabindex="-1">
			                        <div class="modal-header">
			                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			                             <h3><?php echo $row['nome']; ?></h3>

			                        </div>
			                        <div class="modal-body">
			                            <center><img src="<?php echo $row['img_url']; ?>" /></center>
			                            <p><?php echo $row['info']; ?></p>
			                        </div>
			                        <div class="modal-footer">
			                            <!--<button type="button" data-dismiss="modal" class="btn">Close</button>
			                            <button type="button" class="btn btn-primary">Save changes</button>-->
			                        </div>
			                    </div>
			                    <hr>
			                    <p>
			                        <a href="#" class="btn disabled">Preço Actual: <strong><?php
												$query2 = 'select valor from licitacao where id_quadro = ' . $row["id_quadro"] . ' order by valor DESC';
												$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
												if($result2->num_rows > 0) {
												$row1 = $result2->fetch_assoc();
												echo $row1['valor']; 
					} else echo "50";

									?>€</strong>
			                        </a>
			                        <a href="#responsive" data-toggle="modal" data-id="<?php echo $row['nome']; ?>" data-num="<?php echo $row['id_quadro']; ?>" class="open-AddBookDialog btn btn-info"><i class="icon-chevron-up icon-white"></i> Licitar</a>
			                    </p>
			                    <p>
			                        <a href="#myModal" role="button" class="btn" data-toggle="modal" data-target="#myModal<?php echo $row['id_quadro']; ?>"><i class="icon-info-sign"></i>Informações</a>
			                    </p>
			                </div>
						
					<?php }
				}
				else {
					echo "<script>alert('123');</script>";//echo 'NO RESULTS';	
				}

				// CLOSE CONNECTION
				mysqli_close($mysqli);



				?>
                
            </div>
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
				<input type="hidden" name="numero" value="99" id='numero'/>
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
					<input class='span1' style="width: 150px;" id='prependedInput' name='valor' type='text' placeholder='1000'></div>
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