<?php

namespace App\Models\BackPanel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Exception;

class Certificate extends Model
{
    use HasFactory;
    // save
    public static function saveData($post)
    {
        try {
            // dd($post);
            $dataArray = [
                'title' => $post['title'],
                'order_number' => $post['order_number'],
            ];

            if (!empty($post['image'])) {
                $fileName = Common::uploadFile('certificate', $post['image']);
                if (!$fileName) {
                    return false;
                }
                $dataArray['image'] = $fileName;
            }

            if (!empty($post['id'])) {
                $dataArray['updated_at'] = Carbon::now();
                $dataArray['updated_by'] = Auth::user()->id;

                if (!Certificate::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update records", 1);
                }
            } else {
                $dataArray['created_at'] = Carbon::now();
                $dataArray['created_by'] = Auth::user()->id;

                if (!Certificate::insert($dataArray)) {
                    throw new Exception("Couldn't save records", 1);
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
            foreach ($get['columns'] as $key => $value) {
                $get['columns'][$key]['search']['value'] = trim(strtolower(htmlspecialchars($value['search']['value'], ENT_QUOTES)));
            }

            $cond = "status = 'Y'";

            if (!empty($post['type']) && $post['type'] === "trashed") {
                $cond = " status = 'R'";
            }

            if ($get['columns'][1]['search']['value'])
                $cond .= " and lower(title) like '%" . $get['columns'][1]['search']['value'] . "%'";

            // if ($get['columns'][2]['search']['value'])
            //     $cond .= " and lower(designation) like '%" . $get['columns'][2]['search']['value'] . "%'";

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }

            $query = Certificate::selectRaw("
            (SELECT count(*) FROM certificates WHERE {$cond}) AS totalrecs,
            id,
            title,
            order_number,
            image
        ")
                ->whereRaw($cond);

            if ($limit > -1) {
                $result = $query->orderBy('order_number', 'asc')->offset($offset)->limit($limit)->get();
            } else {
                $result = $query->orderBy('order_number', 'asc')->get();
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
            if (!Certificate::where(['id' => $post['id']])->update($updateArray)) {
                throw new Exception("Couldn't Restore Data. Please try again", 1);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
