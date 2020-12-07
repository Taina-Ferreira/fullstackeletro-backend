<?php

class Conexao{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_fullstackeletro";
    private $port = 3306;
    public $is_connect = false;

    private $conn;

    function connect(){
        $this->conn = mysqli_connect ($this->servername,$this->username,$this->password,$this->database, $this->port);

        if (!$this->conn) {
            die ("A conexão falhou" . mysqli_connect_error());
        }
        $this->is_connect = true;
    }

    function executa_sql($sql,$types = NULL,$params = NULL){
        if (!$this->is_connect){
            $this->connect();
        }

        if ($params){
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
            
            if (strpos($sql,"nsert into")){
                if($stmt->execute()){
                    $result = true;
                }else{
                    $result = false;
                }
                $stmt->close();
                return $result;
            }else{
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }
        }else{
            if ($data = $this->conn->query($sql)){
                $dados = $data->fetch_all(MYSQLI_ASSOC);
                return $dados;
            }
            else {
                return mysqli_error($conn);
            }
        }
    }
}

