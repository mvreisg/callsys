<?php
    require_once "../../conexao/Conexao.php";

    class Setor{
        private $id;
        private $nome;
        private $ativo;        
        
        public function __construct($id, $nome, $ativo){
            $this->id = $id;
            $this->nome = $nome;
            $this->ativo = $ativo;                                    
        }

        public function inserir(){
            $conexao = Conexao::get();        
            $insert = "insert into setor (nome, ativo) values ('{$this->nome}', {$this->ativo});";
            try{
                return $conexao->exec($insert);                
            }
            catch (PDOEXception $e){
                print $e;
            }
        }
    }