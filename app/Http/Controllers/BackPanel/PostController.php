<?php

namespace App\Http\Controllers\BackPanel;

use App\Http\Controllers\Controller;
use App\Models\BackPanel\Post;
use App\Models\Common;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        return view('backend.post.index');
    }



    /* save */
    public function save(Request $request)
    {
        try {
            $rules = [
                'title' => 'required|min:5|max:255',
                'details' => 'required|min:5|max:5000',
            ];
            if (empty($request->id)) {
                $rules['image'] = 'required:mimes:jpg,jpeg,png:max:2048';
            }

            $message = [
                'title.required' => 'Please enter title',
                'details.required' => 'Please write in details',
            ];

            $validate = Validator::make($request->all(), $rules, $message);

            if ($validate->fails()) {
                throw new Exception($validate->errors()->first(), 1);
            }

            $post = $request->all();
            $type = 'success';
            $message = 'Records saved successfully';

            DB::beginTransaction();

            if (!Post::saveData($post)) {
                throw new Exception('Could not save record', 1);
            }
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $type = 'error';
            $message = $this->queryMessage;
        } catch (Exception $e) {
            DB::rollBack();
            $type = 'error';
            $message = $e->getMessage();
        }
        return json_encode(['type' => $type, 'message' => $message]);
    }

    // Get list
    public function list(Request $request)
    {
        try {
            $post = $request->all();
            $data = Post::list($post);
            $i = 0;
            $array = [];
            $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
            $totalrecs = $data["totalrecs"];

            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sno"] = $i + 1;
                $array[$i]["title"]    = Str::limit($row->title, 15, '...');
                $array[$i]["posted_by"]    = $row->postedBy->name;

                $array[$i]["details"]  =  strip_tags(Str::limit($row->details, 30, '...'));


                if (!empty($row->image)) {
                    $imagePath = storage_path('app/public/post/' . $row->image);

                    // Check if the file exists in the storage
                    if (file_exists($imagePath)) {
                        $imageUrl = asset('storage/post/' . $row->image);
                    } else {
                        $imageUrl = asset('no-image.jpg');
                    }
                } else {
                    $imageUrl = asset('no-image.jpg');
                }

                $array[$i]["image"] = '<img src="' . $imageUrl . '" height="30px" width="30px" alt="image"/>';

                $array[$i]["category"]  = $row->category;
                $array[$i]["event_date"]  = $row->event_date;
                $array[$i]["event_address"]  = Str::limit($row->event_address, 20, '...');

                $action = '';
                if (!empty($post['type']) && $post['type'] != 'trashed') {
                    $action .= ' <a href="javascript:;" class="view" title="View Data" data-id="' . $row->id . '"><i class="fa-solid fa-eye" style="color: #008f47;"></i></a> | ';

                    $action .= '<a href="javascript:;" class="editNews" title="Edit Data" data-id="' . $row->id . '"><i class="fa-solid fa-pen-to-square text-primary"></i></a> |';
                } else {
                    $action .= '<a href="javascript:;" class="restore" title="Restore Data" data-id="' . $row->id . '"><i class="fa-solid fa-undo text-success"></i></a> ';
                    $action .= '|';
                }
                $action .= ' <a href="javascript:;" class="deleteNews" title="Delete Data" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></a>';
                $array[$i]["action"]  = $action;
                $i++;
            }

            if (!$filtereddata) $filtereddata = 0;
            if (!$totalrecs) $totalrecs = 0;
        } catch (QueryException $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        } catch (Exception $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        }
        return json_encode(array("recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, "data" => $array));
    }

    //filled the form
    public function form(Request $request)
    {
        try {
            $data = [];
            if (!empty($request->id)) {
                $result = Post::where(['id' => $request->id, 'status' => 'Y'])->first();
                $data['id'] = $result->id;
                $data['title'] = $result->title;
                $data['details'] = $result->details;
                $data['category'] = $result->category;
                $data['event_date'] = $result->event_date;
                $data['event_address'] = $result->event_address;
                if ($result->image) {
                    $data['image'] = '<img src="' . asset('/storage/post') . '/' . $result->image . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                } else {
                    $data['image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                }
                if ($result->feature_image) {
                    $decodedFeatureImages = json_decode($result->feature_image, true);
                    $data['decodedFeatureImages'] = $decodedFeatureImages;
                    // if ($decodedFeatureImages !== null) {
                    //     $featureImagesHtml = '';
                    //     foreach ($decodedFeatureImages as $featureImage) {
                    //         // Assuming $featureImage contains the URL of each image
                    //         $featureImagesHtml .= '<img src="' . asset('/storage/post') . '/' . $featureImage . '" class="_feature-image imageThumb" alt="Feature Image"/>';
                    //     }
                    //     $data['feature_image'] = $featureImagesHtml;
                    // } else {
                    //     $data['feature_image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                    // }
                } else {
                    $data['feature_image'] = '<img src="' . asset('/no-image.jpg') . '" class="_image" height="160px" width="160px" alt="' . ' No image"/>';
                }
            }
        } catch (QueryException $e) {
            $data['error'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['error'] = $e->getMessage();
        }
        return view('backend.post.form', $data);
    }

    public function deleteFeatureImage(Request $request)
    {
        try {
            $type = "success";
            $message = "Successfully Deleted Feature Image";
            $post = $request->all();

            DB::beginTransaction();
            if (!Post::deleteFeatureImage($post)) {
                throw new Exception("Couldn't Delete Feature Image. Please Try Again", 1);
            }
            // $this->form($request);

            DB::commit();
        } catch (QueryException) {
            DB::rollBack();
            $type = "error";
            $message = $this->queryMessage();
        } catch (Exception $e) {
            DB::rollBack();
            $type = "error";
            $message = $e->getMessage();
        }
        return json_encode(['type' => $type, 'message' => $message]);
    }

    // Delete
    public function delete(Request $request)
    {
        try {
            $type = 'success';
            $message = "Record deleted successfully";
            $directory = storage_path('app/public/post');
            $post = $request->all();
            $class = new Post();

            DB::beginTransaction();
            if (!Common::deleteSingleData($post, $class, $directory)) {
                throw new Exception("Record does not deleted", 1);
            }
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $type = 'error';
            $message = $this->queryMessage;
        } catch (Exception $e) {
            DB::rollBack();
            $type = 'error';
            $message = $e->getMessage();
        }
        return json_encode(['type' => $type, 'message' => $message]);
    }

    //view
    public function view(Request $request)
    {
        try {
            $post = $request->all();
            $postDeatils = Post::where('id', $post['id'])
                ->where('status', 'Y')
                ->first();

            $data = [
                'postDeatils' => $postDeatils,
            ];

            $data['type'] = 'success';
            $data['message'] = 'Successfully fetched data of New and Blogs.';
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('backend.post.view', $data);
    }

    //restore
    public function restore(Request $request)
    {
        try {
            $post = $request->all();
            $type = 'success';
            $message = "Post restored successfully";
            DB::beginTransaction();
            $result = Post::restoreData($post);
            if (!$result) {
                throw new Exception("Could not restore Post. Please try again.", 1);
            }
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $type = 'error';
            $message = $this->queryMessage;
        } catch (Exception $e) {
            DB::rollBack();
            $type = 'error';
            $message = $e->getMessage();
        }
        return response()->json(['type' => $type, 'message' => $message]);
    }


    // Image upload of post
    public function uploadImage(Request $request)
    {
        try {
            $folder = storage_path('app/public/post/');

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder, 0775, true, true);
            }

            $file = $request->file('file');

            $newName = time() . '_' . rand(10, 9999999999999) . '_' . $file->getClientOriginalName();

            $file->move($folder, $newName);

            $url = asset('storage/post/' . $newName);
        } catch (Exception $e) {
            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => $e->getMessage()]
            ], 500);
        }

        return response()->json([
            'success' => true,
            'imageUrl' => $url
        ]);
    }


    //remove 
    public function deleteuploadImage(Request $request)
    {
        try {
            $request->validate([
                'image_path' => 'required|string',
            ]);

            $fileName = basename($request->input('image_path'));
            $filePath = public_path('storage/post/' . $fileName);


            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    return response()->json(['success' => true, 'message' => 'File deleted successfully.']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Failed to delete the file.']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'File not found.']);
            }
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
    }
}