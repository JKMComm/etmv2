<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require_once 'DB_model.php';

final class Api_keys_model extends DB_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    protected $table      = 'api';
    protected $alias      = 'a';
    protected $identifier = 'apikey';

    protected function parseOptions(array $options = [])
    {
        return parent::parseOptions($options);
    }

    public function insertKey(string $key, string $vcode)
    {
        $this->db->query("INSERT IGNORE INTO api(apikey, vcode) VALUES ('$key', '$vcode')");
    }
}