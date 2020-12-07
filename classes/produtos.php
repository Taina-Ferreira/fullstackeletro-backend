<?php

include_once(SITE_ROOT . "factory/conexao.php");


class Produtos{

    private $sql_base = "select p.id_produto, c.categoria,p.descricao,p.preco,p.preco_com_desconto,p.imagem from tb_produtos p inner join tb_categoria_produtos c on p.id_produto = c.id_categoria";

    public function get($id = NULL){
        
        $conexao = new Conexao();

        if ($id){
            $sql = $this->sql_base . " where p.id_produto = ?";
            $types = 'i';
            $params = [$id];
            $dados = $conexao->executa_sql($sql,$types,$params);
        }else{
            $sql = $this->sql_base;
            $dados = $conexao->executa_sql($sql);  
        }
        return json_encode($dados);
    }

    public function post($body){
        $conexao = new Conexao();
        $data = json_decode($body,true);
        
        $sql = "insert into tb_produtos (id_categoria, nome_produto, descricao, preco, preco_com_desconto, imagem) values (?,?,?,?,?,?)";
        $types = "issdds";
        $params = array_values($data);
        $conexao->executa_sql($sql,$types,$params);
    }


}