<?

class Sort {
    private $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    public function makeSortForId($table, $id) {
        $res = $this->db->query("select max(sort) as max_sort from ".$table);
        $arr = $res->fetchAll();
        $maxSort = intval($arr[0]['max_sort']);

        $this->db->update($table, array(
            'sort' => ($maxSort+1)
        ), array(
            'id = ' .  $id
        ));
    }
    public function moveFirst($table, $id) {
        // check if isser sort vith value 1
        $res = $this->db->query("select * from ".$table." where sort = 1");
        $arr = $res->fetchAll();
        if (count($arr) and $arr[0]['sort'] == 1) {
            $res = $this->db->query("update ".$table." set sort = sort + 1");
        }
        // move
        $this->db->update($table, array('sort' => 1),  array('id = ' . $id));
    }
    public function movePrew($table, $id, $where='') {
        // fetch sort val for id
        $res = $this->db->query("select * from ".$table." where id = ".$id);
        $arr = $res->fetchAll();
        $firstId  = $id;
        $firstVal = intval($arr[0]['sort']);
        if ($firstVal) {
            // fetch prev id
            $res = $this->db->query("select * from ".$table." where sort < " . $firstVal. " " . $where . " order by sort desc limit 1");
            $arr = $res->fetchAll();
            if (count($arr)) {
                $secondId  = $arr[0]['id'];
                $secondVal = $arr[0]['sort'];
                // move
                $this->db->update($table, array('sort' => $secondVal), array('id = ' . $firstId));
                $this->db->update($table, array('sort' => $firstVal),  array('id = ' .$secondId));
            }
        }
    }
    public function moveNext($table, $id, $where='') {
        // fetch sort val for id
        $res = $this->db->query("select * from ".$table." where id = ".$id);
        $arr = $res->fetchAll();
        $firstId  = $id;
        $firstVal = intval($arr[0]['sort']);
        if ($firstVal) {
            // fetch prev id
            $res = $this->db->query("select * from ".$table." where sort > ".$firstVal. " " . $where . " order by sort asc limit 1");
            $arr = $res->fetchAll();
            if (count($arr)) {
                $secondId  = $arr[0]['id'];
                $secondVal = $arr[0]['sort'];
                // move
                $this->db->update($table, array('sort' => $secondVal), array('id = ' . $firstId));
                $this->db->update($table, array('sort' => $firstVal),  array('id = ' .$secondId));
            }
        }
    }
    public function moveLast($table, $id) {
        // fetch max sort value
        $res = $this->db->query("select max(sort) as max_sort from ".$table);
        $arr = $res->fetchAll();
        $maxSort = intval($arr[0]['max_sort']);
        // move
        $this->db->update($table, array('sort' => ($maxSort+1)), array('id = ' .$id));
    }
}