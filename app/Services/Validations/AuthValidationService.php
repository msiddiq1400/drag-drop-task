<?php

namespace App\Services\Validations;

use Exception;
use Illuminate\Support\Facades\Validator;

class TaskValidationService
{
    public function taskValidation($data)
    {
        // $validation = Validator::make($data, [
        //     'email' => 'required|string'
        // ]);

        // if ($validation->fails()) {
        //     throw new Exception("Email not Provided");
        // }

        // $validation2 = Validator::make($data, [
        //     'email' => 'exists:users,email'
        // ]);
        // if (!$validation2->fails()) {
        //     throw new Exception("User Already Exists");
        // }
    }
}