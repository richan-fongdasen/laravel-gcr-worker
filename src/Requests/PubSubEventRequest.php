<?php

namespace RichanFongdasen\GCRWorker\Requests;

use Google\Cloud\PubSub\Message;
use Illuminate\Foundation\Http\FormRequest;

class PubSubEventRequest extends FormRequest
{
    /**
     * Determine if the current user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the Pub/Sub message from the current request.
     *
     * @return Message
     */
    public function getPubSubMessage(): Message
    {
        $requestData = $this->all();
        $requestData['message']['data'] = base64_decode($requestData['message']['data']);

        return new Message($requestData['message']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'message.data'         => 'required|string|min:32',
            'message.messageId'    => 'required|integer',
            'message.message_id'   => 'required|integer',
            'message.publishTime'  => 'required|date',
            'message.publish_time' => 'required|date',
            'subscription'         => 'required|string|min:8',
        ];
    }
}
