<?php

namespace App\Models\BackPanel;

use App\Models\Common;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    public static function updatedata($post)
    {
        try {
            $updateArray = [
                'name' => $post['name'],
                'email' => $post['email'],
                'phone_number' => $post['phone_number'],
                'address' => $post['address'],
                'link_facebook' => $post['link_facebook'],
                'link_instagram' => $post['link_instagram'],
                'link_twitter' => $post['link_twitter'],
                'link_map' => $post['link_map'],
                'homepage_title' => $post['homepage_title'],
                'hmaepage_description' => $post['hmaepage_description'],
            ];

            if (!empty($post['croppedImg'])) {
                $fileName =  Common::uploadCroppedImage('setting', $post['croppedImg']);
                if (!$fileName) {
                    return false;
                }
                $updateArray['img_logo'] = $fileName;
            } else {

                if (!empty($post['img_logo'])) {
                    $fileName = Common::uploadFile('setting', $post['img_logo']);
                    if (!$fileName) {
                        return false;
                    }
                    $updateArray['img_logo'] = $fileName;
                }
            }


            if (!empty($post['croppedImgFavicon'])) {
                $fileName =  Common::uploadCroppedImage('setting', $post['croppedImgFavicon']);
                if (!$fileName) {
                    return false;
                }
                $updateArray['img_favicon'] = $fileName;
            } else {
                if (!empty($post['img_favicon'])) {
                    $fileName = Common::uploadFile('setting', $post['img_favicon']);
                    if (!$fileName) {
                        return false;
                    }
                    $updateArray['img_favicon'] = $fileName;
                }
            }

            //Home Page Banner Image
            if (!empty($post['img_banner_homepage'])) {
                $fileName = Common::uploadFile('setting', $post['img_banner_homepage']);
                if (!$fileName) {
                    return false;
                }
                $updateArray['img_banner_homepage'] = $fileName;
            }

            if ($post['img_banner_homepage']) {
                $prevoiusHomePageBanner = SiteSetting::find(1)->value('img_banner_homepage');

                // Deleting previous logo from serve 
                if (!empty($prevoiusHomePageBanner)) {
                    $prevoiusHomePageBannerPath = storage_path('/app/public/setting/') . $prevoiusHomePageBanner;
                    if (file_exists($prevoiusHomePageBannerPath)) {
                        unlink($prevoiusHomePageBannerPath);
                    }
                }
            }

            if ($post['img_logo']) {
                $previousLogo = SiteSetting::find(1)->value('img_logo');

                // Deleting previous logo from serve 
                if (!empty($previousLogo)) {
                    $previousLogoPath = storage_path('/app/public/setting/') . $previousLogo;
                    if (file_exists($previousLogoPath)) {
                        unlink($previousLogoPath);
                    }
                }
            }

            if ($post['img_favicon']) {
                $previousFavicon = SiteSetting::find(1)->value('img_favicon');

                // Deleting previous favicon from serve 
                if (!empty($previousFavicon)) {
                    $previousFaviconPath = storage_path('/app/public/setting/') . $previousFavicon;
                    if (file_exists($previousFaviconPath)) {
                        unlink($previousFaviconPath);
                    }
                }
            }

            $updateArray['updated_at'] = Carbon::now();

            if (!SiteSetting::where('id', 1)->update($updateArray)) {
                throw new Exception("Couldn't Save Records", 1);
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
