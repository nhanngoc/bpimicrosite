<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NPOErrorDataExport implements FromCollection, WithHeadings, WithMapping
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
            'purchasing Doc Type',
            'Vendor Id',
            'Currency',
            'Exchange Rate',
            'Payment Term',
            'Incoterms',
            'Doc Date',
            'Business Type',
            'Trade Type',
            'Cargo Type',
            'Location',
            'Invoice',
            'Period',
            'System No',
            'Work Center',
            'HBK',
            'End User',
            'Agent Code',
            'Salesman',
            'Carrier Code',
            'Carrier Type',
            'Area From',
            'Area To',
            'End User Grp',
            'POL',
            'POD',
            'PLD',
            'Vendor Orig Inv No',
            'Vendor Inv No',
            'MJob No',
            'Inter Co Mjob',
            'Orig PO No',
            'ETA',
            'ETD',
            'Ex Posting Date',
            'Ex Posting Date2',
            'Cargo Class',
            'Region',
            'BL No',
            'Process Type',
            'Process No',
            'Ref No',
            'Ref No1',
            'Ref No2',
            'Ref No3',
            'Ref No4',
            'Ref No5',
            'Ref No7',
            'Execute Date',
            'Vehicle Type',
            'Trip Type',
            'Transaction',
            'Shipper Code',
            'Shipper Name',
            'Consignee Code',
            'Consignee Name',
            'Net Weight',
            'Gross Weight',
            'SET',
            'M3',
            'KG',
            'Labour',
            'Qty',
            'UOM',
            'Man SO Indicator',
            'Ref No Type',
            'Org Doc',
            'Business Area',
            'MBK No',
            'ITEM_NO',
            'DESCRIPTION1',
            'DESCRIPTION2',
            'ITEM PRICE',
            'ITEM QTY',
            'ITEM UOM',
            'TAX_CODE',
            'ITEM_NET_VALUE',
            'CONTAINER_TYPE',
            'ORIG_PRICE',
            'ORIG_QTY',
            'ORIG_UOM',
            'ORIG_AMOUNT',
            'ORIG_CURRENCY',
            'ORIG_EX_RATE',
            'REMARK',
            'CONTRACT_NO',
            'CONTRACT_ITEM_NO',
            'CONTRACT_SUB_ITEM_NO',
            'SUB_ACCOUNT_NO',
            'SEASON_CODE',
            'DROP_POINT_ID',
            'REF_DOC1',
            'REF_DOC2',
            'REF_DOC3',
            'REF_DOC4',
            'Response',
            'Purchase Order ID',
        ];
    }

    public function map($data): array
    {
        return [
            $data['no'],
            $data['company_code'],
            $data['purchasing_doc_type'],
            $data['vendor_id'],
            $data['currency'],
            $data['exchange_rate'],
            $data['payment_term'],
            $data['incoterms'],
            $data['doc_date'],
            $data['business_type'],
            $data['trade_type'],
            $data['cargo_type'],
            $data['location'],
            $data['invoice'],
            $data['period'],
            $data['system_no'],
            $data['work_center'],
            $data['hbk'],
            $data['end_user'],
            $data['agent_code'],
            $data['salesman'],
            $data['carrier_code'],
            $data['carrier_type'],
            $data['area_from'],
            $data['area_to'],
            $data['end_user_grp'],
            $data['pol'],
            $data['pod'],
            $data['pld'],
            $data['vendor_orig_inv_no'],
            $data['vendor_inv_no'],
            $data['mjob_no'],
            $data['inter_co_mjob'],
            $data['orig_po_no'],
            $data['eta'],
            $data['etd'],
            $data['ex_posting_date'],
            $data['ex_posting_date2'],
            $data['cargo_class'],
            $data['region'],
            $data['bl_no'],
            $data['process_type'],
            $data['process_no'],
            $data['ref_no'],
            $data['ref_no1'],
            $data['ref_no2'],
            $data['ref_no3'],
            $data['ref_no4'],
            $data['ref_no5'],
            $data['ref_no7'],
            $data['execute_date'],
            $data['vehicle_type'],
            $data['trip_type'],
            $data['transaction'],
            $data['shipper_code'],
            $data['shipper_name'],
            $data['consignee_code'],
            $data['consignee_name'],
            $data['net_weight'],
            $data['gross_weight'],
            $data['set'],
            $data['m3'],
            $data['kg'],
            $data['labour'],
            $data['qty'],
            $data['uom'],
            $data['man_so_indicator'],
            $data['ref_no_type'],
            $data['org_doc'],
            $data['business_area'],
            $data['mbk_no'],
            $data['item_no'],
            $data['description1'],
            $data['description2'],
            $data['item_price'],
            $data['item_qty'],
            $data['item_uom'],
            $data['tax_code'],
            $data['item_net_value'],
            $data['exchange_rate'],
            $data['orig_price'],
            $data['orig_qty'],
            $data['orig_uom'],
            $data['orig_amount'],
            $data['orig_currency'],
            $data['orig_ex_rate'],
            $data['container_type'],
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
