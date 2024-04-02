<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
  public function authorize(): bool
  {
    return auth()->user()->role === 'ADMIN';
  }

  public function rules(): array
  {
    return [
      'login' => 'required|string|min:5|max:60|unique:users|regex:/^[a-zA-Z0-9_]+$/' . $this->user->id,
      'name' => 'required|string|min:2|max:50|regex:/^[A-Za-zА-Яа-яЁё\s\-]+$/u',
      'email' => 'required|email|unique:users,email' . $this->user->id,
      'password' => 'required|string|min:8|max:60|regex:/^[a-zA-Z0-9_]+$/',
      'role' => 'required|in:ADMIN,USER',
    ];
  }
}
