<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */

return [
    'firewall' => false,              //Bật tắt firewall
    'ip_allow' => '',                //Danh sách IP bỏ qua
    'ip_deny' => '' ,                 //Danh sách IP cấm truy cập
    'max_lockcount' => 2,           //Số lần tối đa phát hiện dấu hiệu DDOS và khoá IP đó vĩnh viễn
    'max_connect' => 5,             //Số kết nôi tối đa được giới hạn bởi time_limit
    'time_limit' => 3,               //Thời gian được thực hiện tối ta max_connect kết nối
    'time_wait' => 5,                //Thời gian chờ để được mở khoá IP bị khoá tạm thời
    'email_admin' => 'nina@nina.vn', //Email liên lạc với admin
];