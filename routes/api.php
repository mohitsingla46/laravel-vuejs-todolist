<?php

use App\Http\Controllers\TaskController;

Route::apiResource('tasks', TaskController::class);

Route::post('update_task_status', [TaskController::class, 'update_task_status']);

