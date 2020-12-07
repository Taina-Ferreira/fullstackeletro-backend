<?php


require_once("../factory/conexao.php");

class Vendas{

    public function get_all_vendas(){
        $sql = "
        select  v.id_venda,
                v.id_usuario,
                v.id_endereco,
                v.data_venda,
                u.nome_usuario,
                e.cep,
                e.estado,
                e.cidade,
                e.bairro,
                e.logradouro,
                e.numero,
                e.complemento,
                sum(vp.preco) as valor_total
        from tb_vendas v
        inner join tb_usuarios u
        on v.id_usuario = u.id_usuario
        inner join tb_enderecos e
        on v.id_endereco = e.id_endereco
        inner join tb_vendas_produtos vp
        on v.id_venda = vp.id_venda
        group by    v.id_venda,
                    v.id_usuario,
                    v.id_endereco,
                    v.data_venda,
                    u.nome_usuario,
                    e.cep,
                    e.estado,
                    e.cidade,
                    e.bairro,
                    e.logradouro,
                    e.numero,
                    e.complemento";

        $conexao = new Conexao();

        $dados = $conexao->executa_sql($sql);           
        return json_encode($dados);
    }

    public function get_venda($id){
        $sql = "
        select  v.id_venda,
                v.id_usuario,
                v.id_endereco,
                v.data_venda,
                u.nome_usuario,
                e.cep,
                e.estado,
                e.cidade,
                e.bairro,
                e.logradouro,
                e.numero,
                e.complemento,
                sum(vp.preco) as valor_total
        from tb_vendas v
        inner join tb_usuarios u
        on v.id_usuario = u.id_usuario
        inner join tb_enderecos e
        on v.id_endereco = e.id_endereco
        inner join tb_vendas_produtos vp
        on v.id_venda = vp.id_venda
        where v.id_venda = ?
        group by    v.id_venda,
                    v.id_usuario,
                    v.id_endereco,
                    v.data_venda,
                    u.nome_usuario,
                    e.cep,
                    e.estado,
                    e.cidade,
                    e.bairro,
                    e.logradouro,
                    e.numero,
                    e.complemento";

        $conexao = new Conexao();
        
        $types = 'i';
        $params = [$id];
        $dados = $conexao->executa_sql($sql,$types,$params);         
        return json_encode($dados);
    }

    public function get_vendas_user($user){
        $sql = "
        select  v.id_venda,
                v.id_usuario,
                v.id_endereco,
                v.data_venda,
                u.nome_usuario,
                e.cep,
                e.estado,
                e.cidade,
                e.bairro,
                e.logradouro,
                e.numero,
                e.complemento,
                sum(vp.preco) as valor_total
        from tb_vendas v
        inner join tb_usuarios u
        on v.id_usuario = u.id_usuario
        inner join tb_enderecos e
        on v.id_endereco = e.id_endereco
        inner join tb_vendas_produtos vp
        on v.id_venda = vp.id_venda
        where v.id_usuario = ?
        group by    v.id_venda,
                    v.id_usuario,
                    v.id_endereco,
                    v.data_venda,
                    u.nome_usuario,
                    e.cep,
                    e.estado,
                    e.cidade,
                    e.bairro,
                    e.logradouro,
                    e.numero,
                    e.complemento";
        $conexao = new Conexao();
        
        $types = 'i';
        $params = [$user];
        $dados = $conexao->executa_sql($sql,$types,$params);         
        return json_encode($dados);
    }
}