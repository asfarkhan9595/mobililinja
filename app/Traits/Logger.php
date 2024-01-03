<?php
namespace App\Traits;

use App\Models\ApplicationLog;

trait Logger {

    public function log($errorMessage, $userId = 0, $module = null, $ipAddress = null, $exception = null) {


        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $caller = $backtrace[1] ?? [];
        $file = $caller['file'] ?? 'Unknown File';
        $line = $caller['line'] ?? 'Unknown Line';

        $logData = [
            'error_message' => $errorMessage,
            'user_id' => $userId,
            'module' => $module,
            'ip_address' => $ipAddress,
            'file' => $file,
            'line' => $line,
            'request_method' => $_SERVER['REQUEST_METHOD'] ?? null,
            'request_uri' => $_SERVER['REQUEST_URI'] ?? null,
            'request_params' => json_encode($_REQUEST) ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null
        ];
        // Log to the database using an Eloquent model (Laravel example)
        ApplicationLog::create($logData);
    }
}
