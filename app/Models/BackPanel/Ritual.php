<?php

namespace App\Models\BackPanel;

use App\Models\Common;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class Ritual extends Model
{
    use HasFactory;


    public static function saveData($post)
    {
        try {
            $dataArray = [
                'title' => $post['title'],
                'slug' =>  Str::slug($post['title']) . '-' . time(),
                'details' => $post['details'],
                'order_number' => $post['order_number'],
                'video_link' => $post['video_link'],
            ];


            if (!empty($post['feature_images'][0])) {
                $imageNames = [];
                foreach ($post['feature_images'] as $image) {
                    $fileName = Common::uploadFile('ritual', $image);
                    if (!$fileName) {
                        return false;
                    }
                    $imageNames[] = $fileName;
                }
                if (empty($post['id'])) {
                    $imageNamesJson = json_encode($imageNames);
                    $dataArray['feature_image'] = $imageNamesJson;
                } else {
                    // $fetchOldData = Post::select('feature_image')->where('id', $post['id'])->first();//compare
                    // $oldData = json_decode($fetchOldData->documents);//compare
                    $postData = Ritual::where('id', $post['id'])->first();
                    $fetchOldData = json_decode($postData->feature_image);
                    if (isset($fetchOldData)) {
                        $dataArray['feature_image'] = json_encode(array_merge($fetchOldData, $imageNames));
                    } else {
                        $dataArray['feature_image'] = json_encode($imageNames);
                    }
                }
            }

            if (!empty($post['id'])) {


                $dataArray['updated_by'] = Auth::user()->id;
                $dataArray['updated_at'] = Carbon::now();

                if (!Ritual::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update Records", 1);
                }
            } else {
                $dataArray['created_by'] = $post['created_by'];
                $dataArray['created_at'] = Carbon::now();

                if (!Ritual::insert($dataArray)) {
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
                $cond .= " and lower(title) like '%" . $get['columns'][1]['search']['value'] . "%'";

            if ($get['columns'][2]['search']['value'])
                $cond .= " and lower(category) like '%" . $get['columns'][2]['search']['value'] . "%'";

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }

            $query = Ritual::selectRaw("(SELECT count(*) FROM rituals WHERE{$cond}) AS totalrecs, title, id as id, details,video_link, order_number")
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

    public static function deleteFeatureImage($post)
    {
        try {
            $postData = History::where('id', $post['id'])->first();
            $jsonArray = json_decode($postData->feature_image);
            $newArray = array_values(array_diff($jsonArray, [$post['feature_image']]));

            $filepath = storage_path('app/public/ritual');

            if (file_exists($filepath . '/' . $post['feature_image'])) {
                unlink($filepath . '/' . $post['feature_image']);
            }


            // Storage::delete('public/user-documents/'.$post['imgValue']);



            $postData->feature_image = json_encode($newArray);
            if (!$postData->update()) {
                throw new Exception("Error updating feature image");
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function deleteFeatureImageRitual($post)
    {
        try {
            $postData = Ritual::where('id', $post['id'])->first();
            $jsonArray = json_decode($postData->feature_image);
            $newArray = array_values(array_diff($jsonArray, [$post['feature_image']]));

            $filepath = storage_path('app/public/ritual');

            if (file_exists($filepath . '/' . $post['feature_image'])) {
                unlink($filepath . '/' . $post['feature_image']);
            }


            // Storage::delete('public/user-documents/'.$post['imgValue']);



            $postData->feature_image = json_encode($newArray);
            if (!$postData->update()) {
                throw new Exception("Error updating feature image");
            }
            return true;
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
            if (!Ritual::where(['id' => $post['id']])->update($updateArray)) {
                throw new Exception("Couldn't Restore Data. Please try again", 1);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
