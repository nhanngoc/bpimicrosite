<?php 
    if ($vendor->gname1 != "") {
        $html = '<p><strong>Company name in English</strong>: '.$vendor->gname1.'</p>';
    }
    if ($vendor->lname1 != "") {
        $html .= '<p><strong>Company name in Vietnamese</strong>: '.$vendor->lname1.'</p>';
    }
    if ($vendor->add1 != "") {
        $html .= '<p><strong>Address 1</strong>: '.$vendor->add1.'</p>';
    }
    if ($vendor->country != "") {
        $html .= '<p><strong>Country</strong>: '.$vendor->country.'</p>';
    }
    if ($vendor->phone_no != "") {
        $html .= '<p><strong>Phone Number</strong>: '.$vendor->phone_no.'</p>';
    }
    if ($vendor->fax_no != "") {
        $html .= '<p><strong>Fax No</strong>: '.$vendor->fax_no.'</p>';
    }
    if ($vendor->tax_code != "") {
        $html .= '<p><strong>VAT Number</strong>: '.$vendor->tax_code.'</p>';
    }
    if ($vendor->vendor_or_customer != "") {
        $html .= '<p><strong>Customer or Vendor</strong>: '.$vendor->vendor_or_customer.'</p>';
    }
    if ($vendor->credit_term != "") {
        $html .= '<p><strong>Payment Term</strong>: '.$vendor->credit_term.'</p>';
    }
    if ($vendor->payment_method != "") {
        $html .= '<p><strong>Payment Method</strong>: '.$vendor->payment_method.'</p>';
    }
    if ($vendor->currency != "") {
        $html .= '<p><strong>Currency </strong>: '.$vendor->currency.'</p>';
    }
    if ($vendor->contact_type != "") {
        $html .= '<p><strong>Contact Type</strong>: '.$vendor->contact_type.'</p>';
    }
    if ($vendor->contact_person != "") {
        $html .= '<p><strong>Contact Person</strong>: '.$vendor->contact_person.'</p>';
    }
    if ($vendor->remark1 != "") {
        $html .= '<p><strong>Remark </strong>: '.$vendor->remark1.'</p>';
    }
        
?>

{!! MailVariable::prepareData('

{{ header }}

<strong>Hello!</strong> <br /><br />' . $html . '
Link approve Customer/Vendor: <p><a href="' . route('customer-vendor.edit', $vendor->id) . '">' . route('customer-vendor.edit', $vendor->id) . '</a></p>

') !!}

{{-- {{ footer }} --}}