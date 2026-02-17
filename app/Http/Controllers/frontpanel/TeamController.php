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
    public function members()
{
    // ✅ auto-pick latest interval (or you can choose by request)
    $intervalId = request('interval_id') 
        ?? TimeInterval::query()->orderByDesc('id')->value('id');

    $categories = TeamCategory::query()
        ->with(['teamMembers' => function ($q) use ($intervalId) {
            $q->active()
              ->interval($intervalId)
              ->ordered();
        }])
        ->orderBy('id') // or order by a category_order column if you have it
        ->get()
        // ✅ remove empty categories (no members in that interval)
        ->filter(fn ($cat) => $cat->teamMembers->count() > 0);

    return view('frontend.ourteam.index', compact('categories', 'intervalId'));
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
