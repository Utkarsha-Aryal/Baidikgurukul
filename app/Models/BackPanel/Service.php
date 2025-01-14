<?php

namespace App\Models\BackPanel;

use App\Models\Common;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    public static function saveData($post)
    {
        try {
            $dataArray = [
                'title' => $post['title'],
                'order' => $post['order'],
                'slug' =>  Str::slug($post['title']) . '-' . time(),
                // 'icon' => $post['icon'],
                'details' => $post['details'],
            ];

            if (!empty($post['croppedImg'])) {

                $fileName =  Common::uploadCroppedImage('service', $post['croppedImg']);
                if (!$fileName) {
                    return false;
                }
                $dataArray['thumbnail_image'] = $fileName;
            } else {
                if (!empty($post['thumbnail_image'])) {
                    $fileName =  Common::uploadFile('service', $post['thumbnail_image']);
                    if (!$fileName) {
                        return false;
                    }
                    $dataArray['thumbnail_image'] = $fileName;
                }
            }
            if (!empty($post['feature_image'])) {
                $fileName =  Common::uploadFile('service', $post['feature_image']);
                if (!$fileName) {
                    return false;
                }
                $dataArray['feature_image'] = $fileName;
            }


            if (!empty($post['id'])) {
                $dataArray['updated_at'] = Carbon::now();
                if (!Service::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update Records", 1);
                }
            } else {
                $dataArray['created_at'] = Carbon::now();
                if (!Service::insert($dataArray)) {
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
            foreach ($get['columns'] as $key => $value) {
                $get['columns'][$key]['search']['value'] = trim(strtolower(htmlspecialchars($value['search']['value'], ENT_QUOTES)));
            }
            $cond = " status = 'Y'";
            if (!empty($post['type']) && $post['type'] === "trashed") {
                $cond = " status = 'N'";
            }

            if ($get['columns'][1]['search']['value'])
                $cond .= " and lower(title) like '%" . $get['columns'][1]['search']['value'] . "%'";

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }

            $query = Service::selectRaw("(SELECT count(*) FROM services) AS totalrecs, title, id as id, details,`order`, thumbnail_image, feature_image, created_at")
                ->whereRaw($cond);

            if ($limit > -1) {
                $result = $query->orderBy('order', 'ASC')->offset($offset)->limit($limit)->get();
            } else {
                $result = $query->orderBy('order', 'ASC')->get();
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
