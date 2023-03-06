<?php

use Illuminate\Support\Facades\Route;

//LP
Route::get('/', [\App\Http\Controllers\Page\MemberController::class, 'showRegistForm'])->name('member.regist.showForm');
Route::post('/regist/confirm', [\App\Http\Controllers\Page\MemberController::class, 'registConfirm'])->name('member.regist.confirm');
Route::post('/regist/execution', [\App\Http\Controllers\Page\MemberController::class, 'registExecution'])->name('member.regist.execution');
Route::get('login', [\App\Http\Controllers\Page\MemberController::class, 'showLoginForm'])->name('member.showLoginFOrm');
Route::post('login', [\App\Http\Controllers\Page\MemberController::class, 'login'])->name('member.login');
Route::post('/verity/{paramater}/{limit}/{adress}', [\App\Http\Controllers\Page\MemberController::class, 'verityExecution'])->name('member.verity.execution');

// ログイン後
Route::prefix('member')->middleware('auth:member')->group(function(){

    //シナリオ管理
    Route::group(['prefix' => 'scenario'], function () {
        Route::get('list', [\App\Http\Controllers\Page\ScenarioController::class, 'getList'])->name('member.scenario.list');
        Route::get('/regist/form', [\App\Http\Controllers\Page\ScenarioController::class, 'registShowForm'])->name('member.scenario.regist.showForm');
        Route::post('/regist/confirm', [\App\Http\Controllers\Page\ScenarioController::class, 'registConfirm'])->name('member.scenario.regist.confirm');
        Route::post('/regist/execution', [\App\Http\Controllers\Page\ScenarioController::class, 'registExecution'])->name('member.scenario.regist.execution');
        Route::get('/edit/{scenario_id}', [\App\Http\Controllers\Page\ScenarioController::class, 'editShowForm'])->name('member.scenario.edit.showForm');
        Route::post('/edit/confirm', [\App\Http\Controllers\Page\ScenarioController::class, 'editConfirm'])->name('member.scenario.edit.confirm');
        Route::post('/edit/execution', [\App\Http\Controllers\Page\ScenarioController::class, 'editExecution'])->name('member.scenario.edit.execution');
        Route::post('delete', [\App\Http\Controllers\Page\ScenarioController::class, 'deleteExecution'])->name('member.scenario.delete.execution');
        Route::post('/verity/{paramater}/{limit}/{adress}', [\App\Http\Controllers\Page\ScenarioController::class, 'verityExecution'])->name('member.scenario.verity.execution');

        //アドレス登録回り
        Route::get('/{scenario_id}/recipient/list', [\App\Http\Controllers\Page\RecipientController::class, 'getList'])->name('member.recipient.list');
        Route::post('/{scenario_id}/recipient/list', [\App\Http\Controllers\Page\RecipientController::class, 'getList'])->name('member.recipient.search');
        Route::get('/{scenario_id}/recipient/regist/form', [\App\Http\Controllers\Page\RecipientController::class, 'registShowForm'])->name('member.recipient.regist.showForm');
        Route::post('/{scenario_id}/recipient/regist/execution', [\App\Http\Controllers\Page\RecipientController::class, 'registExecution'])->name('member.recipient.regist.execution');
        Route::get('/{scenario_id}/recipient/unsubscribe/form', [\App\Http\Controllers\Page\RecipientController::class, 'unsubscribeShowForm'])->name('member.recipient.unsubscribe.showForm');
        Route::post('/{scenario_id}/recipient/unsubscribe/execution', [\App\Http\Controllers\Page\RecipientController::class, 'unsubscribeExecution'])->name('member.recipient.unsubscribe.execution');
        Route::post('/{scenario_id}/recipient/delete/execution', [\App\Http\Controllers\Page\RecipientController::class, 'deleteExecution'])->name('member.recipient.delete.execution');

        //メール登録回り
        Route::get('/{scenario_id}/mail/list', [\App\Http\Controllers\Page\MailController::class, 'getList'])->name('member.mail.list');
        Route::post('/{scenario_id}/mail/list', [\App\Http\Controllers\Page\MailController::class, 'getList'])->name('member.mail.search');
        Route::get('/{scenario_id}/mail/regist/form', [\App\Http\Controllers\Page\MailController::class, 'registShowForm'])->name('member.mail.regist.showForm');
        Route::post('/{scenario_id}/mail/regist/confirm', [\App\Http\Controllers\Page\MailController::class, 'registConfirm'])->name('member.mail.regist.confirm');
        Route::post('/{scenario_id}/mail/regist/execution', [\App\Http\Controllers\Page\MailController::class, 'registExecution'])->name('member.mail.regist.execution');
        Route::get('/{scenario_id}/mail/edit/form/{mail_id}', [\App\Http\Controllers\Page\MailController::class, 'editShowForm'])->name('member.mail.edit.showForm');
        Route::post('/{scenario_id}/mail/edit/confirm', [\App\Http\Controllers\Page\MailController::class, 'editConfirm'])->name('member.mail.edit.confirm');
        Route::post('/{scenario_id}/mail/edit/execution', [\App\Http\Controllers\Page\MailController::class, 'editExecution'])->name('member.mail.edit.execution');
        Route::post('/{scenario_id}/mail/delete', [\App\Http\Controllers\Page\MailController::class, 'deleteExecution'])->name('member.mail.delete.execution');
    });
});

//member
// Route::get('/', function () {
//     return view('welcome');
// });
