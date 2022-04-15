<?php

namespace App\Services\BusinessType;

use Illuminate\Http\Request;
use App\Models\BusinessType;
use App\Core\Support\Services\ProduceServiceInterface;
use App\Repositories\Department\Interfaces\DepartmentInterface;
use App\Repositories\BusinessType\Interfaces\BusinessTypeInterface;

class CreateBusinessTypeService
{

    /**
     * @var BusinessTypeInterface
     */
    protected $businessTypeRepository;

    /**
     * @var DepartmentInterface
     */
    protected $departmentRepository;

    /**
     * CreateBusinessTypeService constructor.
     *
     * @param BusinessTypeInterface $businessTypeRepository
     * @param DepartmentInterface $departmentRepository
     */
    public function __construct(
        BusinessTypeInterface $businessTypeRepository,
        DepartmentInterface $departmentRepository
    )
    {
        $this->BusinessTypeRepository = $businessTypeRepository;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @param Request $request
     * @param BusinessType $businessType
     *
     * @return BusinessType|false|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function execute(Request $request, BusinessType $businessType)
    {
        $trade_types = $request->input('trade_types');
        $cargo_types = $request->input('cargo_types');
        $location_codes = $request->input('location_codes');
        
        $businessType->tradeTypes()->sync($trade_types);
        $businessType->cargoTypes()->sync($cargo_types);
        $businessType->locationCodes()->sync($location_codes);
    }
}
