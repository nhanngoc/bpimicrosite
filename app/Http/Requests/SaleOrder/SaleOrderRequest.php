<?php

namespace App\Http\Requests\SaleOrder;

use App\Core\Support\Http\Requests\Request;

class SaleOrderRequest extends Request
{
    /**
     * @return string[]
     */
    public function rules()
    {
        $rules = [
            'CompanyCode'                  => 'max:4',
            'PlantCode'                    => 'max:4',
            'DocumentType'                 => 'required|max:3',
            'ReferenceDocumentNumber'      => 'max:16',
            'DocumentDate'                 => 'required',
            'Currency'                     => 'required',
            'PaymentTerm'                  => 'required',
            'Period'                       => 'required|max:6',
            'ExternalGeneralLedgerAccount' => 'required|max:10',
            // 'MasterJob'                    => 'required',
            // 'SalesPerson'                  => 'required',
            // 'SystemNumber'                 => 'required',
            'Customer'                     => 'required|max:10'
        ];
        if ($this->method() == 'PUT') {
            if ($this->request->get('submit') === 'submit') {
                $rules = [];
            } else {
                unset($rules['CompanyCode']);
                unset($rules['SystemNumber']);
            }
        }
        if ($this->method() == 'POST') {
            if ($this->request->get('Currency') === 'USD') {
                $rules['ExchangeRate'] = 'required';
            }
            if ($this->request->get('CompanyCode') === 3330) {
                $rules['POl'] = 'required|max:5';
                $rules['POD'] = 'required|max:5';
                $rules['ShipperCode'] = 'required|max:20';
                $rules['IsPettyCash'] = 'required';
                $rules['ShipperName'] = 'required|max:50';
            }
        }
        return $rules;
    }
}
