<?php

$where = Array();

function getParameter( $key ){
    return isset(  $_REQUEST[ $key ] ) ?  $_REQUEST[ $key ] : null;
}

if(!empty($_REQUEST)) {
    
    $nome = getParameter('nome');
    $placa = getParameter('placa');
    $dataIni = getParameter('dataOcorrenciaIni');
    $dataFim = getParameter('dataOcorrenciaFim');
    
    if( $nome ){ $where[] = " f.nome = '{$nome}'"; }
    if( $placa ){ $where[] = " v.placa = '{$placa}'"; }
    if( $dataIni ){ $where[] = " convert(r.data_registro,date)  >= '{$dataIni}'"; }
    if( $dataFim ){ $where[] = " convert(r.data_registro,date) <= '{$dataFim}'"; }

}

$db = new Database();

if($db->connect()) {

    $sql =  "SELECT v.placa,
            f.nome,
            r.data_registro,
            v.vel_maxima,
            r.vel_registrada,
            r.latitude,
            r.longitude,
            concat(ROUND((r.vel_registrada-v.vel_maxima)/v.vel_maxima*100),'%') as diferenca,
            concat('<a class=''btn btn-outline-primary'' target=''_blank'' href=''https://www.google.com.br/maps/search/',r.latitude,r.longitude,'''>Abrir</a>') as link_map
            FROM rastreamento r 
            join veiculo v on r.veiculo_id = v.id 
            join funcionario f on r.funcionario_id = f.id ";

    if(sizeof($where))
        $sql.='WHERE'.implode('AND',$where);            

    $dados = $db->sqlQueryArray(
        $sql
    );

    echo json_encode(array(
        'status' => 'success',
        'data' => $dados,
        'sql' => $sql
    ));

} else {
    echo json_encode(array(
        'status' => 'failure',
        'message' => 'Erro ao conectar ao banco'
    ));
}