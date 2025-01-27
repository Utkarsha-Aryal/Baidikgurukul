<?php

namespace App\Models\BackPanel;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    public static function saveData($post)
    {
        try {
            $dataArray = [
                'year' => $post['year'],
                'details' => $post['details'],
                'order_number' => $post['order_number'],
            ];

            $dataArray['updated_at'] = Carbon::now();

            if (!empty($post['id'])) {
                if (!Timeline::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update Records", 1);
                }
            } else {
                if (!Timeline::insert($dataArray)) {
                    throw new Exception("Couldn't Save Records", 1);
                }
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // List
    public static function list($post)
    {
        try {
            $get = $post;

            $sorting = !empty($get['order'][0]['dir']) ? $get['order'][0]['dir'] : 'asc';

            $orderby = " order_number " . $sorting . "";

            if (!empty($get['order'][0]['column']) && $get['order'][0]['column'] == 6) {
                $orderby = " order_number " . $sorting . "";
            }

            foreach ($get['columns'] as $key => $value) {
                $get['columns'][$key]['search']['value'] = trim(strtolower(htmlspecialchars($value['search']['value'], ENT_QUOTES)));
            }
            $cond = " status = 'Y'";

            if (!empty($post['type']) && $post['type'] === "trashed") {
                $cond = " status = 'N'";
            }

            if ($get['columns'][1]['search']['value'])
                $cond .= " and lower(year) like '%" . $get['columns'][1]['search']['value'] . "%'";

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }

            $query = Timeline::selectRaw("(SELECT count(*) FROM timelines WHERE{$cond}) AS totalrecs, year,order_number, id as id, details")
                ->whereRaw($cond);

            if ($limit > -1) {
                $result = $query->orderByRaw($orderby)->offset($offset)->limit($limit)->get();
            } else {
                $result = $query->orderByRaw($orderby)->get();
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

    //restore
    public static function restoreData($post)
    {
        try {
            $updateArray = [
                'status' => 'Y',
                'updated_at' => Carbon::now(),
            ];
            if (!Timeline::where(['id' => $post['id']])->update($updateArray)) {
                throw new Exception("Couldn't Restore Data. Please try again", 1);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}