<?php
    require_once "../../conexao/Conexao.php";

    class Setor{
        private $nome;
        private $ativo;
        private $dataHoraCadastro;
        
        public function __construct($nome, $ativo, $dataHoraCadastro){
            $this->nome = $nome;
            $this->ativo = $ativo;                        
            $this->dataHoraCadastro = $dataHoraCadastro;
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