<?php
$html = '<p>This Purchase Order was canceled.</p>';
$html .= '<p><a href="' . route('purchase-order.edit', $purchase_order->id) . '">' . route('purchase-order.edit', $purchase_order->id) . '</a></p>';
?>

{!! MailVariable::prepareData('

{{ header }}

<strong>Hello!</strong> <br /><br />' . $html . '

') !!}
