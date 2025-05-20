<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Factura_model extends CI_Model
{
    protected $table = 'phppos_facturas';
use saleTrait;
    public function __construct()
    {
        parent::__construct();
    }

    /** Inserta un nuevo registro y devuelve su ID local */
    public function insert(array $data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /** Busca un registro local por api_id */
    public function get_by_api_id($api_id)
    {
        return $this->db
            ->where('api_id', $api_id)
            ->get($this->table)
            ->row_array();
    }

    /** Actualiza el estado de la factura local */
    public function update_estado($id, $estado)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, ['estado' => $estado]);
    }

    /** Marca que el PDF ya se generó */
    public function mark_pdf_generated($id)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, ['pdf_generado' => 1]);
    }
}
