<?php
require_once("../factory/conexao.php");

class VendasProtudo{

    private $sql_base = "
    select v.id_venda,
	   v.id_usuario,
       v.id_endereco,
       v.data_venda,
       vp.id_venda_produto,
       p.id_produto,
       p.nome_produto,
       vp.preco
  from tb_vendas v
inner join tb_vendas_produtos vp
	on v.id_venda = vp.id_venda
inner join tb_produtos p
	on vp.id_produto = p.id_produto
    ";

    public function get_all_vendas(){
        $sql = $this->sql_base;
        $conexao = new Conexao();

        $dados = $conexao->executa_sql($sql);           
        return json_encode($dados);
    }

    public function get_venda($id){
        $sql = $this->sql_base . " where v.id_venda = ?";
        $conexao = new Conexao();
        
        $types = 'i';
        $params = [$id];
        $dados = $conexao->executa_sql($sql,$types,$params);           
        return json_encode($dados);
    }


    public function get_vendas_user($id){
        $sql = $this->sql_base . " where v.id_usuario = ?";
        $conexao = new Conexao();
        
        $types = 'i';
        $params = [$id];
        $dados = $conexao->executa_sql($sql,$types,$params);           
        return json_encode($dados);
    }
}
    