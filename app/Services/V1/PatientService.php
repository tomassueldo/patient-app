<?php

namespace App\Services\V1;


use App\DTO\V1\Patient\PatientStoreDTO;
use App\DTO\V1\Patient\PatientUpdateDTO;
use App\Exceptions\NotFoundException;
use App\Jobs\SendConfirmationEmailJob;
use App\Models\Patient;
use App\Repositories\V1\PatientRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PatientService
{
    public function __construct(
        protected PatientRepositoryInterface $patientRepository
    )
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        try {
            return $this->patientRepository->index();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param Patient $patient
     * @return mixed
     */
    public function find(Patient $patient)
    {
        return $this->patientRepository->find($patient->id);
    }

    /**
     * @param PatientStoreDTO $data
     * @return mixed
     * @throws \Exception
     */
    public function store(PatientStoreDTO $data)
    {
        try {

            $imagePath = $this->storeImage($data->getDocumentImage());
            $data->setDocumentImage($imagePath);

            //Transforms the dto to array for the create method
            $dataToInsert = (array)$data;

            //Set the token value for the mail verification
            $emailVerificationToken = Str::random(50);
            $dataToInsert['email_verification_token'] = $emailVerificationToken;

            $patient = $this->patientRepository->store($dataToInsert);

            SendConfirmationEmailJob::dispatch($patient);

            return $patient;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param PatientUpdateDTO $data
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function update(PatientUpdateDTO $data, Patient $patient)
    {
        $patient = $this->patientRepository->find($patient->id);

        if (!is_null($data->getDocumentImage())) {
            $this->deleteOldImage($patient->document_image);
            $imagePath = $this->storeImage($data->getDocumentImage());
            $data->setDocumentImage($imagePath);
        }

        return $this->patientRepository->update($data->hideNull()->toArray(), $patient);
    }

    /**
     * @param Patient $patient
     * @return mixed
     */
    public function destroy(Patient $patient)
    {
        try {
            return $this->patientRepository->destroy($patient);
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws \Exception
     */
    public function updateEmailValidation($token)
    {
        try {
            $patient = $this->patientRepository->getPatientWithToken($token);

            if (!$patient) {
                return view('invalid_token');
            }

            if (!is_null($patient->email_verified_at)) {
                return view('user_already_validated');
            }

            // Update the email validation date
            $patient->email_verified_at = now();
            $patient->email_verification_token = null;
            $patient->save();

            return view('email_validated');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $image
     * @return mixed
     * @throws \Exception
     */
    private function storeImage($image)
    {
        try {
            return $image->store('images', 'public');
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $image
     * @return void
     * @throws \Exception
     */
    private function deleteOldImage($image)
    {
        try {
            Storage::delete($image);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
