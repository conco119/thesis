<?php

abstract class HelpAbstract {
 protected $pdo, $permission_type;

 function __construct()
 {
     $this->pdo = new DPDO();

     $this->permission_type = [
        1 => 'Quản trị hệ thống',
        2 => 'Quản lý',
        3 => 'Nhân viên',
        4 => "Người dùng"
    ];

    $this->gender = [
        1 => "Nam",
        2 => "Nữ",
        3 => "Khác"
    ];

    $this->discount_type = [
        1 => "Chiết khấu %",
        2 => "Chiết khấu tiền mặt",
        3 => "Gia tăng %",
        4 => "Gia tăng tiền mặt"
    ];
 }
}