<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class APOErrorDataExport implements FromCollection, WithHeadings, WithMapping
{

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }

    /**
     * Returns headers for report
     * @return array
     */
    public function headings(): array {
        return [
            'No',
            'Company Code',
            'Doc Date',
            'Vendor ID',
            'End User',
            'Currency',
            'Ex Rate',
            'Payment Term',
            'Incoterms',
            'Trade Type',
            'Cargo Type',
            'Business Type',
            'Warehouse Code',
            'Item No',
            'Material Code',
            'Description1',
            'Description2',
            'Price',
            'Quantity',
            'UOM',
            'Tax',
            'Amount',
            'Remark',
            'Contract No',
            'Contract Item No',
            'Contract Sub Item No',
            'Sub Account No',
            'Season Code',
            'Drop Point Id',
            'Ref Doc1',
            'Ref Doc2',
            'Ref Doc3',
            'Ref Doc4',
            'Response',
            'Purchase order id'
        ];
    }

    public function map($data): array {
        return [
            $data['no'],
            $data['company_code'],
            $data['doc_date'],
            $data['vendor_id'],
            $data['end_user'],
            $data['currency'],
            $data['ex_rate'],
            $data['payment_term'],
            $data['incoterms'],
            $data['trade_type'],
            $data['cargo_type'],
            $data['business_type'],
            $data['warehouse_code'],
            $data['item_no'],
            $data['material_code'],
            $data['description1'],
            $data['description2'],
            $data['price'],
            $data['quantity'],
            $data['uom'],
            $data['tax'],
            $data['amount'],
            $data['remark'],
            $data['contract_no'],
            $data['contract_item_no'],
            $data['contract_sub_item_no'],
            $data['sub_account_no'],
            $data['season_code'],
            $data['drop_point_id'],
            $data['ref_doc1'],
            $data['ref_doc2'],
            $data['ref_doc3'],
            $data['ref_doc4'],
            $data['response'],
            $data['purchase_order_id'],
        ];
    }
}
