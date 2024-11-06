<?php

Route::get('/cache',function(){
   Artisan::call('cache:clear');
});

Route::get('/view',function(){
   Artisan::call('view:clear');
});
Route::get('/config',function(){
   Artisan::call('config:cache');
});
Route::get('/route',function(){
   Artisan::call('route:clear');
});

Route::get('cron', 'PaymentController@cron');

Route::get('/', 'HomeController@index');
Route::get('/admin', 'AdminAuth\LoginController@showLoginForm');
Route::post('/get/ref/id', 'FontendController@getRefId')->name('get.ref.id');
Route::post('/get/position', 'FontendController@getPosition')->name('get.user.position');
Route::post('/forgot/password', 'FontendController@forgotPass')->name('forget.password.user');
Route::get('/reset/{token}', 'FontendController@resetLink')->name('reset.passlink');
Route::post('/reset/password', 'FontendController@passwordReset')->name('reset.passw');
Route::get('pagenotfound', 'FontendController@pageNotFound')->name('pagenot.found');

//Authorization
Route::get('/authorization', 'FontendController@authorization')->name('authorization');
Route::post('/sendemailver', 'FontendController@sendemailver')->name('sendemailver');
Route::post('/emailverify', 'FontendController@emailverify')->name('emailverify');
Route::post('/sendsmsver', 'FontendController@sendsmsver')->name('sendsmsver');
Route::post('/smsverify', 'FontendController@smsverify')->name('smsverify');
Route::post('/g2fa-verify', 'FontendController@verify2fa')->name('go2fa.verify');


Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'AdminAuth\LoginController@login');

    Route::middleware(['admin'])->group(function () {

        Route::put('update/unilevel/com', 'GeneralController@univelUpdate')->name('unilevel.commission.update');

        Route::get('background/images', 'GeneralController@backgroundImage')->name('background.image.index');
        Route::put('background/images/update', 'GeneralController@backgroundImageUpdate')->name('image.background.update');

        Route::get('referral/view', 'AdminController@refView')->name('ref.amount.total');
        Route::get('subtract/admin', 'AdminController@subtractAdmin')->name('admin.subtract.view');
        Route::get('generate/admin', 'AdminController@generateAdmin')->name('admin.generate.view');
        Route::get('send/money/{id}', 'AdminController@sendMoneyView')->name('user.total.send.money');
        Route::get('withdraw/view/{id}', 'AdminController@withDrawView')->name('user.total.withdraw');
        Route::get('add/fund/view/{id}', 'AdminController@depositView')->name('user.total.deposit');
        Route::get('transaction/view/{id}', 'AdminController@transView')->name('user.total.trans');
        Route::get('transfer/balance', 'AdminController@transBalanceLog')->name('index.transfer.user');
        Route::get('add/fund/user', 'AdminController@depositLog')->name('index.deposit.user');
        Route::get('deactive/user', 'AdminController@deactiveUser')->name('index.deactive.user');
        Route::get('paid/user', 'AdminController@paidUser')->name('paid.user.index');
        Route::get('free/user', 'AdminController@freeUser')->name('free.user.index');
        Route::get('leader/user', 'AdminController@userLeaderIndex')->name('leader.user.index');

        Route::GET('user/search', 'AdminController@userSearch')->name('username.search');
        Route::GET('user/search/email', 'AdminController@userSearchEmail')->name('email.search');

        Route::get('match', 'AdminController@matchIndex')->name('match.index');

        Route::post('/users/amount/{id}', 'AdminController@indexBalanceUpdate')->name('user.balance.update');
        Route::get('/users/send/mail/{id}', 'AdminController@userSendMail')->name('user.mail.send');
        Route::post('/send/mail/{id}', 'AdminController@userSendMailUser')->name('send.mail.user');
        Route::get('/users/balance/{id}', 'AdminController@indexUserBalance')->name('add.subs.index');
        Route::get('/users/detail/{id}', 'AdminController@indexUserDetail')->name('user.view');
        Route::put('/users/update/{id}', 'AdminController@userUpdate')->name('user.detail.update');

        Route::get('/tree/image', 'GeneralController@indexTreeImage')->name('user.tree.image');
        Route::put('/tree/image/update', 'GeneralController@updateTreeImage')->name('tree.image.update');

        Route::get('/template', 'AdminController@indexEmail')->name('email.index.admin');
        Route::post('/template-update', 'AdminController@updateEmail')->name('template.update');

        //Sms Api
        Route::get('/sms-api', 'AdminController@smsApi')->name('sms.index.admin');
        Route::post('/sms-update', 'AdminController@smsUpdate')->name('sms.update');

        Route::get('/withdraw/method', 'AdminController@indexWithdraw')->name('add.withdraw.method');
        Route::post('/withdraw/store', 'AdminController@storeWithdraw')->name('store.withdraw.method');
        Route::put('/withdraw/update/{id}', 'AdminController@updateWithdraw')->name('update.method');

        Route::get('/withdraw/requests', 'AdminController@requestWithdraw')->name('withdraw.request.index');
        Route::get('/withdraw/details/{id}', 'AdminController@detailWithdraw')->name('withdraw.detail.user');
        Route::post('/withdraw/update/{id}', 'AdminController@repondWithdraw')->name('withdraw.process');

        Route::get('/withdraw/log', 'AdminController@showWithdrawLog')->name('withdraw.viewlog.admin');

        //Depositos manuales
        Route::get('/deposit/requests', 'AdminController@requestDeposit')->name('deposit.request.index');
        Route::get('/deposit/details/{id}', 'AdminController@detailDeposit')->name('deposit.detail.user');
        Route::post('/deposit/update/{id}', 'AdminController@repondDeposit')->name('deposit.process');

        Route::get('/supports', 'TicketController@indexSupport')->name('support.admin.index');
        Route::get('/support/reply/{ticket}', 'TicketController@adminSupport')->name('ticket.admin.reply');
        Route::post('/reply/{ticket}', 'TicketController@adminReply')->name('store.admin.reply');

        Route::get('users', 'AdminController@usersIndex')->name('user.manage');

        Route::get('footer', 'FooterController@footerIndex')->name('footer.content');
        Route::put('footer_update/{id}', 'FooterController@footerUpdate')->name('footer.update');

        Route::get('/about', "GeneralController@indexAbout")->name('about.admin.index');
        Route::put('/about/update/{id}', "GeneralController@updateAbout")->name('about.admin.update');

        Route::get('/general', "GeneralController@index")->name('general.index');
        Route::put('/general-update/{id}', "GeneralController@update")->name('general.update');

        Route::get('/charge/commission', "GeneralController@indexCommision")->name('charge.commission');
        Route::put('/charge/commission/{id}', "GeneralController@UpdateCommision")->name('commission.update');

        Route::get('logo/icon', 'LogoController@logoIndex')->name('logo.icon');
        Route::put('logo_update', 'LogoController@updateLogo')->name('logo.update');
        Route::put('icon_update', 'LogoController@updateIcon')->name('icon.update');

        Route::post('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
        Route::post('change-password', 'AdminController@saveResetPassword')->name('change.password');

        Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'AdminAuth\RegisterController@register');

        //Gateway
        Route::resource('gateway', 'GatewayController', ['except' => ['create', 'show', 'edit']]);

        //Membresías
        Route::get('membership', 'MembershipController@index')->name('membership.admin.index');
        Route::post('membership/update/{id}', 'MembershipController@update')->name('membership.update');
        Route::get('membership/edit/{id}', 'MembershipController@edit')->name('membership.edit');
        Route::get('membership/history', 'MembershipController@membershipHistoryIndex')->name('membership.history.index');
        Route::get('membership/history/{id}', 'MembershipController@historyView')->name('membership.history.view');

    });

});


