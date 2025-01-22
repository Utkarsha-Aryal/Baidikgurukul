<?php

namespace App\Models\BackPanel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Common;
use Carbon\Carbon;
use Exception;

// $news = !empty($post['gallery_video_id']) ? GalleryVideo::where(['id' => $post['gallery_video_id'], 'status' => 'Y'])->first() : new GalleryVideo;
// $news->video_url = $post['video'];
// $news->gallery_id = $post['gallery_id'];


class GalleryVideo extends Model
{
    use HasFactory;

    public function videoGallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id')->where('status', 'Y');
    }
    // save
    public static function saveData($post)
    {
        try {
            $dataArray = [
                'gallery_id' => $post['gallery_id'],
                'video_url' => $post['video'],

            ];
            if (!empty($post['image'])) {
                $fileName =  Common::uploadFile('community', $post['image']);
                if (!$fileName) {
                    return false;
                }
                $dataArray['video_image'] = $fileName;
            }
            if (!empty($post['gallery_video_id'])) {
                $dataArray['updated_at'] = Carbon::now();
                if (!GalleryVideo::where('id', $post['gallery_video_id'])->update($dataArray)) {
                    throw new Exception("Couldn't update Records", 1);
                }
            } else {
                $dataArray['created_at'] = Carbon::now();
                if (!GalleryVideo::insert($dataArray)) {
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
            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }
            $query = GalleryVideo::selectRaw("(SELECT COUNT(*) FROM gallery_videos WHERE status = 'Y') AS totalrecs, id as gallery_video_id, video_url,video_image")->where(['gallery_id' => $get['gallery_id'], 'status' => 'Y']);
            if ($limit > -1) {
                $query = $query->orderBy('id', 'DESC')->offset($offset)->limit($limit);
            } else {
                $query = $query->orderBy('id', 'DESC');
            }
            $result = $query->get();
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