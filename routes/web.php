<?php
    Auth::routes();
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    // ------------------ Fund Infomations -------------------
    Route::resource('/fund','FundInformationController');

    // ------------------ Personnel Login -------------------
    Route::get('personnel-login', 'Auth\PersonnelLoginController@showLoginForm');
    Route::post('personnel-login', ['as'=>'personnel-login','uses'=>'Auth\PersonnelLoginController@login']);

    // ------------------ Member Login -------------------
    Route::get('member-login', 'Auth\MemberLoginController@showLoginForm');
    Route::post('member-login', ['as'=>'member-login','uses'=>'Auth\MemberLoginController@login']);

    // ------------------ Personnel & Member Logout -------------------
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\PersonnelLoginController@logout']);

    // ------------------ Change Password Personnel & Member -------------------
    Route::resource('/pw_mem','PassMemberController');
    Route::resource('/pw_per','PassPersonnelController');

    // ------------------ Show Profile Personnel & Member -------------------
    Route::get('/showProfilePer/{id}','ShowProfilePersonnelController@index');
    Route::get('/showProfileMem/{id}','ShowProfileMemberController@index');

    // ------------------ Main All User -------------------
    Route::get('/mAdmin', 'MainAdminController@mAdmin');
    Route::get('/mOfficer', 'MainOfficerController@mOfficer');
    Route::get('/mBoard', 'MainBoardController@mBoard');
    Route::get('/mMember', 'MainMemberController@mMember');

    // ------------------ Member Manage -------------------
    Route::resource('/mem','MemberController');
    Route::get('/search_mem','MemberController@search');
    Route::get('/autocomplete/fetchMem','MemberController@fetchMem')->name('autocomplete.fetchMem');

    // ------------------ Village Manage -------------------
    Route::resource('/vil','VillageController');

    // ------------------ MemberType Manage -------------------
    Route::resource('/mtype','MemberTypeController');
    Route::get('/mtype/destroy/{id}', [
        'uses' => 'MemberTypeController@destroy',
        'as' => 'mtype.destroy',
    ]);

    // ------------------ Personnel Manage -------------------
    Route::resource('/per','PersonnelController');
    Route::get('/search_per','PersonnelController@search');
    Route::get('/autocomplete/fetchPer','PersonnelController@fetchPer')->name('autocomplete.fetchPer');
    Route::get('/download/{path}/{filename}','PersonnelController@download');

    // ------------------ Position Fund Manage -------------------
    Route::resource('/posfund','PositionFundController');
    Route::get('/posfund/destroy/{id}', [
        'uses' => 'PositionFundController@destroy',
        'as' => 'posfund.destroy',
    ]);

    // ------------------ Position Com Manage -------------------
    Route::resource('/poscom','PositionComController');
    Route::get('/poscom/destroy/{id}', [
        'uses' => 'PositionComController@destroy',
        'as' => 'poscom.destroy',
    ]);

    // ------------------ Account Manage -------------------
    Route::resource('/ac','AccountController');
    Route::get('/search_ac','AccountController@search');
    Route::get('/autocomplete/fetchAc','AccountController@fetchAc')->name('autocomplete.fetchAc');
    Route::get('/ac/destroy/{id}', [
        'uses' => 'AccountController@destroy',
        'as' => 'ac.destroy',
    ]);

    // ------------------ Group Account Manage -------------------
    Route::resource('/gc','GroupAccController');
    Route::get('/gc/destroy/{id}', [
        'uses' => 'GroupAccController@destroy',
        'as' => 'gc.destroy',
    ]);

    // ------------------ Benefit Manage -------------------
    Route::resource('/ben','BenefitController');
    Route::get('/search_ben','BenefitController@search');
    Route::get('/autocomplete/fetch','BenefitController@fetch')->name('autocomplete.fetch');
    Route::get('/autocomplete/fetchBen','BenefitController@fetchBen')->name('autocomplete.fetchBen');
    Route::get('/ben/destroy/{id}', [
        'uses' => 'BenefitController@destroy',
        'as' => 'ben.destroy',
    ]);

    // ------------------ Benefit type Manage -------------------
    Route::resource('/btype','BenefitTypeController');

    // ------------------ Benefit History For Member -------------------
    Route::get('hisBenefit/{id}','BenefitMemberController@index');

    // ------------------ Complaint -------------------
    Route::resource('/comp','ComplaintForMemController');
    Route::get('/search_comp','ComplaintForOfficerController@search');
    Route::resource('/comp_view','ComplaintForOfficerController');

    // ------------------ Report All User -------------------
    Route::get('/reAlluserMem', 'ReportAllUserController@reAllMem');
    Route::get('/reOldMem', 'ReportAllUserController@reOldMem');

    // ------------------ Report Board Officer -------------------
    Route::get('/reBenefit', 'ReportController@reBenefit');
    Route::get('/reAccount','ReportController@reAccount');
    Route::get('/reBenMonth', 'ReportController@reBenMonth');

    // ------------------ PDF Member -------------------
    Route::get('pdfProMem/{id}','PdfExportMemberController@pdfProMem');
    Route::get('pdfBenMem/{id}','PdfExportMemberController@pdfBenMem');

    // ------------------ PDF Admin Officer -------------------
    Route::get('pdfmem/{id}','PdfExportAdminOfficerController@pdfmem');

    // ------------------ PDF Board Officer -------------------
    Route::get('/pdfreportBenefit/{std}/{end}','PdfExportBoardOfficerController@pdfreportBenefit');
    Route::get('/pdfreportAccount/{std}/{end}','PdfExportBoardOfficerController@pdfreportAccount');
    Route::get('/pdfBenMonth','PdfExportBoardOfficerController@pdfBenMonth');

    // ------------------ PDF ADmin Board Officer -------------------
    Route::get('/pdfmemall','PdfExportAdminBoardOfficerController@pdfmemall');
    Route::get('/pdfper','PdfExportAdminBoardOfficerController@pdfper');
    Route::get('/pdfreportmemall','PdfExportAdminBoardOfficerController@pdfreportmemall');
    Route::get('/pdfoldmem','PdfExportAdminBoardOfficerController@pdfoldmem');

?>
