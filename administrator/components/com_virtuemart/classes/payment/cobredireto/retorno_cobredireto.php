<?php
function capturar($codpedido, $status){
  // Aqui você tem o id do pedido, status e um array contendo (url, mensagem e cobredireto_id).
  // Confira o valor com o que você tem no seu banco de dados
  // e, se o status for 0, libere o pedido.
  $config = new JConfig;
  $con = new mysqli($config->host, $config->user, $config->password, $config->db);
  $query = false;
  switch ($status) {
    case 0:
        $query = sprintf("UPDATE %svm_orders SET order_status = 'C' WHERE order_id = '%s'", $config->dbprefix, $codpedido);
        break;
    case 1:
        $query = sprintf("UPDATE %svm_orders SET order_status = 'X' WHERE order_id = '%s'", $config->dbprefix, $codpedido);
        break;
    case 2:
        $query = sprintf("UPDATE %svm_orders SET order_status = 'P' WHERE order_id = '%s'", $config->dbprefix, $codpedido);
        break;
  }
  if($query) $con->query($query);
}

function pasta(&$pasta=null) {
  if (!$pasta) $pasta = __FILE__;
  $path = pathinfo($pasta);
  $pasta = $path['dirname'];
  return $pasta;
}

define ( '_VALID_MOS' , true ); define ( '_JEXEC' , true );
include ('../ps_cobredireto.cfg.php');

$pasta = null; while (!file_exists("$pasta/configuration.php")) pasta($pasta);
include ("$pasta/configuration.php");
define ('TOKEN', PGS_TOKEN);

include ('biblioteca/retorno.php');

