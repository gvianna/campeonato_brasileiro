<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tabela do Brasileirão Série A</title>
<link rel="stylesheet" type="text/css" href="css/brasileiro.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="icon" type="image/gif" href="img/1529677776621.gif"/>
</head>

<?php
	
	function objectToArray($d) {
		if (is_object($d)) {
			$d = get_object_vars($d);
		}
		if (is_array($d)) {
			return array_map(__FUNCTION__,$d);
		}else{
			return $d;
		}
	}
	
$url = ('http://jsuol.com.br/c/monaco/utils/gestor/commons.js?file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/2020/30/dados.json');

$content = http_build_query(array());

$context = stream_context_create(array('http' => array(
'method' => 'GET',
'header' => "Content-Type: application/x-form-urlenconded\r\n".
"content-length:".strlen($content)."\r\n",

'content' => $content,)
)
)
;

$conteudo_de_retorno = file_get_contents($url, false, $context);
$conteudo = objectToArray(json_decode($conteudo_de_retorno));

foreach ($conteudo['equipes'] as $value){
	$arr_nome_time[$value['id']]=$value['nome-comum'];
	
	$arr_brasao_time[$value['id']]=$value['brasao'];
	
	}
	
$liberta1 = substr($conteudo ['fases']['3062']['faixas-classificacao']['classifica1']['faixa'], 0, 1);
$liberta2 = substr($conteudo ['fases']['3062']['faixas-classificacao']['classifica1']['faixa'], 2, 4);

$sulame1 = substr($conteudo ['fases']['3062']['faixas-classificacao']['classifica2']['faixa'], 0, 1);
$sulame2 = substr($conteudo ['fases']['3062']['faixas-classificacao']['classifica2']['faixa'], 2, 4);

$rebaixa1 = substr($conteudo ['fases']['3062']['faixas-classificacao']['classifica3']['faixa'], 0, 2);
$rebaixa2 = substr($conteudo ['fases']['3062']['faixas-classificacao']['classifica3']['faixa'], 3, 5);

		?>
        
<body>
	<div class="bandeira">
		<img src="img/1529677776621.gif" id="bd"/>
	</div>
	<main>
		<div class="head">
			<ol><img src="img/índice.png"/>CLASSIFICAÇÃO - Brasileirão Série A</ol>
		</div>
				<table class="table" width="680px" border="0" overflow="auto">
					<tbody>
						<tr>
							<td>Pos</td>
							<td>Clube</td>
							<td>PTS</td>
							<td>VIT</td>
							<td>E</td>
							<td>D</td>
							<td>GP</td>
							<td>GC</td>
							<td>SG</td>
					   </tr>

				<?php
				
					$count = 0;

					foreach ($conteudo ['fases']['3062']['classificacao']['equipe'] as $idclass){
						
						$count++;
						
				?>		
					<tr id="tr">
						<td style="
                        <?php 
						
							if($count >= $liberta1 && $count <= $liberta2){
								echo 'color:blue;';
							}
							if($count >= $sulame1 && $count <= $sulame2){
								echo 'color:green;';
							}
							if($count >= $rebaixa1 && $count <= $rebaixa2){
								echo 'color:red;';
							}
							?>
						
						"><?php echo $count; ?></td>

						<td><img src="<?php echo $arr_brasao_time[$idclass['id']];?>" width="24" height="24" alt=""/> 
						<?php echo $arr_nome_time[$idclass['id']];?></td>


						<td><?php echo $idclass['pg'] ['total']; ?></td>
						<td><?php echo $idclass['v']  ['total']; ?></td>	
						<td><?php echo $idclass['e']  ['total']; ?></td>	
						<td><?php echo $idclass['d']  ['total']; ?></td>	
						<td><?php echo $idclass['gp'] ['total']; ?></td>	
						<td><?php echo $idclass['gc'] ['total']; ?></td>	
						<td><?php echo $idclass['sg'] ['total']; ?></td>
				<?php

					}
				?>	
					</tbody>
				</table>
		</main>
	</body>
</html>
