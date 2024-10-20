<?php

namespace App\Services\V1;


use App\DTO\V1\Patient\PatientStoreDTO;
use App\DTO\V1\Patient\PatientUpdateDTO;
use App\Jobs\SendConfirmationEmailJob;
use App\Models\Patient;
use App\Repositories\V1\PatientRepository;
use App\Repositories\V1\PatientRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PatientService
{
    public function __construct(
        protected PatientRepository $patientRepository
    )
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * Retrieves all the patients stored
     * @return mixed
     * @throws Exception
     */
    public function index(): Collection
    {
        try {
            return $this->patientRepository->index();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Retrieves the information of the patient with the id passed by path parameter
     * @param Patient $patient
     * @return mixed
     */
    public function find(Patient $patient)
    {
        return $this->patientRepository->find($patient->id);
    }

    /**
     * Store a new record of patient and also save the image in storage
     * @param PatientStoreDTO $data
     * @return mixed
     * @throws Exception
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
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Updates the patient record using the id passed by path parameter
     * @param PatientUpdateDTO $data
     * @param Patient $patient
     * @return mixed
     * @throws Exception
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
     * Delete from the database and the image from the storage the information of the patient passed by path parameter
     * @param Patient $patient
     * @return mixed
     * @throws Exception
     */
    public function destroy(Patient $patient): bool
    {
        try {
            $this->deleteOldImage($patient->document_image);
            return $this->patientRepository->destroy($patient);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Function that handles the validation of the email with the token stored in the register.
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     * @throws Exception
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

            // Update the email verification date and delete the token
            $patient->email_verified_at = now();
            $patient->email_verification_token = null;
            $patient->save();

            return view('email_validated');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Common function to store image in storage
     * @param $image
     * @return mixed
     * @throws Exception
     */
    private function storeImage($image)
    {
        try {
            return $image->store('images', 'public');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Common function to delete image
     * @param $image
     * @return void
     * @throws Exception
     */
    private function deleteOldImage($image)
    {
        try {
            Storage::delete($image);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
