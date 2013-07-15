<?php

/**
 * Permite que a aplicação carregue a configuração dinamicamente de acordo
 * com o ambiente em uso.
 * 
 * De todo modo o arquivo app/config.php sempre será carregado, e para
 * sob-escrever seu conteudo você deve criar um arquivo app/config/AMBIENTE.php
 * que receberá as mesmas variaveis do config.php original.
 *
 */

$environments = array(
	'localhost' => 'local', // ambiente local que irá apontar para o arquivo
							// app/config/local.php
);