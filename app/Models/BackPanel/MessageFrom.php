<?php

namespace App\Models\BackPanel;

use App\Models\Common;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MessageFrom extends Model
{
    use HasFactory;

    public static function saveData($post)
    {
        try {
            $dataArray = [
                'name' => $post['name'],
                'title' => $post['title'],
                'message' => $post['message'],
                'slug' => Str::Slug($post['name']) . '-' . time(),
                'designation' => $post['designation'],
                'display_in_home' => !empty($post['display_in_home']) ? $post['display_in_home'] : 'N',
                'order' => $post['order'],
            ];

            if (!empty($post['image'])) {
                $fileName = Common::uploadFile('message-from', $post['image']);
                if (!$fileName) {
                    return false;
                }
                $dataArray['image'] = $fileName;
            }
            $dataArray['updated_at'] = Carbon::now();

            if (empty($post['id'])) {
                if (!MessageFrom::insert($dataArray)) {
                    throw new Exception("Could't save records", 1);
                }
            } else {

                if (!MessageFrom::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update Records", 1);
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
                $cond .= " and lower(name) like '%" . $get['columns'][1]['search']['value'] . "%'";

            if ($get['columns'][3]['search']['value'])
                $cond .= " and lower(designation) like '%" . $get['columns'][2]['search']['value'] . "%'";

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }

            $query = MessageFrom::selectRaw("(SELECT count(*) FROM message_froms WHERE{$cond})  AS totalrecs, name, id as id,message,designation,display_in_home,`order`, image,title")
                ->whereRaw($cond);

            if ($limit > -1) {
                $result = $query->orderBy('order', 'asc')->offset($offset)->limit($limit)->get();
            } else {
                $result = $query->orderBy('order', 'asc')->get();
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