<?php

namespace App\Http\Requests;

use App\Check;
use Illuminate\Foundation\Http\FormRequest;

class StoreHostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $checksList = Check::getList();

        return [
            'host_name' => 'required',
            'host_ip'   => 'required|ip',
            'ssh_user'  => 'required',
            'ssh_port'  => 'required|numeric',
            'checks.*'  => 'required|in:'.$checksList->implode(','),
        ];
    }
}
