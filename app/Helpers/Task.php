<?php

namespace App\Helpers;

use App\Models\Classroom;

class Task {

    public static function filterClassroom($task_classrooms){
        $tasks = [];

        foreach($task_classrooms as $tc){
            $tasks[] = $tc->classroom_id;
        }

        $data = Classroom::whereNotIn('id', $tasks)->orderBy('name')->get();
        return $data;
    }

}

?>
