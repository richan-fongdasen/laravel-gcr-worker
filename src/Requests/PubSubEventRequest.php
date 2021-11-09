<?php

namespace RichanFongdasen\GCRWorker\Requests;

use Google\Cloud\PubSub\Message;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use RichanFongdasen\GCRWorker\Facade\GcrQueue;

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

//        Log::info('PubSub Message Content: '.json_encode($requestData));

        $requestData['message']['data'] = base64_decode($requestData['message']['data']);

        $message = new Message($requestData['message']);

        return GcrQueue::pullFreshMessage($message);
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
