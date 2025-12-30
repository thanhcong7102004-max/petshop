<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
$vnp_TmnCode = "W2XA0CQK"; //Mã định danh merchant kết nối (Terminal Id)
$vnp_HashSecret = "7JNXSWTO7EF2WTXSPJFLDYVOJ1EMJOF3"; //Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
// Sử dụng ngrok URL - nếu lỗi code=72, cần đăng ký URL này trong VNPAY merchant portal
$vnp_Returnurl = "https://imputedly-lamellose-marni.ngrok-free.dev/petshop/public/orders/vnpay-return";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