Auth::routes();

Route::group(['middleware' => 'web'], function() {

    //Payment IPN
   //  Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
   //  Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
    Route::get('/ipnbtc', 'PaymentController@ipnbtc')->name('ipn.btc');
    Route::get('/ipneth', 'PaymentController@ipneth')->name('ipn.eth');
   //  Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
   //  Route::post('/ipncoin', 'PaymentController@ipncoin')->name('ipn.coinPay');
   //  Route::post('/ipncoin-gate', 'PaymentController@coinGateIPN')->name('ipn.coinGate');
   //  Route::get('/coin-gate', 'PaymentController@coingatePayment')->name('coinGate');
   //  Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
   //  Route::get('/ipnblock', 'PaymentController@blockIpn')->name('ipn.block');

   //  Route::get('/lending/history', 'HomeController@lendHistory')->name('lend.history');

   //  Route::post('/lend/preview', 'HomeController@lendPreview')->name('lend.preview');
   //  Route::post('/sure/lend', 'HomeController@lendStore')->name('confirm.lend.store');
   //  Route::get('/lend/packages', 'HomeController@lendIndex')->name('lend.index');

    Route::get('/security/two/step', 'HomeController@twoFactorIndex')->name('two.factor.index');
    Route::post('/g2fa-create', 'HomeController@create2fa')->name('go2fa.create');
    Route::post('/g2fa-disable', 'HomeController@disable2fa')->name('disable.2fa');

    Route::put('/update/profile', 'HomeController@updateProfile')->name('update.profile');
    Route::get('/security', 'HomeController@securityIndex')->name('security.index');
    Route::post('/update/password', 'HomeController@changePassword')->name('change.password.user');

    Route::post('/get/user', 'HomeController@confirmUserAjax')->name('get.user');
    Route::post('/transfer/fund', 'HomeController@transferFund')->name('store.transfer.fund');
    Route::post('/get/charge', 'HomeController@getChargeAjax')->name('get.total.charge');
    Route::post('/change/pin', 'HomeController@pinChange')->name('change.pin');
    Route::post('/reset/pin', 'HomeController@resetPin')->name('reset.pin');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/tree', 'HomeController@treeIndex')->name('tree.index');

    // injected binary
    Route::get('/tree/binary', 'HomeController@treeBinary')->name('tree.binary');
    
    Route::get('/treeuser', 'HomeController@treeUser')->name('tree.user');
    Route::get('/referral', 'HomeController@referralIndex')->name('referral.index');
    Route::get('/referral/commission', 'HomeController@referraCommsisionlIndex')->name('ref.commision.index');
    Route::get('/unilevel/commission', 'HomeController@unilevelCommsisionlIndex')->name('unilevel.commision.index');

    // @Solidario Bonus
    Route::get('/solidario/commission', 'Bonus\BonusController@getSolidario')->name('solidario.commision.index');
    Route::post('/solidario/redeem', 'Bonus\BonusController@redeem')->name('solidario.redeem');

  
    Route::get('/consumption/commission', 'HomeController@consumptionCommsisionlIndex')->name('consumption.commision.index');
    Route::get('/fund', 'HomeController@fundIndex')->name('add.fund.index');
    Route::get('/withdraw', 'HomeController@withdrawIndex')->name('request.users_management.index');

    Route::post('/withdraw/preview', 'HomeController@withdrawPreview')->name('withdraw.preview.user');

    Route::get('/transfer/fund', 'HomeController@transferFundIndex')->name('fund.transfer.index');
    Route::get('/transaction/pin', 'HomeController@transacPinIndex')->name('transaction.pin.index');
    Route::get('/transaction', 'HomeController@transacHistory')->name('transaction.history');
    Route::get('/profile', 'HomeController@profileIndex')->name('profile.index');
    Route::get('/support', 'TicketController@ticketIndex')->name('support.index.customer');
    Route::get('/support/new', 'TicketController@ticketCreate')->name('add.new.ticket');
    //Compra de membresia usuario
    Route::get('/membership', 'MembershipController@membershipIndex')->name('membership.index');
    Route::post('/membership/buy', 'MembershipController@membershipBuy')->name('membership.buy');

    //Compra de productos
    Route::get('/product', 'HomeController@productIndex')->name('product.index');
    Route::post('/product/buy', 'HomeController@productBuy')->name('product.buy');

    Route::post('/deposit/store', 'HomeController@storeDeposit')->name('buy.preview');
    Route::get('/add/confirm', 'PaymentController@buyConfirm')->name('buy.confirm');
    Route::post('/confirm/withdraw', 'HomeController@storeWithdraw')->name('confirm.withdraw.store');

    Route::post('/store/ticket', 'TicketController@ticketStore')->name('ticket.store');
    Route::get('/comment/close/{ticket}', 'TicketController@ticketClose')->name('ticket.close');
    Route::get('/support/reply/{ticket}', 'TicketController@ticketReply')->name('ticket.customer.reply');
    Route::post('/support/store/{ticket}', 'TicketController@ticketReplyStore')->name('store.customer.reply');
});

//Ruta de afiliado
Route::get('/{username}', 'Auth\RegisterController@showRegistrationForm')->name('register.afiliate');


