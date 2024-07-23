<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\Country;
use Modules\Auth\Models\UserAddress;
use Modules\Base\Exceptions\NotFoundException;
use Modules\Base\Services\BaseCrudService;

class CountriesService extends BaseCrudService
{
    public function __construct()
    {
        parent::__construct(new Country());
    }

    public function updateCountry(string $id, array $data): bool
    {

        $isSuccess = DB::transaction(function () use ($id, $data) {

            $isUpdated = Country::where('name', $id)->update([
                'name' => $data['name'],
            ]);

            if (! $isUpdated) {
                throw new NotFoundException();
            }
            UserAddress::where('country_name', $id)->update([
                'country_name' => $data['name'],
            ]);

        });

        return true;
    }

    public function deleteCountry(string $id): bool
    {
        Country::where('name', $id)->delete();

        return true;
    }

    public function findCountry(string $name): Country
    {
        return Country::where('name', $name)->first();
    }
}
