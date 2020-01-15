<?php

namespace App\Http\Requests;

use App\DhcpEvent;
use Illuminate\Support\Arr;
use App\Events\BackchannelMessage;
use Illuminate\Foundation\Http\FormRequest;

class DhcpEventRequest extends FormRequest
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
            //
        ];
    }

    /**
     * Take some action(s)
     * @return $this
     */
    public function react()
    {
        $m = $this->eventArray();

        event(new BackchannelMessage($m['ACTION'].' lease for '.$m['IP'].' / '.$m['HOSTMAC'].' until '.$m['DNSMASQ_LEASE_EXPIRES']));

        return $this;
    }

    /**
     * Record, log, or otherwise track events
     * @return $this
     */
    public function record()
    {
        $m = $this->eventJson();

        \Log::notice($this->eventJson());
        DhcpEvent::create(['message' => $m]);

        return $this;
    }

    /**
     * The event data as an array
     * @return array
     */
    protected function eventArray()
    {
        return $this->json()->all();
    }

    /**
     * The event data in json
     * @return string
     */
    protected function eventJson()
    {
        return json_encode($this->eventArray(), JSON_UNESCAPED_SLASHES);
    }

    /**
     * Get the type of dhcp event this is according to the data that was posted
     * @return mixed|string|boolean
     */
    protected function eventType()
    {
        return (Arr::has($this->eventArray(), 'ACTION')) ? $this->eventArray()['ACTION'] : false;
    }
}
