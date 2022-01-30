<?php

namespace App\Db;

use \PDO;
use PDOException;
use PDOStatement;

class Database
{

    /** 
     * Host de conexão ao DB
     * @var string
     */
    const HOST = 'localhost';

    /** 
     * Nome de banco de dados
     * @var string
     */
    const NAME = 'crud_poo';

    /** 
     * User DB
     * @var string 
     */
    const USER = 'root';

    /** 
     * Password DB
     * @var string
     */
    const PASSWORD = '';

    /** 
     * Tabela a ser manipulada
     * @var string
     */
    private $table;

    /** 
     * Instancia de conexão com o banco de dados
     * @var PDO
     */
    private $connection;

    /** 
     * Define the table instance and connection
     * @var type
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /** 
     * Método responsável por criar a conexão com o DB
     * @var type
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Sempre lancar uma exception ao ocorrer qualquer erro
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /** 
     * Método responsável por executar querys no DB
     * @param string
     * @param array
     * @return PDOStatement
     */
    public function execute(string $query, array $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método responsável por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public function select(string $where = null, string $order = null, string $limit = null, string $fields = '*')
    {
        //DATA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //PREPARE
        $query = 'SELECT '.$fields.' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //EXEC
        return $this->execute($query);
    }

    /** 
     * Método responsável por inserir dados no banco
     * @var array $data [field => value]
     * @return integer ID inserido
     */
    public function insert(array $data)
    {
        //DATA QUERY
        $fields = array_keys($data);
        $binds = array_pad([], count($fields), '?'); // ISSO AQ É LINDO D+

        //PREPARE
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        //EXECUTE QUERY
        $this->execute($query, array_values($data));

        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

     /** 
     * Método responsável por atualizar dados no banco
     * @param string $where
     * @param array $values [field => value]
     * @return boolean
     */
    public function update($where, $values)
    {
        $fields = array_keys($values);

        //PREPARE
        $query = 'UPDATE '.$this->table. ' SET '.implode('=?,',$fields).'=? WHERE '. $where;
        
        //EXEC
        $this->execute($query, array_values($values));

        return true;
    }

    /** 
     * Método responsável por atualizar dados no banco
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        //PREPARE
        $query = 'DELETE FROM '.$this->table. ' WHERE '. $where;

        //EXEC
        $this->execute($query);

        //OUTPUT
        return true;
    }
}
