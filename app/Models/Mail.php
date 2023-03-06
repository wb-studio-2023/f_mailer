<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Mail extends Model
{
    use HasFactory;

    public function getList($arrayRequest)
    {
        $columnList = [
            'ma.id',
            'ma.member_id',
            'ma.scenario_id',
            'ma.sender',
            'ma.sender_name',
            'ma.title',
            'ma.main',
            'ma.recipient_number',
            'ma.send_at',
            'ma.status',
            'ma.delete_flg',
            'ma.created_at',
            'ma.updated_at',
        ];

        $query = DB::table('mails as ma');
        $query->select($columnList);

        $query->where('ma.member_id', $arrayRequest['id'])
            ->where('ma.scenario_id', $arrayRequest['scenario_id'])
            ->where('ma.delete_flg', config('const.DELETE_FLG.OFF'));

        if (isset($arrayRequest['keyword'])) {
            $keyWord = '%' . addcslashes($arrayRequest['keyword'], '%_\\') . '%';
            $query
                ->where(function ($query) use ($keyWord) {
                    $query
                    ->orwhere('ma.title', 'like', $keyWord)
                    ->orwhere('ma.main', 'like', $keyWord);
                });
        }

        $query->orderByDesc('ma.updated_at');
        $retList = $query->paginate(config('const.RECIPIENT.LIST_PER_PAGE'));

        return $retList;
    }

    public function insertData($inputData, $mailData)
    {
        $query = DB::table('mails');
        $value = [
            'scenario_id' => $mailData->scenario_id,
            'member_id' => $mailData->id,
            'title' => $inputData['title'],
            'main' => $inputData['main'],
            'sender_name' => $inputData['sender_name'],
            'sender' => $inputData['sender'],
            'send_at' => $inputData['send_at'],
            'status' => $inputData['status'],
            'delete_flg' => config('const.DELETE_FLG.OFF'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $query->insert($value);
    }

    public function getDataById($request)
    {
        $columnList = [
            'ma.id',
            'ma.member_id',
            'ma.scenario_id',
            'ma.sender',
            'ma.sender_name',
            'ma.title',
            'ma.main',
            'ma.send_at',
            'ma.status',
            'ma.delete_flg',
            'ma.created_at',
            'ma.updated_at',
        ];

        $query = DB::table('mails as ma');

        $query->select($columnList);

        $query->where('ma.id', $request->mail_id)
            ->where('ma.member_id', $request->id)
            ->where('ma.scenario_id', $request->scenario_id)
            ->where('ma.delete_flg', config('const.DELETE_FLG.OFF'));

        $retrunData = $query->first();

        return $retrunData;
    }

    public function updateData($inputData, $mailData)
    {
        $value = [
            'title' => $inputData['title'],
            'main' => $inputData['main'],
            'sender_name' => $inputData['sender_name'],
            'send_at' => $inputData['send_at'],
            'status' => $inputData['status'],
            'updated_at' => now(),
        ];

        $query = DB::table('mails');
        $query->where('id', $inputData['mail_id'])
            ->where('member_id', $mailData->id)
            ->where('scenario_id', $mailData->scenario_id);
        $query->update($value);
    }

    public function deleteData($deleteIds, $mailData)
    {
        $value = [
            'delete_flg' => config('const.DELETE_FLG.ON'),
            'updated_at' => now(),
        ];

        if (isset($deleteIds)) {
            $query = DB::table('mails');
            $query->where('member_id', $mailData->id)
                ->where('scenario_id', $mailData->scenario_id);
            $query->whereIn('id', $deleteIds);
            $query->update($value);
        }
    }
}
