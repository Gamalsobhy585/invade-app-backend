<?php

return [
    "login" => [
        "success" => "Login successful",
        "failed" => "Login failed",
        "invalid_credentials" => "Invalid credentials",
    ],
    "logout" => [
        "success" => "Logout successful",
        "failed" => "Logout failed",
    ],
    "renew" => [
        "success" => "Password updated successfully",
        "failed" => "Password update failed",
        "user_not_found" => "User not found",
    ],
    "user" => [
        "success" => "User information retrieved successfully",
        "not_found" => "User not found",
    ],
    "register" => [
        "success" => "User registered successfully",
        "failed" => "User registration failed",
        "email_exists" => "Email already exists",
    ],
    "validation" => [
        "name_required" => "The name field is required.",
        "email_required" => "The email field is required.",
        "email_email" => "The email must be a valid email address.",
        "email_unique" => "The email has already been taken.",
        "password_required" => "The password field is required.",
        "password_confirmed" => "The password confirmation does not match.",
        'title_required' => 'The title field is required.',
        'title_string' => 'The title must be a string.',
        'title_max' => 'The title may not be greater than 255 characters.',
        'description_required' => 'The description field is required.',
        'description_string' => 'The description must be a string.',
        'status_required' => 'The status field is required.',
        'status_in' => 'The selected status is invalid.',
        'due_date_date' => 'The due date must be a valid date.',
        'category_id_exists' => 'The selected category id is invalid.',
        'category_id_integer' => 'The category id must be an integer.',
        'category_id_required' => 'The category id field is required.',


    
    ],
    "task" => [
        "get_all" => "Tasks retrieved successfully",
        "get" => "Task retrieved successfully",
        "get_failed" => "Failed to retrieve tasks",
        "not_found" => "Task not found",
        "created" => "Task created successfully",
        "create_failed" => "Failed to create task",
        "updated" => "Task updated successfully",
        "update_failed" => "Failed to update task",
        "deleted" => "Task deleted successfully",
        "delete_failed" => "Failed to delete task",
        "restored" => "Task restored successfully",
        "restore_failed" => "Failed to restore task",
        "get_all_deleted"=> "Deleted tasks retrieved successfully",
        "no_ids_provided" => "No IDs provided for bulk delete",
        "bulk_deleted" => "Tasks deleted successfully",
        "bulk_delete_failed" => "Failed to delete tasks",
        "bulk_restored" => "Tasks restored successfully",
        "bulk_restore_failed" => "Failed to restore tasks",
        "bulk_force_delete_failed" => "Failed to force delete tasks",
        "partial_bulk_deleted" => "Some tasks were not deleted successfully",
        "partial_bulk_restored" => "Some tasks were not restored successfully",
        "partial_bulk_force_deleted" => "Some tasks were not force deleted successfully",
        "bulk_force_deleted" => "Tasks force deleted successfully",
    ],

    "category" => [
        "get_all" => "Categories retrieved successfully",
        "get_failed" => "Failed to retrieve categories",
       
    ],
];