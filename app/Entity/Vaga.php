<?php

namespace App\Entity;

use App\Db\Database;
use \Pdo;

class Vaga
{

    /** 
     * Identificador único da vaga
     * @var integer
     */
    public $id;

    /** 
     * Título da vaga
     * @var string
     */
    public $titulo;

    /** 
     * Descrição da vaga (pode conter html)
     * @var string
     */
    public $descricao;

    /** 
     * Define se a vaga é ativa
     * @var string(s/n)
     */
    public $ativo;

    /** 
     * Data de pubicação
     * @var string
     */
    public $data;

    /** 
     * Método responsável por obter as vagas
     * @param integer $id
     * @return Vaga
     */
    public static function getVaga($id)
    {
        return (new Database('vagas'))->select('id = ' . $id)
            ->fetchObject(self::class);
    }

    /** 
     * Método responsável por obter as vagas
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getVagas(string $where = null, string $order = null, string $limit = null)
    {
        return (new Database('vagas'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /** 
     * Método resposável por cadastrar nova vaga
     * @return boolean
     */
    public function cadastrar()
    {
        //DEFINE DATE
        $this->data = date('Y-m-d H:i:s');

        //INSERT
        $objDB = new Database('vagas');
        $this->id = $objDB->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);

        //OUTPUT
        return true;
    }

    /** 
     * Método resposável por atualizar vaga
     * @return boolean
     */
    public function atualizar()
    {
        return (new Database('vagas'))->update('id = '.$this->id,
        [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);
    }

    /** 
     * Método resposável por excluir vaga
     * @return boolean
     */
    public function excluir()
    {
        return (new Database('vagas'))->delete('id = '.$this->id);
    }
}
