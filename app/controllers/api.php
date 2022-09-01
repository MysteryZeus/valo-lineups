<?php

class Api extends Controller {
    public function search($map, $agent) {
        $conditions = [];
        $params = [];
        if (isset($agent) && $agent != 'ALL') {
            $conditions[] = "a.name=:agent";
            $params['agent'] = $agent;
        }
        if (isset($map) && $map != 'ALL') {
            $conditions[] = "m.name=:map";
            $params['map'] = $map;
        }
        $sql = 'SELECT description, image_position, image_aim, video_id FROM lineups
        INNER JOIN agents AS a ON a.id = agent_id
        INNER JOIN maps AS m ON m.id = map_id
        WHERE ' . implode(' AND ', $conditions) . ';';
    
        if (!Database::connect()) {
            echo Database::$exception->getMessage();
        }
        $results = Database::fetch($sql, $params, 'lineups');
    
        echo json_encode($results);
    }
}