<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\TeamCategory;
use App\Models\BackPanel\TeamMember;
use App\Models\BackPanel\TimeInterval;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function ourteam($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];

            $teamcategory = TeamCategory::where('slug', $slug)->first();

            $teamcategoryId = $teamcategory->id;

            $members = TeamMember::with('timeInterval')
                ->where('status', 'Y')
                ->where('team_category_id', $teamcategoryId)
                ->orderBy('id', 'desc')
                ->get();

            $uniqueYearIntervals = $members->map(function ($member) {
                return $member->timeInterval->year_interval;
            })->unique()->values();

            $data = [
                // 'members' => $members,
                'uniqueYearIntervals' => $uniqueYearIntervals,
                'type' => $type,
                'message' => $message,
                'slug' => $slug
            ];
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }

        return view('frontend.ourteam.index', $data);
    }

    public function teaminner($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $member = TeamMember::where('slug', $slug)->first();
            $data = [
                'member' => $member,
                'type' => $type,
                'message' => $message
            ];
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('frontend.ourteam.inner', $data);
    }

    public function teamyear($slug)
    {
        try {
            $type = 'success';
            $message = 'Successfully fetched data';
            $data = [];
            $member = TeamMember::where('slug', $slug)->first();
            $data = [
                'member' => $member,
                'type' => $type,
                'message' => $message
            ];
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $e->getMessage();
        }
        return view('frontend.ourteam.inner', $data);
    }


    public function getTabContent(Request $request)
    {
        try {
            $post = $request->all();
            $type = 'success';
            $message = 'Successfully fetched data';

            $data = [];
            $teamcategory = TeamCategory::where('slug',  $post['slug'])->first();
            $teamcategoryId = $teamcategory->id;
            $timeinterval = TimeInterval::where('year_interval',  $post['yearInterval'])->first();
            $timeintervalId = $timeinterval->id;

            $teammember = DB::table('team_members')
            ->join('time_intervals', 'time_intervals.id', '=', 'team_members.time_interval_id')
            ->join('team_categories', 'team_categories.id', '=', 'team_members.team_category_id')
            ->where('team_members.team_category_id', $teamcategoryId)
                ->where('team_members.time_interval_id', $timeintervalId)
                ->selectRaw('team_members.name,team_members.photo,team_members.slug,team_members.designation')
                ->orderBy('team_members.order', 'asc')  
                ->get();

            $html = view('frontend.ourteam.tabConctent', compact('teammember'))->render();

            $data = [
                'type' => $type,
                'message' => $message,
                'html' => $html
            ];
        } catch (QueryException $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
            $data['html'] = '<p>An error occurred while fetching the data.</p>';
        } catch (Exception $e) {
            $data['type'] = 'error';
            $data['message'] = $this->queryMessage;
            $data['html'] = '<p>An error occurred while processing your request.</p>';
        }
        return response()->json($data);
    }
}
