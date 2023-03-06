<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Recipient extends Model
{
    use HasFactory;

    public function getList($arrayRequest)
    {
        $columnList = [
            "re.id",
            "re.member_id",
            "re.scenario_id",
            "re.adress",
            "re.name",
            "re.status",
            "re.delete_flg",
            "re.created_at",
            "re.updated_at",
        ];

        $query = DB::table('recipients as re');
        $query->select($columnList);

        $query->where('re.member_id', $arrayRequest['id'])
            ->where('re.scenario_id', $arrayRequest['scenario_id'])
            ->where('re.delete_flg', config('const.DELETE_FLG.OFF'));

        if (isset($arrayRequest['status'])) {
            $query->where('re.status', $arrayRequest['status']);
        }

        if (isset($arrayRequest['keyword'])) {
            $keyWord = '%' . addcslashes($arrayRequest['keyword'], '%_\\') . '%';
            $query
                ->where(function ($query) use ($keyWord) {
                    $query
                    ->orwhere('re.adress', 'like', $keyWord)
                    ->orwhere('re.name', 'like', $keyWord);
                });
        }

        $query->orderByDesc('re.updated_at');
        $retList = $query->paginate(config('const.RECIPIENT.LIST_PER_PAGE'));

        return $retList;
    }

    public function insertData($inputDataList)
    {

        foreach ($inputDataList as $inputData) {
            $query = DB::table('recipients');
            $query->updateOrInsert(
                [
                    'member_id' => $inputData['member_id'],
                    'scenario_id' => $inputData['scenario_id'],
                    'adress' => $inputData['adress'],
                ],
                [
                    'name' => $inputData['name'],
                    'delete_flg' => $inputData['delete_flg'],
                    'status' => $inputData['status'],
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function updateStatusData($inputDataList)
    {

        foreach ($inputDataList as $inputData) {
            $query = DB::table('recipients');
            $query->where([
                    'member_id' => $inputData['member_id'],
                    'scenario_id' => $inputData['scenario_id'],
                    'adress' => $inputData['adress'],
                ]);
            $value = [
                'status' => config('const.RECIPIENT.STATUS.UNSENDABLE'),
                'updated_at' => now(),
            ];
            $query->update($value);
        }
    }

    public function deleteData($deleteIds, $scenarioData)
    {
        $value = [
            'delete_flg' => config('const.DELETE_FLG.ON'),
            'updated_at' => now(),
        ];

        if (isset($deleteIds)) {
            $query = DB::table('recipients');
            $query->where([
                'member_id' => $scenarioData['member_id'],
                'scenario_id' => $scenarioData['scenario_id'],
            ]);
            $query->whereIn('id', $deleteIds);
            $query->update($value);
        }
    }
}
