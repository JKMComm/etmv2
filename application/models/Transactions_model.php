<?php declare(strict_types=1);
ini_set('mysql.connect_timeout', '3000');
ini_set('default_socket_timeout', '3000');
ini_set('max_execution_time', '0');
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Transactions_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTransactionList(string $chars, int $interval, int $new = null, string $transID = null, bool $res = true)
    {
        $this->db->select('t.idbuy as transaction_id,
            t.time as time,
            t.quantity as quantity,
            t.price_unit as price_unit,
            t.price_total as price_total,
            t.transaction_type as type,
            c.name as character_name,
            s.name as station_name,
            t.transkey as transkey,
            t.client as client,
            i.name as item_name,
            i.eve_iditem as item_id,
            tp.transactionID as proc');
        $this->db->from('transaction t');
        $this->db->join('characters c', 'c.eve_idcharacter = t.character_eve_idcharacter');
        $this->db->join('item i', 'i.eve_iditem = t.item_eve_iditem', 'left');
        $this->db->join('station s', 's.eve_idstation = t.station_eve_idstation', 'left');
        $this->db->join('transaction_processed tp', 'tp.transactionID = t.idbuy', 'left');
        
        if(!$transID) {
            $this->db->where('t.character_eve_idcharacter IN ' . $chars);
            $this->db->where("t.time>= (now() - INTERVAL " . $interval . " DAY)");
        }
        $this->db->order_by("t.time DESC");

        if ($new > 0) {
            $this->db->limit($new);
        }
        if ($transID) {
            $this->db->where('idbuy', $transID);
        }
        if(!$res) {
            $this->db->limit(0);
        }

        $query = $this->db->get();
        $count = $query->num_rows();

        $result = $query->result();
        $data   = array("result" => $result, "count" => $count);
        return $data;
    }

    public function unlinkTransaction($transaction_id)
    {
        $this->db->select('character_eve_idcharacter as c');
        $this->db->where('idbuy', $transaction_id);
        $query        = $this->db->get('transaction');
        $character_id = $query->row()->c;

        $data = array("transactionID" => $transaction_id,
            "characters_eve_idcharacters" => $character_id);

        $sql = $this->db->insert_string('transaction_processed', $data) . ' ON DUPLICATE KEY UPDATE transactionID=transactionID';
        $this->db->query($sql);
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        return false;
    }

}
