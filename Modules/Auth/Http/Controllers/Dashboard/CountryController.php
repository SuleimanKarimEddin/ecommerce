<?php

namespace Modules\Auth\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Modules\Auth\Http\Requests\Dashboard\Country\CreateCountryRequest;
use Modules\Auth\Http\Requests\Dashboard\Country\DeleteCountryRequest;
use Modules\Auth\Http\Requests\Dashboard\Country\UpdateCountryRequest;
use Modules\Auth\Http\Resources\Dashboard\Country\GetAllCountryResource;
use Modules\Auth\Services\CountriesService;

class CountryController extends Controller
{
    public function __construct(private CountriesService $service) {}

    public function getAll()
    {
        $data = $this->service->getAll($is_pagenate = false);
        $response = GetAllCountryResource::collection($data);

        return response()->json($response);
    }

    public function create(CreateCountryRequest $request)
    {
        $data = $this->service->create($request->validated());

        return response()->json($data);
    }

    public function update(UpdateCountryRequest $request, $id)
    {
        $data = $this->service->updateCountry($id, $request->validated());

        return response()->json($data);
    }

    public function delete(DeleteCountryRequest $request, $id)
    {
        $data = $this->service->deleteCountry($id);

        return response()->json($data);
    }
}
