<?php

namespace App\Services\V1;


use App\DTO\V1\Sms\SmsSendDTO;
use App\Http\Requests\SmsSendRequest;
use App\Models\Patient;
use App\Repositories\V1\PatientRepositoryInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Vonage\Client\Exception\Exception;

class SmsService
{
    public function __construct(
        protected PatientRepositoryInterface $patientRepository
    )
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * @param SmsSendDTO $data
     * @param $idPatient
     * @return array
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function sendSms(SmsSendDTO $data, $idPatient)
    {
        try {
            $patient = $this->patientRepository->find($idPatient);

            $basic = new \Vonage\Client\Credentials\Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
            $client = new \Vonage\Client($basic);

//            TODO: check it in two months and use it dinamically, in the meanwhile we only can use the number above because it's a test account
//            $response = $client->sms()->send(
//                new \Vonage\SMS\Message\SMS($patient->phone_number, 'Patient App', $data->getMessage())
//            );

            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS("541133433174", 'Patient App', $data->getMessage())
            );

            $message = $response->current();

            if ($message->getStatus() == 0) {
                return [
                    "message" => "The message was sent successfully",
                    "status" => 200
                ];
            } else {
                return [
                    "message" => "The message failed with status: " . $message->getStatus(),
                    "status" => 500
                ];
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


}
