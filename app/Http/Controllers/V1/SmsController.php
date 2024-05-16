<?php

namespace App\Http\Controllers\V1;

use App\DTO\V1\Sms\SmsSendDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\SmsSendRequest;
use App\Models\Patient;
use App\Services\V1\SmsService;
use Illuminate\Http\JsonResponse;
use Psr\Http\Client\ClientExceptionInterface;
use Vonage\Client\Exception\Exception;

class SmsController extends Controller
{

    public function __construct(
        protected SmsService $smsService
    )
    {
        $this->smsService = $smsService;
    }

    /**
     * @param SmsSendRequest $request
     * @param $idPatient
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function sendSms(SmsSendRequest $request, $idPatient)
    {
        try {
            $smsDto = new SmsSendDTO(
                $request->input('message')
            );
            $smsResponse = $this->smsService->sendSms($smsDto, $idPatient);
            return response()->json([
                "message" => $smsResponse["message"]
            ], $smsResponse["status"]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
