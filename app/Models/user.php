<?php 

namespace App\Models;
use Core\Database;

class User { 
    private $table = "user";

    public function getAll() { // BUSCAR TODOS
        $db = Database::getInstance(); 
        return $db->getList($this->table, '*'); 
    }

    public function login($Email, $Password) { // ACESSAR LOGIN
        $db = Database::getInstance();
        $Email = filter_var($Email, FILTER_VALIDATE_EMAIL);                     

        $data = $db->getList($this->table, '*', ['email' => $Email]); 
        $user = $data[0];

        if(isset($user['id_User']) && password_verify($Password, $user['pass_word'])){ 
            unset($user['pass_word']);
            return $user;
        }
        return false;
    }

    public function accept($data = null){ // INSERIR DADOS 
        $db = Database::getInstance();
        
        if($data != null && !empty($data)){ 
            if(isset($data['Name']) && isset($data['Password'])) {
                if(filter_var($data['Email'], FILTER_VALIDATE_EMAIL)){
                    $data = [ 
                        'user_name' => $data['Name'], 
                        'email' => filter_var($data['Email'], FILTER_VALIDATE_EMAIL), 
                        'pass_word' => password_hash($data['Password'], PASSWORD_BCRYPT, ["cost" => 10]),
                    ]; 
                    return $db->insert($this->table, $data);
                }
            }
        }
        return false;
    }

    public function findBy($id){ // BUSCAR ID
        $db = Database::getInstance();
        $data = $db->getList($this->table, '*', ['id_User' => $id]); 

        return $data;
    }

    public function update($data, $condition) { // ATUALIZAR
        $db = Database::getInstance();
            
        return $db->update($this->table, $data, $condition);
    }

    public function delete(int $id) { // PAGAR  
        $db = Database::getInstance();
        return $db->delete($this->table, ['id_User' => $id]);
    }
}