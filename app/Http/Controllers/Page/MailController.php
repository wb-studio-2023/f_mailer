<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Mail;
use \App\Models\Scenario;
use Common;

class MailController extends Controller
{
    //
    public function getList(Request $request) {
        
        parent::loginUserInfo();
        $arrayRequest = [
            'id' => $request->id,
            'scenario_id' => $request->scenario_id,
            'keyword' => $request->input('keyword'),
        ];

        $mdMail = new Mail();
        $mailList = $mdMail->getList($request);

        // ページャーURLに引数追加
        if ($mailList->isNotEmpty()) {
            $mailList->appends($arrayRequest);
        }

        $queryString = '&keyword=' . $arrayRequest['keyword'];

        return view('member.mail.list', 
                    compact(
                        'arrayRequest',
                        'queryString',
                        'mailList',
                    )
                );
    }

    public function registShowForm(Request $request) {
        
        parent::loginUserInfo();
        $mdScenario = new Scenario();
        $scenarioData = $mdScenario->getDataById($request);

        return view('member.mail.regist.form', 
                    compact(
                        'scenarioData',
                    )
                );
    }

    public function registConfirm(Request $request) {

        parent::loginUserInfo();

        if ($request->status == config('const.MAIL.STATUS.WAITING')) {
            $validated  = $request->validate([
                'sender_name' => 'required',
                'title' => 'required',
                'main' => 'required',
                'send_year' => 'required',
                'send_month' => 'required',
                'send_day' => 'required',
                'send_hour' => 'required',
                'send_minute' => 'required',
            ],
            [
                'sender_name.required' => '件名を入力してください',
                'title.required' => '件名を入力してください',
                'main.required' => '本文を入力してください',
                'send_year.required' => '送信年を入力してください',
                'send_month.required' => '送信月を入力してください',
                'send_day.required' => '送信日を入力してください',
                'send_hour.required' => '送信時間を入力してください',
                'send_minute.required' => '送信分を入力してください',
            ]);
        }

        $inputData = $request->input();

        $mdScenario = new Scenario();
        $scenarioData = $mdScenario->getDataById($request);

        return view('member.mail.regist.confirm', 
                    compact(
                        'inputData',
                        'scenarioData',
                    )
                );
    }

    public function registExecution(Request $request) {

        parent::loginUserInfo();

        $inputData = $request->input();
        $action = $request->input('action');

        if ($action !== 'submit') {

            return redirect()->route('member.mail.regist.showForm', ['scenario_id' => $request->scenario_id])->withInput($inputData);

        } else {

            $request->session()->regenerateToken();
            $insertData = $inputData;
            //公開開始時間
            $insertData['send_at'] = $inputData['send_year']. '-' . $inputData['send_month'] . '-' . $inputData['send_day'] . ' ' . $inputData['send_hour'] . ':' . $inputData['send_minute'];
            $mdScenario = new Scenario();
            $scenarioData = $mdScenario->getDataById($request);
            $insertData['sender'] = $scenarioData->adress;
            $mdMail = new Mail;
            $mdMail->insertData($insertData, $request);

        }
        return redirect()->route('member.mail.list', ['scenario_id' => $request->scenario_id]);
    }

    public function editShowForm(Request $request) {
        
        parent::loginUserInfo();

        $mdScenario = new Scenario();
        $scenarioData = $mdScenario->getDataById($request);
        $mdMail = new Mail();
        $mailData = $mdMail->getDataById($request);
        $dateData = Common::dateTImeDivide($mailData->send_at);
        $mailData->send_year = $dateData['year'];
        $mailData->send_month = $dateData['month'];
        $mailData->send_day = $dateData['day'];
        $mailData->send_hour = $dateData['hour'];
        $mailData->send_minute = $dateData['minute'];

        return view('member.mail.edit.form', 
                    compact(
                        'scenarioData',
                        'mailData',
                    )
                );
    }

    public function editConfirm(Request $request) {

        parent::loginUserInfo();

        if ($request->status == config('const.MAIL.STATUS.WAITING')) {
            $validated  = $request->validate([
                'sender_name' => 'required',
                'title' => 'required',
                'main' => 'required',
                'send_year' => 'required',
                'send_month' => 'required',
                'send_day' => 'required',
                'send_hour' => 'required',
                'send_minute' => 'required',
            ],
            [
                'sender_name.required' => '件名を入力してください',
                'title.required' => '件名を入力してください',
                'main.required' => '本文を入力してください',
                'send_year.required' => '送信年を入力してください',
                'send_month.required' => '送信月を入力してください',
                'send_day.required' => '送信日を入力してください',
                'send_hour.required' => '送信時間を入力してください',
                'send_minute.required' => '送信分を入力してください',
            ]);
        }

        $inputData = $request->input();
        $inputData['mail_id'] = $request->mail_id;

        $mdScenario = new Scenario();
        $scenarioData = $mdScenario->getDataById($request);

        return view('member.mail.edit.confirm', 
                    compact(
                        'inputData',
                        'scenarioData',
                    )
                );
    }

    public function editExecution(Request $request) {

        parent::loginUserInfo();

        $inputData = $request->input();
        $action = $request->input('action');

        if ($action !== 'submit') {

            return redirect()->route('member.mail.edit.showForm', ['scenario_id' => $request->scenario_id, 'mail_id' => $request->mail_id])->withInput($inputData);

        } else {

            $request->session()->regenerateToken();
            $insertData = $inputData;
            //公開開始時間
            $insertData['send_at'] = $inputData['send_year']. '-' . $inputData['send_month'] . '-' . $inputData['send_day'] . ' ' . $inputData['send_hour'] . ':' . $inputData['send_minute'];
            $mdScenario = new Scenario();
            $scenarioData = $mdScenario->getDataById($request);
            $insertData['sender'] = $scenarioData->adress;
            $mdMail = new Mail;
            $mdMail->updateData($insertData, $request);

        }
        return redirect()->route('member.mail.list', ['scenario_id' => $request->scenario_id]);
    }

    public function deleteExecution(Request $request) {

        parent::loginUserInfo();

        $deleteIds = $request->input('delete_id');

        $request->session()->regenerateToken();
        $mdMail = new Mail;
        $mdMail->deleteData($deleteIds, $request);
        return redirect()->route('member.mail.list', ['scenario_id' => $request->scenario_id]);
    }
}
