<!DOCTYPE html>
<html>
<head>
	<title>Upload de Arquivo PHP</title>
</head>
<body>

	<?php
		// Verifica se o formulário foi enviado
		if(isset($_POST['submit'])) {
			
			// Verifica se um arquivo foi selecionado
			if(!empty($_FILES['file']['name'])) {
				
				// Define o diretório de destino do arquivo
				$target_dir = "arquivos/";
				
				// Define o caminho completo do arquivo no servidor
				$target_file = $target_dir . basename($_FILES['file']['name']);
				
				// Move o arquivo para o diretório de destino
				if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
					echo "Arquivo enviado com sucesso.";
				} else {
					echo "Ocorreu um erro ao enviar o arquivo.";
				}
				
			} else {
				echo "Por favor, selecione um arquivo para enviar.";
			}
		}
	?>

	<h2>Envie um arquivo</h2>

	<form method="post" enctype="multipart/form-data">
		<label for="file">Escolha um arquivo para enviar:</label>
		<input type="file" name="file" id="file"><br><br>
		<input type="submit" name="submit" value="Enviar">
	</form>
	
	<hr>
	
	<?php
	// Define o diretório de destino dos arquivos
	$target_dir = "arquivos/";
	
	// Obtém uma lista de todos os arquivos na pasta
	$file_list = scandir($target_dir);
	
	// Remove os arquivos '.' e '..' da lista
	unset($file_list[0]);
	unset($file_list[1]);
	
	// Verifica se há arquivos na pasta
	if(count($file_list) > 0) {
		
		// Exibe a tabela com os arquivos
		echo "<h2>Arquivos Enviados</h2>";
		echo "<table border='1' style='width:500px;'>";
		echo "<tr><th>Arquivo</th></tr>";
		
		foreach($file_list as $file) {
			echo "<tr><td><a href='arquivos/" . $file . "'>" . $file . "</a></td></tr>";
		}
		
		echo "</table>";
		
	} else {
		echo "<p>Nenhum arquivo enviado.</p>";
	}
?>

</body>
</html>