<?php 

if(!isset($imoveis)){
	$imoveis = $this->requestAction('imoveis/listar/sort:created/direction:asc/limit:20'); 
}
?>

<article>
    <h3><?php echo $titulo ?></h3>
    <p>Veja aqui as melhores opções de imóveis que selecionamos para você</p>
    <table>
    <?php 
    
    $data = array();    
    
    $i = 0;
    $row = array();
    $x = 0;
    
    $verImovelUrl = $this->Html->url(
            array(
                'controller'=>'/imoveis', 
                'action'=>'view'
            ),
            true
    );
    //debug($imoveis);
    foreach( $imoveis as $imovel){ 
    	
        $i++;        
        $rec = 
            '<img src="/imobiliariaverissimo/img/imoveis/thumb_imovel'. $imovel['Imovel']['id'] .'_capa.jpg"/>'.
            '<span style="display: block"><strong>'. $this->Formatacao->moeda($imovel['Imovel']['preco']) .'</strong></span>'.
            '<span style="display: block; font-size: smaller;"><strong>'. $imovel['Bairro']['nome_bairro'] .', '. $imovel['Bairro']['Cidade']['nome_cidade'] .'/'. $imovel['Estado']['sigla'] .'</strong></span>'.
            '<span style="display: block; font-size: smaller; height: 42px">'. $imovel['TipoImovel']['descricao'] .', '. $imovel['Imovel']['quartos'] .' quartos, '. $imovel['Imovel']['banheiros'] .' banheiros, '. $this->Formatacao->precisao($imovel['Imovel']['area_construida'], 0) .'m<sup>2</sup></span>'.
            '<a href="'. $verImovelUrl . '/' .$imovel['Imovel']['id'] .'" class="ym-button">Ver imóvel</a>'.
            '<a href="#" class="ym-button ym-like">Gostei</a>';
        
        $row[] = $rec;
                
        if($i==4){
        
            $data[] = $row;
            $i = 0;
            $row = array();
        }             

    }  
    
    if(sizeof($row)>0){
        if($i < 4) $data[] = $row;        
    }
    
    if(sizeof($data)>0){
        echo $this->Html->tableCells($data);
    }
  
    
    ?>         
                        
    </table>
</article>
