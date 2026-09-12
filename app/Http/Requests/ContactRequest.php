<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * On validation failure, send the visitor back to the contact form
     * itself (not the top of the page) so their errors are visible.
     */
    protected function failedValidation(Validator $validator): void
    {
        throw (new ValidationException($validator))
            ->redirectTo(route('home') . '#contact');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'message' => ['required', 'string', 'max:4000'],
            // Honeypot field. Real visitors never see or fill this in,
            // so any value here marks the submission as spam.
            'website' => ['nullable', 'string'],
        ];
    }

    /**
     * Determine whether the honeypot field was filled in.
     */
    public function isSpam(): bool
    {
        return filled($this->input('website'));
    }
}
