
<?php
require_once(APPPATH . "traits/saleTrait.php");
require_once(APPPATH . "models/cart/PHPPOSCartSale.php");


class Factura_model extends MY_Model
{
    // Quítale la propiedad $table y usa el nombre literal:
    // protected $table = 'siat_factura';   <— ya no la necesitas

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Appconfig');
    }

    public function guardar_o_actualizar(array $data)
    {
        if (empty($data['idPuntoVenta']) || empty($data['numeroFactura'])) {
            return;
        }

        // Usa el nombre literal 'siat_factura' igual que tu Sucursal_model
        $this->db->where('idPuntoVenta', $data['idPuntoVenta']);
        $this->db->where('numeroFactura', $data['numeroFactura']);
        $existe = $this->db->get('siat_factura')->row();

        if ($existe) {
            $this->db->update(
                'siat_factura',
                $data,
                ['idPuntoVenta'  => $data['idPuntoVenta'], 'numeroFactura' => $data['numeroFactura']]
            );
        } else {
            $this->db->insert('siat_factura', $data);
        }
    }

    public function obtener_todas()
    {
        return $this->db->get('siat_factura')->result();
    }
}
