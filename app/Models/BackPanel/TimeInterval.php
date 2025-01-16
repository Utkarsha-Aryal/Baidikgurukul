<?php

namespace App\Models;

namespace App\Models\BackPanel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\Auth;

class TimeInterval extends Model
{
    use HasFactory;

    //function to show relation with member
    public function TeamTime()
    {
        return $this->hasMany(TeamMember::class);
    }

    //function to save team category
    public static function saveData($post)
    {
        try {
            $dataArray = [
                'start_date' => $post['start_date'],
                'end_date' => $post['end_date'],
                'year_interval' => $post['start_date'] . '-' . $post['end_date']
            ];

            if (!empty($post['id'])) {
                $dataArray['updated_by'] = Auth::user()->id;
                $dataArray['updated_at'] = Carbon::now();
                $dataArray['updated_at'] = Carbon::now();
                if (!TimeInterval::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update Records", 1);
                }
            } else {
                $dataArray['created_by'] = $post['created_by'];
                $dataArray['created_at'] = Carbon::now();
                if (!TimeInterval::insert($dataArray)) {
                    throw new Exception("Couldn't Save Records", 1);
                }
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    //function to list team category
    public static function list($post)
    {
        try {
            $get = $post;
            foreach ($get['columns'] as $key => $value) {
                $get['columns'][$key]['search']['value'] = trim(strtolower(htmlspecialchars($value['search']['value'], ENT_QUOTES)));
            }
            $cond = " status = 'Y'";

            if (!empty($post['type']) && $post['type'] === "trashed") {
                $cond = " status = 'R'";
            }

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }


            $query = TimeInterval::selectRaw("(SELECT count(*) FROM time_intervals WHERE{$cond}) AS totalrecs, start_date, id as id, end_date,year_interval")
                ->whereRaw($cond);


            if ($limit > -1) {
                $result = $query->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
            } else {
                $result = $query->orderBy('id', 'desc')->get();
            }
            if ($result) {
                $ndata = $result;
                $ndata['totalrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
                $ndata['totalfilteredrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            } else {
                $ndata = array();
            }
            return $ndata;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
