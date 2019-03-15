<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        # TODO art required_if app('current_user_permiss')
        return app('current_user_permiss')->check('store');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:10',
            'art' => /*'required|*/'alpha_num|unique:products',
        ];
    }

    /**
     * Получить сообщения об ошибках для определённых правил проверки.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Название обязательно',
            'name.min' => 'Название должно содержать мнимум 10 символов',
            'art.required'  => 'Артикул обязтелен',
            'art.alpha_num'  => 'Артикул должнен содержать только латинские символы и цифры',
            'art.unique'  => 'Товар с данным артикулом уже существует',
        ];
    }
}
