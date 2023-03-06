<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Query\JoinClause;

class Scenario extends Model
{
    use HasFactory;

    public function getList($request)
    {
        $columnList = [
            'sc.id',
            'sc.member_id',
            'sc.adress',
            'sc.title',
            'sc.status',
            'sc.delete_flg',
            'sc.created_at',
            'sc.updated_at',
            'scheduled_mail_number',
            'mail_number',
            'recipient_number',
        ];

        $query = DB::table('scenarios as sc');

        $query->select($columnList);

        //配信予定

        $smnQuery = DB::table('mails as smSub')
                ->where('smSub.status', config('const.MAIL.STATUS.WAITING'))
                ->where('smSub.send_at', '>', now())
                ->where('smSub.delete_flg', config('const.DELETE_FLG.OFF'))
                ->select('scenario_id', DB::raw('COUNT(smSub.id) AS scheduled_mail_number'))
                ->groupBy('scenario_id');

        $query->leftJoinSub($smnQuery, 'smSub', function (JoinClause $join): void {
            $join->on('sc.id', '=', 'smSub.scenario_id');
        });

        $mnQuery = DB::table('mails as mnSub')
                ->where('mnSub.delete_flg', config('const.DELETE_FLG.OFF'))
                ->select('scenario_id', DB::raw('COUNT(mnSub.id) AS mail_number'))
                ->groupBy('scenario_id');

        $query->leftJoinSub($mnQuery, 'mnSub', function (JoinClause $join): void {
            $join->on('sc.id', '=', 'mnSub.scenario_id');
        });

        $reQuery = DB::table('recipients as reSub')
                ->where('reSub.status', config('const.RECIPIENT.STATUS.SENDABLE'))
                ->where('reSub.delete_flg', config('const.DELETE_FLG.OFF'))
                ->select('scenario_id', DB::raw('COUNT(reSub.id) AS recipient_number'))
                ->groupBy('scenario_id');

        $query->leftJoinSub($reQuery, 'reSub', function (JoinClause $join): void {
            $join->on('sc.id', '=', 'reSub.scenario_id');
        });

        $query->where('sc.delete_flg', config('const.DELETE_FLG.OFF'))
            ->where('sc.member_id', $request->id);

        $query->orderByDesc('sc.updated_at')
            ->groupBy('sc.id');
            
        $retList = $query->paginate(config('const.MEMBER.LIST_PER_PAGE'));

        return $retList;
    }

    public function insertData($inputData)
    {
        $query = DB::table('scenarios');
        $value = [
            'adress' => $inputData['adress'],
            'member_id' => $inputData['member_id'],
            'title' => $inputData['title'],
            'title_flg' => $inputData['title_flg'],
            'status' => config('const.SCENARIO.STATUS.UNVERIFIED'),
            'delete_flg' => config('const.DELETE_FLG.OFF'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $query->insert($value);
    }

    public function getDataById($request)
    {
        $columnList = [
            'sc.id',
            'sc.member_id',
            'sc.adress',
            'sc.title',
            'sc.title_flg',
            'sc.status',
            'sc.delete_flg',
            'sc.created_at',
            'sc.updated_at',
        ];

        $query = DB::table('scenarios as sc');

        $query->select($columnList);

        $query->where('sc.id', $request->scenario_id)
            ->where('sc.member_id', $request->id)
            ->where('sc.delete_flg', config('const.DELETE_FLG.OFF'));

        $retrunData = $query->first();

        return $retrunData;
    }

    public function updateData($inputData)
    {

        $query = DB::table('scenarios');
        $value = [
            'adress' => $inputData['adress'],
            'title' => $inputData['title'],
            'title_flg' => $inputData['title_flg'],
            'status' => $inputData['status'],
            'updated_at' => now(),
        ];

        $query
            ->where('id', $inputData['scenario_id'])
            ->where('member_id', $inputData['id']);

        $query->update($value);
    }

    public function deleteData($deleteIds)
    {
        $value = [
            'delete_flg' => config('const.DELETE_FLG.ON'),
            'updated_at' => now(),
        ];

        if (isset($deleteIds)) {
            $query = DB::table('scenarios');
            $query->whereIn('id', $deleteIds);
            $query->update($value);
        }
    }
}
