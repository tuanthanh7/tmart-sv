<?php
$api->post('/vnpay_create_payment', [
    'uses'   => 'VNPAYController@vnpayCreatePayment',
]);
$api->get('/vnpay_return', [
    'uses'   => 'VNPAYController@vnpayReturn',
]);
$api->get('/vnpay_IPN_Return', [
    'uses'   => 'VNPAYController@vnpayIPNReturn',
]);

