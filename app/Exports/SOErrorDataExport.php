<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SOErrorDataExport implements FromCollection, WithHeadings, WithMapping
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
    public function headings(): array
    {
        return [
            'No',
            'Company Code',
            'Ledger',
            'Period',
            'Document Date',
            'Posting Date',
            'Document type',
            'Doc.Header Text',
            'Exchange Rate',
            'Currency',
            'Customer',
            'G/L Account C',
            'Doc Amt',
            'Local Amt',
            'Payment term',
            'POL',
            'POD',
            'ShipperCode',
            'ShipperName',
            'ConsigneeCode',
            'ConsigneeName',
            'ITEM_NO',
            'DESCRIPTION1',
            'PRICE',
            'QTY',
            'UOM',
            'TAX_CODE',
            'NET_VALUE',
            'G/L Account Item',
            'Business Type',
            'Trade Type',
            'Cargo Type',
            'Warehouse',
            'Region',
            'Incoterms',
            'Master Job',
            'Sales Person',
            'Business Area',
            'Reference Key 1',
            'Reference Key 2',
            'Reference Key 3',
            'SO ID',
            'Response',
        ];
    }

    public function map($data): array
    {
        return [
            $data["no"],
            $data["company_code"],
            $data["ledger"],
            $data["period"],
            $data["document_date"],
            $data["posting_date"],
            $data["document_type"],
            $data["docheader_text"],
            $data["exchange_rate"],
            $data["currency"],
            $data["customer"],
            $data["gl_account_c"],
            $data["doc_amt"],
            $data["local_amt"],
            $data["payment_term"],
            $data["pol"],
            $data["pod"],
            $data["shippercode"],
            $data["shippername"],
            $data["consigneecode"],
            $data["consigneename"],
            $data["item_no"],
            $data["description1"],
            $data["price"],
            $data["qty"],
            $data["uom"],
            $data["tax_code"],
            $data["net_value"],
            $data["gl_account_item"],
            $data["business_type"],
            $data["trade_type"],
            $data["cargo_type"],
            $data["warehouse"],
            $data["region"],
            $data["incoterms"],
            $data["master_job"],
            $data["sales_person"],
            $data["business_area"],
            $data["reference_key_1"],
            $data["reference_key_2"],
            $data["reference_key_3"],
            $data["so_id"],
            $data["response"]
        ];
    }
}
