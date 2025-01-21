<?php

namespace App\Http\Controllers\frontpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackPanel\TeamCategory;
use App\Models\BackPanel\TeamMember;
use Exception;
use Illuminate\Database\QueryException;

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
                'members' => $members,
                'uniqueYearIntervals' => $uniqueYearIntervals,
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
}
