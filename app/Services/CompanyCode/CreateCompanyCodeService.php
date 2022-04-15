<?php

namespace App\Services\CompanyCode;

use Illuminate\Http\Request;
use App\Models\CompanyCode;
use App\Core\Support\Services\ProduceServiceInterface;
use App\Repositories\Department\Interfaces\DepartmentInterface;
use App\Repositories\CompanyCode\Interfaces\CompanyCodeInterface;

class CreateCompanyCodeService
{

    /**
     * @var CompanyCodeInterface
     */
    protected $companyCodeRepository;

    /**
     * @var DepartmentInterface
     */
    protected $departmentRepository;

    /**
     * CreateCompanyCodeService constructor.
     *
     * @param CompanyCodeInterface $companyCodeRepository
     * @param DepartmentInterface $departmentRepository
     */
    public function __construct(
        CompanyCodeInterface $companyCodeRepository,
        DepartmentInterface $departmentRepository
    )
    {
        $this->companyCodeRepository = $companyCodeRepository;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @param Request $request
     * @param CompanyCode $company_Code
     *
     * @return CompanyCode|false|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function execute(Request $request, CompanyCode $company_code)
    {
        $departments = $request->input('departments');
        
        $company_code->departments()->sync($departments);

    }
}
