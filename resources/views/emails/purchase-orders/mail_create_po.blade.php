<?php
$html = '<p>Please approve Purchase Order</p>';
$html .= '<p><a href="' . route('purchase-order.show', $purchase_order->id) . '">' . route('purchase-order.show', $purchase_order->id) . '</a></p>';
?>

{!! MailVariable::prepareData('

{{ header }}

<strong>Hello!</strong> <br /><br />' . $html . '

') !!}
