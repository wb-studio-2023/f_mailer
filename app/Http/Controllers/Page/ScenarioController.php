<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Scenario;

class ScenarioController extends Controller
{
    //
    public function getList(Request $request) {
        
        parent::loginUserInfo();
        $mdScenario = new Scenario();
        $scenarioList = $mdScenario->getList($request);

        return view('member.scenario.list', 
                    compact(
                        'scenarioList',
                    )
                );
    }

    public function registShowForm(Request $request) {
        
        parent::loginUserInfo();
        return view('member.scenario.regist.form');
    }

    public function registConfirm(Request $request) {
        
        parent::loginUserInfo();
        
        $validated  = $request->validate([
            'adress' =>  'required|email:strict,dns|max:255|',
            'title' => ['required', 'string'],
            'title_flg' => ['required'],
        ],
        [
            'adress.required' => 'アドレスは必須です。',
            'adress.email' => '有効なアドレスを設定してください。',
            'adress.max:255' => 'アドレスは255文字以内で記入してください。',
            'title.required' => 'シナリオ名は必須です。',
            'title.string' => 'シナリオ名は文字列で記入してください。',
            'title_flg.required' => 'タイトル利用を選択してください。',
        ]);

        $inputData = $request->input();

        return view('member.scenario.regist.confirm', 
                    compact(
                        'inputData',
                    )
                );
    }

    public function registExecution(Request $request) {

        parent::loginUserInfo();
        $inputData = $request->input();
        $action = $request->input('action');

        if ($action !== 'submit') {
            return redirect()->route('member.scenario.regist.showForm')->withInput($inputData);
        } else {
            $request->session()->regenerateToken();
            $insertData = $inputData;
            $insertData['member_id'] = $request->id;

            $mdScenario = new Scenario;
            $mdScenario->insertData($insertData);
        }
        return redirect()->route('member.scenario.list');
    }

    public function editShowForm(Request $request) {
        
        parent::loginUserInfo();
        $mdScenario = new Scenario();
        $scenarioData = $mdScenario->getDataById($request);

        return view('member.scenario.edit.form', 
                    compact(
                        'scenarioData',
                    )
                );
    }

    public function editConfirm(Request $request) {
        
        parent::loginUserInfo();
        
        $validated  = $request->validate([
            'adress' =>  'required|email:strict,dns|max:255|',
            'title' => ['required', 'string'],
            'title_flg' => ['required'],
        ],
        [
            'adress.required' => 'アドレスは必須です。',
            'adress.email' => '有効なアドレスを設定してください。',
            'adress.max:255' => 'アドレスは255文字以内で記入してください。',
            'title.required' => 'シナリオ名は必須です。',
            'title.string' => 'シナリオ名は文字列で記入してください。',
            'title_flg.required' => 'タイトル利用を選択してください。',
        ]);

        $inputData = $request->input();

        return view('member.scenario.edit.confirm', 
                    compact(
                        'inputData',
                    )
                );
    }

    public function editExecution(Request $request) {

        parent::loginUserInfo();
        $inputData = $request->input();
        $action = $request->input('action');

        if ($action !== 'submit') {
            return redirect()->route('member.scenario.edit.showForm', ['scenario_id' => $inputData['scenario_id']])->withInput($inputData);
        } else {
            $mdScenario = new Scenario();
            $scenarioData = $mdScenario->getDataById($request);
            $request->session()->regenerateToken();
            $updateData = $inputData;
            $updateData['member_id'] = $request->id;
            $updateData['status'] = config('const.SCENARIO.STATUS.UNVERIFIED');
            if 
            (
                $scenarioData->status == config('const.SCENARIO.STATUS.VERIFIED') 
                && $scenarioData->adress == $request->adress
            ) {
                $updateData['status'] = config('const.SCENARIO.STATUS.VERIFIED');
            }

            $mdScenario = new Scenario;
            $mdScenario->updateData($updateData);
        }
        return redirect()->route('member.scenario.list');
    }


    public function deleteExecution(Request $request) {

        $deleteIds = $request->input('delete_id');

        $request->session()->regenerateToken();
        $mdScenario = new Scenario();
        $mdScenario->deleteData($deleteIds);
        return redirect()->route('member.scenario.list');
    }
}
