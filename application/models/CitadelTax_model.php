<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class CitadelTax_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generates autocomplete results for Citadel searches
     * @param  string $input [description]
     * @return array        
     */
    public function queryCitadels(string $input): array
    {
        $this->db->select('name as value');
        $this->db->where('eve_idstation > 1000000000000');
        $this->db->like('name', $input);
        $this->db->limit('10');
        $query  = $this->db->get('station');
        $result = $query->result_array();

        return $result;
    }

    /**
     * Returns a citadel's ID by name if exists
     * @param  string $name 
     * @return string      
     */
    public function getCitadelID(string $name): string
    {
        $this->db->where('name', $name);
        $query = $this->db->get('station');
        if ($query->num_rows() == 0) {
            return false;
        }

        return $query->row()->eve_idstation;
    }

    /**
     * Sets the tax for a particular character and citadel.
     * Returns true if successful
     * @param string $citadel_id   
     * @param int    $character_id 
     * @param float  $tax       
     * @return bool   
     */
    public function setTax(string $citadel_id, int $character_id, float $tax): bool
    {
        $data = ["station_eve_idstation" => $citadel_id,
            "character_eve_idcharacter"  => $character_id,
            "value"                      => $tax];

        $query = $this->db->replace('citadel_tax', $data);

        if ($query) {
            return true;
        }

        return false;
    }

    /**
     * Returns all entered taxes for this character
     * @param  int    $character_id 
     * @return array              
     */
    public function taxList(int $character_id): array
    {
        $this->db->select('s.name, t.value, t.idcitadel_tax');
        $this->db->from('citadel_tax t');
        $this->db->join('station s', 's.eve_idstation = t.station_eve_idstation');
        $this->db->where('t.character_eve_idcharacter', $character_id);
        $query  = $this->db->get('');
        $result = $query->result_array();

        return $result;
    }

    /**
     * Removes ane tax for this character. 
     * Returns true if successful
     * @param  int    $tax_id 
     * @return bool         
     */
    public function removeTax(int $tax_id): bool
    {
        $this->db->where('idcitadel_tax', $tax_id);
        $this->db->delete('citadel_tax');

        if ($this->db->affected_rows() != 0) {
            return true;
        }
        return false;
    }
}
