<?php
class Data_model extends CI_Model {

    public function __construct()
    {
		$this->load->database();
    }

    public function get_cutover()
    {
    	$query = $this->db->order_by('timestamp', 'ASC')->get('cutover');

    	$result['fields'] = $query->list_fields();
    	$result['data'] = $query->result_array();

    	return $result;
    }

    public function get_transcription()
    {
        $query = $this->db->order_by('starttime','ASC')->order_by('endtime','ASC')->order_by('site','ASC')->order_by('ward','ASC')->get('transcription');
        return $query->result_array();
    }

    public function get_howto()
    {
        $query = $this->db->order_by('media','asc')->order_by('activity', 'asc')->order_by('name', 'asc')->get('howto');
        return $query->result_array();
    }

    public function get_readiness()
    {
    	$query = $this->db->get('readiness');
    	return $query->result_array();
    }

    public function get_ssc_qs() {
        $query = $this->db->select('*')->join('workflow-ans', 'workflow-qs.id = workflow-ans.qid')->order_by('workflow-qs.qlevel', 'asc')->get('workflow-qs');
        return $query->result_array();
    }

    public function get_ssc() {
        $query1 = $this->db->get('ssc-areas');

        $out = array();

        foreach ($query1->result_array() as $key1 => $value1) {
            $area = $value1;
            $query2 = $this->db->where('area_id', $area['id'])->get('ssc-segments');

            $area['segments'] = array();

            foreach ($query2->result_array() as $key2 => $value2) {
                $seg = $value2;

                $query3 = $this->db->where('segmentid', $seg['id'])->get('ssc-actionlinks');
                $links = $query3->result_array();

                $first = TRUE;
                foreach ($links as $key3 => $value3) {
                    if($first) $this->db->where('id', $value3['actionid']);
                    else $this->db->or_where('id', $value3['actionid']);
                    $first = FALSE;
                }
                $query4 = $this->db->get('ssc-actions');

                $seg['actions'] = $query4->result_array();

                $area['segments'][] = $seg;
            }

            $out[] = $area;
        }

        return $out;
    }

    public function load_qrgs()
    {
        $files = array_diff( scandir("assets/qrgs"), array(".", "..") );

        foreach ($files as $key => $value) {
            if(! preg_match("/.*\.pdf/", $value)) continue;

            $insert = array(
                'media' => 'Quick Guides',
                'activity' => 'Quick Reference Guides',
                'name' => preg_replace("/\.pdf/", "", preg_replace("/EPRQRG\d*\s*.\s*/", "", $value)),
                'link' => 'https://royalfree.info/assets/qrgs/'.$value
            );

            $matches = array();

            preg_match("/EPRQRG\d*\s*.\s*/", $value, $matches);
            $erpno = $matches[0];

            $query = $this->db->like('link', $erpno)->get('howto');
            if($query->num_rows() != 0) {
                $result = $query->row_array();
                $this->db->where('id', $result['id'])->update('howto', $insert);
            }
            else {
                $this->db->insert('howto', $insert);
            }

        }

        return $files;
    }
}