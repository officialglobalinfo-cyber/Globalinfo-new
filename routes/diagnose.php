<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response; // Fixed Import

Route::get('/diagnose-site', function () {
    $checks = [];

    // 1. Check PHP Version
    $checks['php_version'] = phpversion();

    // 2. Check Database
    try {
        DB::connection()->getPdo();
        $checks['db_connection'] = 'OK';
        $checks['db_name'] = DB::connection()->getDatabaseName();
        // Try simple write and rollback
        DB::beginTransaction();
        // Just verify we can start transaction, no need to insert if schema not checked
        DB::rollBack();
        $checks['db_write_access'] = 'OK (Transaction test)';
    } catch (\Exception $e) {
        $checks['db_connection'] = 'ERROR: ' . $e->getMessage();
    }

    // 3. Check Storage Link
    $publicStorage = public_path('storage');
    if (file_exists($publicStorage)) {
        if (is_link($publicStorage)) {
            $checks['storage_link'] = 'OK (Is a symbolic link)';
            try {
                $target = readlink($publicStorage);
                $checks['storage_link_target'] = $target;
                
                // 4. Check Writability of Target
                $realPath = realpath($publicStorage); // Follow link
                if ($realPath && is_writable($realPath)) {
                   $checks['storage_writable'] = 'YES - ' . $realPath;
                   
                   // Try writing a test file
                   $testFile = $realPath . '/test_check-' . time() . '.txt';
                   file_put_contents($testFile, 'Write Test OK');
                   if (file_exists($testFile)) {
                       $checks['actual_file_write'] = 'SUCCESS';
                       unlink($testFile);
                   } else {
                       $checks['actual_file_write'] = 'FAILED to create file';
                   }
                   
                } else {
                    $checks['storage_writable'] = 'NO - Please fix permissions on ' . ($realPath ?: 'unknown path');
                }
                
            } catch(\Exception $e) {
                $checks['storage_link_error'] = $e->getMessage();
            }
        } else {
            $checks['storage_link'] = 'ERROR - Folder exists but is NOT a link (Delete public/storage and re-link)';
        }
    } else {
        $checks['storage_link'] = 'MISSING - public/storage does not exist';
    }

    return Response::json($checks, 200, [], JSON_PRETTY_PRINT);
});
