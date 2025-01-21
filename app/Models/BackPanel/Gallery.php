<?php

namespace App\Models\BackPanel;

use App\Models\Common;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }


    public function videos()
    {
        return $this->hasMany(GalleryVideo::class);
    }


    // Save
    public static function saveData($post)
    {
        try {
            $dataArray = [
                'name' => $post['name'],
                'slug' =>  Str::slug($post['name']) . '-' . time(),
            ];

            if (!empty($post['croppedImg'])) {
                $fileName =  Common::uploadCroppedImage('gallery-image', $post['croppedImg']);
                if (!$fileName) {
                    return false;
                }
                $dataArray['image'] = $fileName;
            } else {


                if (!empty($post['image'])) {
                    $fileName =  Common::uploadFile('gallery-image', $post['image']);
                    if (!$fileName) {
                        return false;
                    }
                    $dataArray['image'] = $fileName;
                }
            }
            if (!empty($post['id'])) {
                $dataArray['updated_at'] = Carbon::now();
                if (!Gallery::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update Records", 1);
                }
            } else {
                $dataArray['created_at'] = Carbon::now();
                if (!Gallery::insert($dataArray)) {
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
                $cond .= " and lower(name) like '%" . $get['columns'][1]['search']['value'] . "%'";

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }

            $query = Gallery::selectRaw("(SELECT count(*) FROM galleries where{$cond}) AS totalrecs, name,image, id as id")
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

    public static function getGalleryAll()
    {
        try {
            $result = Gallery::with('images', 'videos')->where('status', 'Y')->orderBy('id', 'DESC')->limit(2)->get();
            $dataArray = [];
            foreach ($result as $key => $val) {
                $data = [];
                $data['name'] = $val->name;
                $data['slug'] = $val->slug;
                $firstImage = null;
                $secondImage = null;
                if (!empty($val->images)) {
                    $countImage = count($val->images);
                    if ($countImage > 0) {
                        $firstImage = $val->images[0]->image;
                    }
                    $data['image_count'] = $countImage;
                    $data['first_image'] = !empty($firstImage) ? asset('storage/photo-gallery') . '/' . $firstImage : asset('frontpanel/no-image.jpg');
                } else {
                    $data['first_image'] = asset('frontpanel/no-image.jpg');
                    $data['image_count'] = 0;
                }
                if (!empty($val->videos)) {
                    $videoCount = count($val->videos);
                    if ($videoCount > 0) {
                        $secondImage = $val->videos[0]->photo;
                    }
                    $data['video_count'] = $videoCount;
                    $data['second_image'] = !empty($secondImage) ? asset('storage/video-gallery') . '/' . $secondImage : asset('frontpanel/no-image.jpg');
                } else {
                    $data['second_image'] = asset('frontpanel/no-image.jpg');
                    $data['video_count'] = 0;
                }
                $dataArray[] = $data;
            }
            return $dataArray;
        } catch (Exception $th) {
            throw $th;
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
            if (!Gallery::where(['id' => $post['id']])->update($updateArray)) {
                throw new Exception("Couldn't Restore Data. Please try again", 1);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
