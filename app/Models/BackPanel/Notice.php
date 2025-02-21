<?php

namespace App\Models\BackPanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Exception;

class Notice extends Model
{
    use HasFactory;
    // save
    public static function saveData($post)
    {
        try {
            $dataArray = [
                'title' => $post['title'],
                'order_number' => $post['order_number'],
                'start_date' => $post['start_date'],
                'end_date' => $post['end_date']
            ];

            // if (!empty($post['feature_images'][0])) {
            //     $imageNames = [];
            //     foreach ($post['feature_images'] as $image) {
            //         $fileName = Common::uploadFile('post', $image);
            //         if (!$fileName) {
            //             return false;
            //         }
            //         $imageNames[] = $fileName;
            //     }

            //     if (empty($post['id'])) {
            //         $imageNamesJson = json_encode($imageNames);
            //         $dataArray['feature_image'] = $imageNamesJson;
            //     } else {
            //         $postData = Notice::where('id', $post['id'])->first();
            //         $fetchOldData = json_decode($postData->feature_image);
            //         if (isset($fetchOldData)) {
            //             $dataArray['feature_image'] = json_encode(array_merge($fetchOldData, $imageNames));
            //         } else {
            //             $dataArray['feature_image'] = json_encode($imageNames);
            //         }
            //     }
            // }


            if (!empty($post['image'])) {
                $fileName = Common::uploadFile('notice', $post['image']);
                if (!$fileName) {
                    return false;
                }
                $dataArray['image'] = $fileName;
            }

            if (!empty($post['id'])) {
                $dataArray['updated_at'] = Carbon::now();
                $dataArray['updated_by'] = Auth::user()->id;

                if (!Notice::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update records", 1);
                }
            } else {
                $dataArray['created_at'] = Carbon::now();
                $dataArray['created_by'] = Auth::user()->id;

                if (!Notice::insert($dataArray)) {
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

            // if ($get['columns'][1]['search']['value'])
            //     $cond .= " and lower(name) like '%" . $get['columns'][1]['search']['value'] . "%'";

            // if ($get['columns'][2]['search']['value'])
            //     $cond .= " and lower(designation) like '%" . $get['columns'][2]['search']['value'] . "%'";

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }

            $query = Notice::selectRaw("
            (SELECT count(*) FROM notices WHERE {$cond}) AS totalrecs,
            id,
            start_date,
            end_date,
            status,
            order_number,
            title,
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
            if (!Notice::where(['id' => $post['id']])->update($updateArray)) {
                throw new Exception("Couldn't Restore Data. Please try again", 1);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
