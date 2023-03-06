<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Recipient;

class RecipientController extends Controller
{
    //
    public function getList(Request $request) {
        
        parent::loginUserInfo();
        $arrayRequest = [
            'id' => $request->id,
            'scenario_id' => $request->scenario_id,
            'keyword' => $request->input('keyword'),
            'status' => $request->input('status'),
        ];

        $mdRecipient = new Recipient();
        $recipientList = $mdRecipient->getList($request);

        // ページャーURLに引数追加
        if ($recipientList->isNotEmpty()) {
            $recipientList->appends($arrayRequest);
        }

        $queryString = '&keyword=' . $arrayRequest['keyword'] . '&status=' . $arrayRequest['status'];

        return view('member.recipient.list', 
                    compact(
                        'arrayRequest',
                        'queryString',
                        'recipientList',
                    )
                );
    }

    public function registShowForm(Request $request) {
        
        parent::loginUserInfo();
        return view('member.recipient.regist.form', 
                    compact(
                        'request',
                    )
                );
    }

    public function registExecution(Request $request) {
        
        parent::loginUserInfo();
        $recipientDataList = [];
        $lineList = explode("\n", $request->adress);
        if (isset($lineList)) {
            foreach ($lineList as $key => $line) {
                $lineData = explode("\t", $line);
                var_dump($lineData[0]);
                if (isset($lineData[0])) {
                    //アドレス
                    $recipientDataList[$key] = [
                        'member_id' => $request->id,
                        'scenario_id' => $request->scenario_id,
                        'adress' => preg_replace('/\r/', '', $lineData[0]),
                        'name' => null,
                        'delete_flg' => config('const.DELETE_FLG.OFF'),
                        // 'delete_flg' => 'config',
                        'status' => config('const.RECIPIENT.STATUS.SENDABLE'),
                    ];
                    //名前
                    if (isset($lineData[1]) && preg_replace('/　|\s+/', '', $lineData[1]) !== '') {
                        $recipientDataList[$key]['name'] = preg_replace('/\r/', '', $lineData[1]);
                    }
                }
            }
        }
        $mdRecipient = new Recipient;
        $mdRecipient->insertData($recipientDataList);

        return redirect()->route('member.recipient.list', ['scenario_id' => $request->scenario_id]);
    }

    public function unsubscribeShowForm(Request $request) {
        
        parent::loginUserInfo();

        return view('member.recipient.unsubscribe.form', 
                    compact(
                        'request',
                    )
                );
    }

    public function unsubscribeExecution(Request $request) {
        
        parent::loginUserInfo();
        $recipientDataList = [];
        $lineList = explode("\n", $request->adress);
        if (isset($lineList)) {
            foreach ($lineList as $key => $line) {
                $lineData = explode("\t", $line);
                if (isset($lineData[0])) {
                    //アドレス
                    $recipientDataList[$key] = [
                        'member_id' => $request->id,
                        'scenario_id' => $request->scenario_id,
                        'adress' => preg_replace('/\r/', '', $lineData[0]),
                        'status' => config('const.RECIPIENT.STATUS.UNSENDABLE'),
                    ];
                }
            }
        }
        $mdRecipient = new Recipient;
        $mdRecipient->updateStatusData($recipientDataList);

        return redirect()->route('member.recipient.list', ['scenario_id' => $request->scenario_id]);
    }

    public function deleteExecution(Request $request) {

        parent::loginUserInfo();
        $deleteIds = $request->input('delete_id');
        $scenarioData['member_id'] = $request->id;
        $scenarioData['scenario_id'] = $request->scenario_id;
        $request->session()->regenerateToken();
        $mdRecipient = new Recipient;
        $mdRecipient->deleteData($deleteIds, $scenarioData);
        return redirect()->route('member.recipient.list', ['scenario_id' => $request->scenario_id]);
    }
}
