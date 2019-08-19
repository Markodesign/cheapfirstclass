<?php
try {
    $_SERVER['DOCUMENT_ROOT'] = '/home/admin/web/cheapfirstclass.com/public_html';
    require_once 'wp-content/themes/cheapfirstclasstheme/request/Request.class.php';
    $request = new Request();
    $request->resendEmail();
} catch (Exception $e) {
    echo   $e->getMessage(), "\n";
}
