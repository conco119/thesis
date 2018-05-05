<?php

abstract class HelpAbstract {
 protected $pdo, $permission_type;

 function __construct() {
     $this->pdo = new DPDO();

     $this->permission_type = [
        1 => 'Quản trị hệ thống',
        2 => 'Quản lý',
        3 => 'Nhân viên',
        4 => "Người dùng"
    ];
 }
}