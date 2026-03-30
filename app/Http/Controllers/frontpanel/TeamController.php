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
    public function __construct()
    {
        parent::__construct();
    }

    public function members()
    {
        // Auto-pick latest interval (or accept from request)
        $intervalId = request('interval_id')
            ?? TimeInterval::query()->orderByDesc('id')->value('id');

        $categories = TeamCategory::where('status', 'Y')
            ->orderBy('order_number', 'asc')
            ->get();

        $timeIntervals = TimeInterval::where('status', 'Y')
            ->orderByDesc('id')
            ->get();

        return view('frontend.ourteam.index', compact('categories', 'timeIntervals', 'intervalId'));
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
            $teamcategory = TeamCategory::where('slug', $post['slug'])->first();
            if (!$teamcategory) {
                throw new Exception('Team category not found.');
            }
            $teamcategoryId = $teamcategory->id;

            $timeinterval = TimeInterval::where('year_interval', $post['yearInterval'])->first();
            if (!$timeinterval) {
                throw new Exception('Time interval not found.');
            }
            $timeintervalId = $timeinterval->id;

            $teammember = DB::table('team_members')
                ->join('time_intervals', 'time_intervals.id', '=', 'team_members.time_interval_id')
                ->join('team_categories', 'team_categories.id', '=', 'team_members.team_category_id')
                ->where('team_members.team_category_id', $teamcategoryId)
                ->where('team_members.time_interval_id', $timeintervalId)
                ->where('team_members.status', 'Y')
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
