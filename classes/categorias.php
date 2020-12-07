<?php

include_once(SITE_ROOT . "factory/conexao.php");

class Categorias{
    private $sql_base = "select id_categoria,categoria from tb_categoria_produtos";

    public function get($id = false){
        
        $conexao = new Conexao();
        
        if ($id){
            $sql = $this->sql_base . ' where id_categoria = ?';
            $types = 'i';
            $params = [$id];
            $dados = $conexao->executa_sql($sql,$types,$params); 
        }else{
            $sql = $this->sql_base;
            $dados = $conexao->executa_sql($sql);
        }        
        return json_encode($dados);
    }
}