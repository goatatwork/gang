<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReconScanRequest extends FormRequest
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
        return [
            'ip' => ['sometimes','ip']
        ];
    }

    /**
     * Run the scan
     * @return [type] [description]
     */
    public function scan()
    {
        if ($this->scanType == 'bridged_mac_all') {
            $result = app('reconbot')->zhoneOntBridgedMacAll($this->ip);
        }

        if ($this->scanType == 'system_info') {
            $result = app('reconbot')->zhoneOntSystemInfo($this->ip);
        }

        if ($this->scanType == 'ping') {
            $result = app('reconbot')->ping($this->ip);
        }

        return ['scanType' => $this->scanType, 'result' => $result];
    }
}
