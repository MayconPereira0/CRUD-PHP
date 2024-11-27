<?php

class Database{
    public $conn;
    public string $local="10.38.0.50";
    public string $db="crudphp";
    public string $user = "devweb";
    public string $password = "suporte@22";
    public $table;

    public function __construct($table = null){
        $this->table = $table;
        $result = $this->conecta();
    }

    public function conecta(){
        try {
            $this->conn = new PDO("mysql:host=".$this->local.";dbname=$this->db",$this->user,$this->password); 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //echo "Conectado com Sucesso!!";
        } catch (PDOException $err) {
            //retirar msg em produção
            die("Connection Failed: " . $err->getMessage());
        }
    }

    
    public function execute($query,$binds = []){
        //BINDS = parametros
        try{
            $stmt = $this->conn->prepare($query);
            $stmt->execute($binds);
            return $stmt;
        }catch (PDOException $err) {
            //retirar msg em produção
            die("Connection Failed " . $err->getMessage());
        }
    }

    public function insert($values){
        //DEBUG
        //echo "<pre>";print_r($values);echo "</pre>";
        //Dados query $fields=campos $binds=parametros
        $fields = array_keys($values);
        //$data = array_values($values); TESTE DE RECEBIMENTO
        $binds = array_pad([],count($fields),'?');

        //Montar query
        $query = 'INSERT INTO ' . $this->table .'  (' .implode(',',$fields). ') VALUES (' .implode(',',$binds).')';
        //DEBUG para saber se está montando a query corretamente
        // print_r($query);
        // print_r(array_values($values));
        
        //Método para executar a Query
        $result = $this->execute($query,array_values($values));
        
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function select($where = null, $order = null, $limit = null, $fields = '*'){
            //montando query
        $where = strlen($where) ? 'WHERE' . $where : '';
        $order = strlen($order) ? 'WHERE' . $order : '';
        $limit = strlen($limit) ? 'WHERE' . $limit : '';

        $query  = 'SELECT '.$fields. ' FROM ' .$this->table. ''.$where;
        //SELECT FROM PESSOA
        return $this->execute($query);
    }
}
