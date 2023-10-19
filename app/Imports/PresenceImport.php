<?php

namespace App\Imports;

use App\Models\AttadanceTime;
use App\Models\Presence;
use App\Models\User;
use App\Models\WorkingDay;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\ToModel;

class PresenceImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Presence([
    //         //
    //     ]);
    // }

    public function collection(Collection $rows){
        foreach($rows as $row){
            $user = User::whereNoId($row[0])->first();

            if($user){
                $exp = explode('/', $row[2]);
                $date = $exp[2] . '-' . $exp[1] . '-' . $exp[0];
                $presence = Presence::create([
                    'no_id' => $row[0],
                    'date' => $date,
                    'entry_time' => $row[3],
                    'exit_time' => $row[4],
                    'check_in' => $row[5],
                    'check_out' => $row[6],
                    'normal' => $row[7],
                    'riil' => $row[8],
                ]);

                AttadanceTime::create([
                    'presence_id' => $presence->id,
                    'late' => $row[9],
                    'leave_early' => $row[10],
                    'absent' => $row[11] ? true : false,
                    'overtime' => $row[12],
                    'total_work_hours' => $row[13]
                ]);

                WorkingDay::create([
                    'presence_id' => $presence->id,
                    'normal_day' => $row[15],
                    'weekend' => $row[15],
                    'holiday' => $row[15],
                    'total_presence' => $row[15],
                    'overtime_on_normal_days' => $row[15],
                    'weekend_overtime' => $row[15],
                    'holiday_overtime' => $row[15],
                ]);
            }
        }
    }
}
