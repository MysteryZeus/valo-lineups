<?php

class Home extends Controller {
    public function index($map='ALL', $agent='ALL') {        
        $conditions = [];
        $params = [];
        $results = [];
        if (isset($agent) && $agent != 'ALL') {
            $conditions[] = "a.name=:agent";
            $params['agent'] = $agent;
        }
        if (isset($map) && $map != 'ALL') {
            $conditions[] = "m.name=:map";
            $params['map'] = $map;
        }
        if (count($conditions) > 0) {
            $sql = 'SELECT description, image_position, image_aim, video_id FROM lineups
            INNER JOIN agents AS a ON a.id = agent_id
            INNER JOIN maps AS m ON m.id = map_id
            WHERE ' . implode(' AND ', $conditions) . ';';
        
            if (!Database::connect()) {
                echo Database::$exception->getMessage();
            }
            $results = Database::fetch($sql, $params, 'lineups');
            if (count($results) > 0) {
                $this->view('home/lineups', ['lineups' => $results, 'map' => $map, 'agent' => $agent]);
                return;
            }
        }
        $this->view('home/index');
    }
}