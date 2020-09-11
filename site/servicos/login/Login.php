<?php     
    require_once "../../servicos/conexao/Conexao.php";    

    class Login {        
        private $usuario;
        private $senha;

        public function __construct($usuario, $senha){
            $this->usuario = $usuario;
            $this->senha = $senha;
        }

        public function podeLogar() {
            $conexao = Conexao::get();
            try{
                $select = "select * from usuario where usuario = '$this->usuario' and senha = '$this->senha';";
                $query = $conexao->query($select);                                 
                //retorna a quantidade de linhas encontradas
                return $query->rowCount() > 0;                
            }
            catch(PDOException $e){
                print $e;                
            }
        }
    }
?>