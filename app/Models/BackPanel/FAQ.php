<?php


namespace App\Models\BackPanel;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    //function to save testimonial
    public static function saveData($post)
    {
        try {
            $dataArray = [
                'question' => $post['question'],
                'order_number' => $post['order_number'],
                'answer' => $post['answer'],
            ];


            if (!empty($post['id'])) {
                $dataArray['updated_by'] = Auth::user()->id;
                $dataArray['updated_at'] = Carbon::now();
                if (!FAQ::where('id', $post['id'])->update($dataArray)) {
                    throw new Exception("Couldn't update Records", 1);
                }
            } else {
                $dataArray['created_at'] = Carbon::now();
                $dataArray['created_by'] = $post['created_by'];
                if (!FAQ::insert($dataArray)) {
                    throw new Exception("Couldn't Save Records", 1);
                }
            }

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    //function to list testimonial
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
                $cond .= " and lower(question) like '%" . $get['columns'][1]['search']['value'] . "%'";

            $limit = 15;
            $offset = 0;
            if (!empty($get["length"]) && $get["length"]) {
                $limit = $get['length'];
                $offset = $get["start"];
            }
            $query = FAQ::selectRaw("(SELECT count(*) FROM f_a_q_s) AS totalrecs, answer, id as id, question, order_number")
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

    //function to restore testimonial
    public static function restoreData($post)
    {
        try {
            $updateArray = [
                'status' => 'Y',
                'updated_at' => Carbon::now(),
            ];
            if (!FAQ::where(['id' => $post['id']])->update($updateArray)) {
                throw new Exception("Couldn't Restore Data. Please try again", 1);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
