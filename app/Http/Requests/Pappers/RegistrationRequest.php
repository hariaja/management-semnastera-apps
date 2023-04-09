<?php

namespace App\Http\Requests\Pappers;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'title' => [
        'nullable', 'string',
        Rule::unique('registrations', 'title')->ignore($this->registration)
      ],
      'date_start' => 'required|date',
      'date_end' => 'required|date|after_or_equal:date_start',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'title.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',

      'date_start.required' => ':attribute tidak boleh dikosongkan',
      'date_start.date' => ':attribute harus berupa tanggal. Etc: 2023/01/01',
      'date_start.after_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date',
      'date_start.before_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date',

      'date_end.required' => ':attribute tidak boleh dikosongkan',
      'date_end.date' => ':attribute harus berupa tanggal. Etc: 2023/01/01',
      'date_end.after_or_equal' => ':attribute harus berupa tanggal sebelum atau sama dengan :date',
      'date_end.before_or_equal' => ':attribute harus berupa tanggal setelah atau sama dengan :date',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function attributes(): array
  {
    return [
      'title' => 'Judul',
      'date_start' => 'Tanggal Dibuka',
      'date_end' => 'Tanggal Ditutup',
    ];
  }
}
