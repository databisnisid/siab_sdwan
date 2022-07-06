<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BackOne;
use App\Models\Project;
use App\Models\ConnectionStatus;


class BackOneController extends BaseController
{
    public function index()
    {
        //ini_set('display_errors', 1);
        $google_data = [
        'MAPS_CENTER' => 'lat: -1.233982000061532, lng: 116.83728437200422',
        'GOOGLE_MAPS_API_KEY' => getenv('GOOGLE_MAPS_API_KEY')
        ];

    
        $bo = new BackOne();
        $project = new Project();
        $cs = new ConnectionStatus();
        $project_ids = $project->get_project_id_by_name();
        $data_all_project = [];
        foreach ($project_ids as $project_id) {
            $data_per_project = $bo->get_backone_by_project_id($project_id['id']);
            $data_all_project = array_merge($data_all_project, $data_per_project);
        }
        #print_r($project_ids);
        #print_r($project_ids[0]['id']);
        $data['data'] = $data_all_project;
        #$data['data'] = $bo->get_backone_by_project_id($project_ids[0]['id']);
        #print_r($data);
        $connection_status = $cs->get_all();
        $conn_stat = [];
        foreach($connection_status as $conn) {
            $conn_stat[$conn['id']] = $conn['name'];
        }
        $data['connection_status'] = $conn_stat;
        #var_dump($data['connection_status']);
        $data['google_data'] = $google_data;
        #exit();

        echo view('index', $data);

    }
}
