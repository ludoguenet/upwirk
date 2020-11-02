<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ConversationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/home', [ProposalController::class, 'home'])->name('home');

    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversation/{conversation}', [ConversationController::class, 'show'])->name('conversation.show');

    Route::get('/confirmProposal/{proposal}', [ConversationController::class, 'confirm'])->name('confirm.proposal');
});

Route::group(['middleware' => ['auth', 'proposal']], function () {
    Route::get('/proposals/{jobId}', [ProposalController::class, 'submit'])->name('proposals.submit');
    Route::post('/proposals/{jobId}', [ProposalController::class, 'submitStore'])->name('proposals.submit.store');
});
