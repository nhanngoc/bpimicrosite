<?php

namespace App\Services\SAP;

use App\Models\SaleOrder;
use Illuminate\Support\Collection;
use function Symfony\Component\String\u;

class SapHelper
{
    /**
     * @param string $interface
     * @param SaleOrder $saleOrder
     * @return array|null
     */
    public function processCancel(string $interface, SaleOrder $saleOrder)
    {
        try {
            if (!$this->validateInterface($interface)) {
                return null;
            }
            if ($interface === 'SO') {
                $xmlFormat = $this->getFormatXMLCancelSO($saleOrder);
            }
            $apiUrl = $this->getUrlByInterface($interface);
            return $this->initCURL($xmlFormat, $apiUrl);

        } catch (\Exception $ex) {
            \Log::info('CancelSAP - ' . $interface . ' - ' . $ex->getMessage());
        }
    }

    /**
     * @param string $interface
     * @param $data
     * @return array|null
     */
    public function sendToSAP(string $interface, $data)
    {
        try {
            if (!$this->validateInterface($interface)) {
                return null;
            }

            if ($interface === 'SO') {
                $xmlFormat = $this->getFormatXMLSO($data);
            } elseif ($interface === 'PO') {
                $xmlFormat = $this->getFormatXMLPO($data);
            }
            $apiUrl = $this->getUrlByInterface($interface);
            return $this->initCURL($xmlFormat, $apiUrl);

        } catch (\Exception $ex) {
            \Log::info('SendSAP - ' . $interface . ' - ' . $ex->getMessage());
        }
    }

    /**
     * @param $data
     * @return string
     */
    public function getFormatXMLSO($data)
    {

        $lineCustomer = "01";
        $lineItem = 50;

        $xmlFormat = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:fi="http://cj.net/FI">
               <soapenv:Header/>
               <soapenv:Body>
                  <fi:MT_FI017>';
        $xmlFormat .= '<IMP_DOC_HEAD_MAN>
                        <BUKRS>' . $data->CompanyCode . '</BUKRS>
                        <LDGRP> </LDGRP>
                        <XBLNR>' . $data->ReferenceDocumentNumber . '</XBLNR>
                        <BLDAT>' . $data->DocumentDate . '</BLDAT>
                        <MONAT>' . substr($data->Period, 0, 2) . '</MONAT>
                        <BUDAT>' . $data->DocumentDate . '</BUDAT>
                        <BLART>' . $data->DocumentType . '</BLART>
                        <BKTXT>' . $data->DocumentHeaderText . '</BKTXT>
                        <KURSF>' . $data->ExchangeRate . '</KURSF>
                        <WAERS>' . $data->Currency . '</WAERS>
                     </IMP_DOC_HEAD_MAN>';

        // Line For DocumentType
        if ($data->DocumentType == 'RV' || $data->DocumentType == 'DN' || $data->DocumentType == 'DR' || $data->DocumentType == 'ZP') {
            $lineCustomer = "01";
            $lineItem = 50;
        } else if ($data->DocumentType == 'DG' || $data->DocumentType == 'AB') {
            $lineCustomer = 11;
            $lineItem = 40;
        } else if ($data->DocumentType == 'SC') {
            $lineCustomer = 40;
            $lineItem = 50;
        }

        $xmlFormatItemMain = '';
        $DocAmtTotal = 0;
        $LocalAmtTotal = 0;
        foreach ($data->items as $k => $item) {
            $DocAmt = $item->PRICE * $item->QTY;
            $LocalAmt = $item->PRICE * $item->QTY;
            if ($item->CURRENCY == 'USD') {
                $DocAmt = $item->PRICE * $item->QTY;
                $LocalAmt = ($item->PRICE * $item->QTY) * $item->EX_RATE;
            }

            $DocAmtTotal = $DocAmtTotal + $DocAmt;
            $LocalAmtTotal = $LocalAmtTotal + $LocalAmt;

            $xmlFormatItemMain .= '<IMT_DOC_ITEM_MAN>
                        <BUKRS>' . $data->CompanyCode . '</BUKRS>
                        <BSCHL>' . $lineItem . '</BSCHL>
                        <KUNNR> </KUNNR>
                        <WRBTR>' . $DocAmt . '</WRBTR>
                        <DMBTR>' . $LocalAmt . '</DMBTR>
                        <WW001>' . $data->BusinessType . '</WW001>
                        <WW002>' . $item->tradeType->trade_type . '</WW002>
                        <WW003>' . $item->cargoType->cargo_type . '</WW003>
                        <WW004>' . $item->Warehouse . '</WW004>
                        <WW005>' . $item->EndUser . '</WW005>
                        <WW006>' . $item->Region . '</WW006>
                        <WW007>' . $item->Incoterms . '</WW007>
                        <WW010>' . $data->MasterJob . '</WW010>
                        <WW012>' . $data->SalesPerson . '</WW012>
                        <WERKS> </WERKS>
                        <WW017>' . $data->SystemNumber . '</WW017>
                        <KMKDGR> </KMKDGR>
                        <WMWST> </WMWST>
                        <FWBAS> </FWBAS>
                        <MWSKZ>' . $item->TAX_CODE . '</MWSKZ>
                        <XMWST> </XMWST>
                        <VBUND> </VBUND>
                        <MATNR>' . $item->MATERIAL_CODE . '</MATNR>
                        <KOSTL> </KOSTL>
                        <SGTXT>' . ($k + 2) . 'Revenue Line </SGTXT>
                        <ZUONR>' . ($k + 2) . '_REV_LINE </ZUONR>
                        <ZTERM> </ZTERM>
                        <GSBER>VNHO</GSBER>
                        <XREF3> </XREF3>
                        <HKONT>' . $item->InternalGeneralLedgerAccount . '</HKONT>
                        <XREF1> </XREF1>
                        <XREF2> </XREF2>
                        <HBKID> </HBKID>
                        <HKTID> </HKTID>
                        <ZLSCH> </ZLSCH>
                     </IMT_DOC_ITEM_MAN>';
        }

        $xmlFormat .= '<IMT_DOC_ITEM_MAN>
                        <BUKRS>' . $data->CompanyCode . '</BUKRS>
                        <BSCHL>' . $lineCustomer . '</BSCHL>
                        <KUNNR>' . $data->Customer . '</KUNNR>
                        <WRBTR>' . $data->DocAmt . '</WRBTR>
                        <DMBTR>' . $data->DocAmt . '</DMBTR>
                        <WW001> </WW001>
                        <WW002> </WW002>
                        <WW003> </WW003>
                        <WW004> </WW004>
                        <WW005> </WW005>
                        <WW006> </WW006>
                        <WW007> </WW007>
                        <WW010> </WW010>
                        <WW012> </WW012>
                        <WERKS> </WERKS>
                        <WW017> </WW017>
                        <KMKDGR> </KMKDGR>
                        <WMWST> </WMWST>
                        <FWBAS> </FWBAS>
                        <MWSKZ> </MWSKZ>
                        <XMWST> </XMWST>
                        <VBUND> </VBUND>
                        <MATNR> </MATNR>
                        <KOSTL> </KOSTL>
                        <SGTXT>' . $lineCustomer . ' ARLine </SGTXT>
                        <ZUONR>' . $lineCustomer . ' ARLine </ZUONR>
                        <ZTERM>' . $data->PaymentTerm . '</ZTERM>
                        <GSBER>VNHO</GSBER>
                        <XREF3> </XREF3>
                        <HKONT>' . $data->ExternalGeneralLedgerAccount . '</HKONT>
                        <XREF1> </XREF1>
                        <XREF2> </XREF2>
                        <HBKID> </HBKID>
                        <HKTID> </HKTID>
                        <ZLSCH> </ZLSCH>
                     </IMT_DOC_ITEM_MAN>';
        $xmlFormat .= $xmlFormatItemMain;

        $xmlFormat .= '</fi:MT_FI017>
               </soapenv:Body>
            </soapenv:Envelope>';

        return $xmlFormat;
    }

    /**
     * get format XML PO
     *
     * @param $data
     * @return string
     */
    public function getFormatXMLPO($data)
    {
        $xmlFormat = '<soapenv:Envelope xmlns:soapenv = "http://schemas.xmlsoap.org/soap/envelope/" xmlns:mm = "http://cj.net/MM">
                            <soapenv:Header />
                                <soapenv:Body>
                                <mm:MT_MM001_S>';
        $xmlFormat .= '<IMP_PO_HEAD_MAN>
                            <CompanyCode>' . $this->checkNull($data->CompanyCode) . '</CompanyCode>
                            <PlantCode>' . $this->checkNull($data->PlantCode) . '</PlantCode>
                            <PurchasingOrg>' . $this->checkNull($data->PurchasingOrg) . '</PurchasingOrg>
                            <PurchasingDocType>' . $this->checkNull($data->PurchasingDocType) . '</PurchasingDocType>
                            <VendorID>' . $this->checkNull($data->VendorID) . '</VendorID>
                            <Currency>' . $this->checkNull($data->Currency) . '</Currency>
                            <PaymentTerm>' . $this->checkNull($data->PaymentTerm) . '</PaymentTerm>
                            <Incoterms>' . $this->checkNull($data->Incoterms) . '</Incoterms>
                            <BillBlock>' . $this->checkNull($data->BillBlock) . '</BillBlock>
                            <DocDate>' . $this->checkNull($this->formatSAPDateType($data->DocDate)) . '</DocDate>
                            <Remarks1>' . $this->checkNull($data->Remarks1) . '</Remarks1>
                            <Remarks2>' . $this->checkNull($data->Remarks2) . '</Remarks2>
                            <Remarks3>' . $this->checkNull($data->Remarks3) . '</Remarks3>
                            <Remarks4>' . $this->checkNull($data->Remarks4) . '</Remarks4>
                            <Remarks5>' . $this->checkNull($data->Remarks5) . '</Remarks5>
                            <Remarks6>' . $this->checkNull($data->Remarks6) . '</Remarks6>
                            <Remarks7>' . $this->checkNull($data->Remarks7) . '</Remarks7>
                            <RoutingCode>' . $this->checkNull($data->RoutingCode) . '</RoutingCode>
                            <WorkCenter>' . $this->checkNull($data->WorkCenter) . '</WorkCenter>
                            <HBK>' . $this->checkNull($data->HBK) . '</HBK>
                            <EndUser>' . $this->checkNull($data->EndUser) . '</EndUser>
                            <AgentCode>' . $this->checkNull($data->AgentCode) . '</AgentCode>
                            <DirCNDNInt>' . $this->checkNull($data->DirCNDNInt) . '</DirCNDNInt>
                            <Salesman>' . $this->checkNull($data->Salesman) . '</Salesman>
                            <CarrierCode>' . $this->checkNull($data->CarrierCode) . '</CarrierCode>
                            <CarrierType>' . $this->checkNull($data->CarrierType) . '</CarrierType>
                            <AreaFrom>' . $this->checkNull($data->AreaFrom) . '</AreaFrom>
                            <AreaTo>' . $this->checkNull($data->AreaTo) . '</AreaTo>
                            <EndUserGrp>' . $this->checkNull($data->EndUserGrp) . '</EndUserGrp>
                            <TradeType>' . $this->checkNull($data->TradeType) . '</TradeType>
                            <CargoType>' . $this->checkNull($data->CargoType) . '</CargoType>
                            <BusinessType>' . $this->checkNull($data->BusinessType) . '</BusinessType>
                            <Location>' . $this->checkNull($data->Location) . '</Location>
                            <POL>' . $this->checkNull($data->POL) . '</POL>
                            <POD>' . $this->checkNull($data->POD) . '</POD>
                            <PLD>' . $this->checkNull($data->PLD) . '</PLD>
                            <VendorOrigInvNo>' . $this->checkNull($data->VendorOrigInvNo) . '</VendorOrigInvNo>
                            <VendorInvNo>' . $this->checkNull($data->VendorInvNo) . '</VendorInvNo>
                            <MJobNo>' . $this->checkNull($data->MJobNo) . '</MJobNo>
                            <InterCoMjob>' . $this->checkNull($data->InterCoMjob) . '</InterCoMjob>
                            <ETA>' . $this->checkNull($this->formatSAPDateType($data->ETA)) . '</ETA>
                            <ETD>' . $this->checkNull($this->formatSAPDateType($data->ETD)) . '</ETD>
                            <OrigPONo>' . $this->checkNull($data->OrigPONo) . '</OrigPONo>
                            <ExPostingDate>' . $this->checkNull($this->formatSAPDateType($data->ExPostingDate)) . '</ExPostingDate>
                            <ExPostingDate2>' . $this->checkNull($this->formatSAPDateType($data->ExPostingDate2)) . '</ExPostingDate2>
                            <UserNo>' . $this->checkNull($data->UserNo) . '</UserNo>
                            <CargoClass>' . $this->checkNull($data->CargoClass) . '</CargoClass>
                            <Region>' . $this->checkNull($data->Region) . '</Region>
                            <BLNo>' . $this->checkNull($data->BLNo) . '</BLNo>
                            <ProcessType>' . $this->checkNull($data->ProcessType) . '</ProcessType>
                            <ProcessNo>' . $this->checkNull($data->ProcessNo) . '</ProcessNo>
                            <RefNo>' . $this->checkNull($data->RefNo) . '</RefNo>
                            <RefNo1>' . $this->checkNull($data->RefNo1) . '</RefNo1>
                            <RefNo2>' . $this->checkNull($data->RefNo2) . '</RefNo2>
                            <RefNo3>' . $this->checkNull($data->RefNo3) . '</RefNo3>
                            <RefNo4>' . $this->checkNull($data->RefNo4) . '</RefNo4>
                            <RefNo5>' . $this->checkNull($data->RefNo5) . '</RefNo5>
                            <RefNo6>' . $this->checkNull($data->RefNo6) . '</RefNo6>
                            <RefNo7>' . $this->checkNull($data->RefNo7) . '</RefNo7>
                            <ExecuteDate>' . $this->checkNull($data->ExecuteDate) . '</ExecuteDate>
                            <VehicleType>' . $this->checkNull($data->VehicleType) . '</VehicleType>
                            <TripType>' . $this->checkNull($data->TripType) . '</TripType>
                            <Transaction>' . $this->checkNull($data->Transaction) . '</Transaction>
                            <MChargeCode1>' . $this->checkNull($data->MChargeCode1) . '</MChargeCode1>
                            <MChargeCode2>' . $this->checkNull($data->MChargeCode2) . '</MChargeCode2>
                            <HChargeCode1>' . $this->checkNull($data->HChargeCode1) . '</HChargeCode1>
                            <HChargeCode2>' . $this->checkNull($data->HChargeCode2) . '</HChargeCode2>
                            <ShipperCode>' . $this->checkNull($data->ShipperCode) . '</ShipperCode>
                            <ShipperName>' . $this->checkNull($data->ShipperName) . '</ShipperName>
                            <ConsigneeCode>' . $this->checkNull($data->ConsigneeCode) . '</ConsigneeCode>
                            <ConsigneeName>' . $this->checkNull($data->ConsigneeName) . '</ConsigneeName>
                            <NetWeight>' . $this->checkNull($data->NetWeight) . '</NetWeight>
                            <GrossWeight>' . $this->checkNull($data->GrossWeight) . '</GrossWeight>
                            <SET>' . $this->checkNull($data->SET) . '</SET>
                            <M3>' . $this->checkNull($data->M3) . '</M3>
                            <KG>' . $this->checkNull($data->KG) . '</KG>
                            <Labour>' . $this->checkNull($data->Labour) . '</Labour>
                            <Qty>' . $this->checkNull($data->Qty) . '</Qty>
                            <UOM>' . $this->checkNull($data->UOM) . '</UOM>
                            <ManSOIndicator>' . $this->checkNull($data->ManSOIndicator) . '</ManSOIndicator>
                            <ExchangeRate>' . $this->checkNull($data->ExchangeRate) . '</ExchangeRate>
                            <RefNoType>' . $this->checkNull($data->RefNoType) . '</RefNoType>
                            <OrgDoc>' . $this->checkNull($data->OrgDoc) . '</OrgDoc>
                            <Invoice>' . $this->checkNull($data->Invoice) . '</Invoice>
                            <SystemNo>' . $this->checkNull($data->SystemNo) . '</SystemNo>
                            <MBKNo>' . $this->checkNull($data->MBKNo) . '</MBKNo>
                        </IMP_PO_HEAD_MAN>
                        <!--Zero or more repetitions:-->';


        $xmlFormatItems = '';
        $items = $data->purchaseOrderANSItems->all();
        foreach ($items as $item) {
            // if ($item->CURRENCY == 'USD') {
            //     $DocAmt = $item->PRICE * $item->QTY;
            //     $LocalAmt = ($item->PRICE * $item->QTY) * $item->EX_RATE;
            // }

            $xmlFormatItems .= '<IMT_PO_ITEM_MAN>
                                    <ITEM_NO>' . $this->checkNull($item->ITEM_NO) . '</ITEM_NO>
                                    <MATERIAL_CODE>' . $this->checkNull($item->MATERIAL_CODE) . '</MATERIAL_CODE>
                                    <DESCRIPTION1>' . $this->checkNull($item->DESCRIPTION1) . '</DESCRIPTION1>
                                    <DESCRIPTION2>' . $this->checkNull($item->DESCRIPTION2) . '</DESCRIPTION2>
                                    <PRICE>' . $this->checkNull($item->PRICE) . '</PRICE>
                                    <QTY>' . $this->checkNull($item->QTY) . '</QTY>
                                    <UOM>' . $this->checkNull($item->UOM) . '</UOM>
                                    <TAX_CODE>' . $this->checkNull($item->TAX_CODE) . '</TAX_CODE>
                                    <NET_VALUE>' . $this->checkNull($item->NET_VALUE) . '</NET_VALUE>
                                    <CURRENCY>' . $this->checkNull($data->Currency) . '</CURRENCY>
                                    <EX_RATE>' . $this->checkNull($data->ExchangeRate) . '</EX_RATE>
                                    <CONTAINER_TYPE>' . $this->checkNull($item->CONTAINER_TYPE) . '</CONTAINER_TYPE>
                                    <ORIG_QTY>' . $this->checkNull($item->ORIG_QTY) . '</ORIG_QTY>
                                    <ORIG_UOM>' . $this->checkNull($item->ORIG_UOM) . '</ORIG_UOM>
                                    <ORIG_AMOUNT>' . $this->checkNull($item->ORIG_AMOUNT) . '</ORIG_AMOUNT>
                                    <ORIG_CURRENCY>' . $this->checkNull($item->ORIG_CURRENCY) . '</ORIG_CURRENCY>
                                    <ORIG_EX_RATE>' . $this->checkNull($item->ORIG_EX_RATE) . '</ORIG_EX_RATE>
                                    <REMARK>' . $this->checkNull($item->REMARK) . '</REMARK>
                                    <CONTRACT_NO>' . $this->checkNull($item->CONTRACT_NO) . '</CONTRACT_NO>
                                    <CONTRACT_ITEM_NO>' . $this->checkNull($item->CONTRACT_ITEM_NO) . '</CONTRACT_ITEM_NO>
                                    <CONTRACT_SUB_ITEM_NO>' . $this->checkNull($item->CONTRACT_SUB_ITEM_NO) . '</CONTRACT_SUB_ITEM_NO>
                                    <SUB_ACCOUNT_NO>' . $this->checkNull($item->SUB_ACCOUNT_NO) . '</SUB_ACCOUNT_NO>
                                    <SEASON_CODE>' . $this->checkNull($item->SEASON_CODE) . '</SEASON_CODE>
                                    <DROP_POINT_ID>' . $this->checkNull($item->DROP_POINT_ID) . '</DROP_POINT_ID>
                                    <REF_DOC1>' . $this->checkNull($item->REF_DOC1) . '</REF_DOC1>
                                    <REF_DOC2>' . $this->checkNull($item->REF_DOC2) . '</REF_DOC2>
                                    <REF_DOC3>' . $this->checkNull($item->REF_DOC3) . '</REF_DOC3>
                                    <REF_DOC4>' . $this->checkNull($item->REF_DOC4) . '</REF_DOC4>
                                </IMT_PO_ITEM_MAN>';
        }

        $xmlFormat .= $xmlFormatItems;

        $xmlFormat .= '</mm:MT_MM001_S>
                    </soapenv:Body>
                </soapenv:Envelope>';

        return $xmlFormat;
    }

    /**
     * @param $data
     * @return string
     */
    public function getFormatXMLCancelSO($data)
    {
        $lineCustomer = 11;
        $lineItem = 40;
        $newDocumentType = '';
        // Line For DocumentType
        if ($data->DocumentType == 'RV' || $data->DocumentType == 'DR' || $data->DocumentType == 'ZP') {
            $lineCustomer = 11;
            $lineItem = 40;
            $newDocumentType = 'AB';
        } else if ($data->DocumentType == 'DN') {
            $lineCustomer = 11;
            $lineItem = 40;
            $newDocumentType = 'DG';
        } else if ($data->DocumentType == 'SC') {
            $lineCustomer = 50;
            $lineItem = 40;
            $newDocumentType = 'AB';
        }
        $data->DocumentType = $newDocumentType;
        $data->save();

        $xmlFormat = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:fi="http://cj.net/FI">
               <soapenv:Header/>
               <soapenv:Body>
                  <fi:MT_FI017>';
        $xmlFormat .= '<IMP_DOC_HEAD_MAN>
                        <BUKRS>' . $data->CompanyCode . '</BUKRS>
                        <LDGRP> </LDGRP>
                        <XBLNR>' . $data->ReferenceDocumentNumber . '</XBLNR>
                        <BLDAT>' . $data->DocumentDate . '</BLDAT>
                        <MONAT>' . substr($data->Period, 0, 2) . '</MONAT>
                        <BUDAT>' . $data->DocumentDate . '</BUDAT>
                        <BLART>' . $newDocumentType . '</BLART>
                        <BKTXT>' . $data->DocumentHeaderText . '</BKTXT>
                        <KURSF>' . $data->ExchangeRate . '</KURSF>
                        <WAERS>' . $data->Currency . '</WAERS>
                     </IMP_DOC_HEAD_MAN>';

        $xmlFormatItemMain = '';
        $DocAmtTotal = 0;
        $LocalAmtTotal = 0;
        foreach ($data->items as $k => $item) {
            $DocAmt = $item->PRICE * $item->QTY;
            $LocalAmt = $item->PRICE * $item->QTY;
            if ($item->CURRENCY == 'USD') {
                $DocAmt = $item->PRICE * $item->QTY;
                $LocalAmt = ($item->PRICE * $item->QTY) * $item->EX_RATE;
            }

            $DocAmtTotal = $DocAmtTotal + $DocAmt;
            $LocalAmtTotal = $LocalAmtTotal + $LocalAmt;

            $xmlFormatItemMain .= '<IMT_DOC_ITEM_MAN>
                        <BUKRS>' . $data->CompanyCode . '</BUKRS>
                        <BSCHL>' . $lineItem . '</BSCHL>
                        <KUNNR> </KUNNR>
                        <WRBTR>' . $DocAmt . '</WRBTR>
                        <DMBTR>' . $LocalAmt . '</DMBTR>
                        <WW001>' . $data->BusinessType . '</WW001>
                        <WW002>' . $item->tradeType->trade_type . '</WW002>
                        <WW003>' . $item->cargoType->cargo_type . '</WW003>
                        <WW004>' . $item->Warehouse . '</WW004>
                        <WW005>' . $item->EndUser . '</WW005>
                        <WW006>' . $item->Region . '</WW006>
                        <WW007>' . $item->Incoterms . '</WW007>
                        <WW010>' . $data->MasterJob . '</WW010>
                        <WW012>' . $data->SalesPerson . '</WW012>
                        <WERKS> </WERKS>
                        <WW017>' . $data->SystemNumber . '</WW017>
                        <KMKDGR> </KMKDGR>
                        <WMWST> </WMWST>
                        <FWBAS> </FWBAS>
                        <MWSKZ>' . $item->TAX_CODE . '</MWSKZ>
                        <XMWST> </XMWST>
                        <VBUND> </VBUND>
                        <MATNR>' . $item->MATERIAL_CODE . '</MATNR>
                        <KOSTL> </KOSTL>
                        <SGTXT>' . ($k + 2) . 'Revenue Line </SGTXT>
                        <ZUONR>' . ($k + 2) . '_REV_LINE </ZUONR>
                        <ZTERM> </ZTERM>
                        <GSBER>VNHO</GSBER>
                        <XREF3> </XREF3>
                        <HKONT>' . $item->InternalGeneralLedgerAccount . '</HKONT>
                        <XREF1> </XREF1>
                        <XREF2> </XREF2>
                        <HBKID> </HBKID>
                        <HKTID> </HKTID>
                        <ZLSCH> </ZLSCH>
                     </IMT_DOC_ITEM_MAN>';
        }

        $xmlFormat .= '<IMT_DOC_ITEM_MAN>
                        <BUKRS>' . $data->CompanyCode . '</BUKRS>
                        <BSCHL>' . $lineCustomer . '</BSCHL>
                        <KUNNR>' . $data->Customer . '</KUNNR>
                        <WRBTR>' . $data->DocAmt . '</WRBTR>
                        <DMBTR>' . $data->DocAmt . '</DMBTR>
                        <WW001> </WW001>
                        <WW002> </WW002>
                        <WW003> </WW003>
                        <WW004> </WW004>
                        <WW005> </WW005>
                        <WW006> </WW006>
                        <WW007> </WW007>
                        <WW010> </WW010>
                        <WW012> </WW012>
                        <WERKS> </WERKS>
                        <WW017> </WW017>
                        <KMKDGR> </KMKDGR>
                        <WMWST> </WMWST>
                        <FWBAS> </FWBAS>
                        <MWSKZ> </MWSKZ>
                        <XMWST> </XMWST>
                        <VBUND> </VBUND>
                        <MATNR> </MATNR>
                        <KOSTL> </KOSTL>
                        <SGTXT>' . $lineCustomer . ' ARLine </SGTXT>
                        <ZUONR>' . $lineCustomer . ' ARLine </ZUONR>
                        <ZTERM>' . $data->PaymentTerm . '</ZTERM>
                        <GSBER>VNHO</GSBER>
                        <XREF3> </XREF3>
                        <HKONT>' . $data->ExternalGeneralLedgerAccount . '</HKONT>
                        <XREF1>' . $data->RefSapNumberResponse . '</XREF1 >
                        <XREF2> </XREF2>
                        <HBKID> </HBKID>
                        <HKTID> </HKTID>
                        <ZLSCH> </ZLSCH>
                     </IMT_DOC_ITEM_MAN> ';
        $xmlFormat .= $xmlFormatItemMain;

        $xmlFormat .= '</fi:MT_FI017 >
               </soapenv:Body >
            </soapenv:Envelope > ';

        return $xmlFormat;
    }

    /**
     * @param string $interface
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getUrlByInterface(string $interface)
    {
        if (!$this->validateInterface($interface)) {
            return null;
        }
        $url = config('api-sap.SAP.URL') . "?senderParty=&senderService=" . config('api-sap.SAP.SENDER_SERVICE');
        if ($interface === "SO") {
            $url .= '&receiverParty=&receiverService=&interface=' . config('api-sap.SAP.INTERFACE_SO.FORMAT_XML') . '&interfaceNamespace=' . config('api-sap.SAP.INTERFACE_SO.NAMESPACE');
        } else if ($interface === "PO") {
            $url .= '&receiverParty=&receiverService=&interface=' . config('api-sap.SAP.INTERFACE_PO.FORMAT_XML') . '&interfaceNamespace=' . config('api-sap.SAP.INTERFACE_PO.NAMESPACE');
        } else {
            $url .= '';
        }
        return $url;
    }


    /**
     * Get Credentials
     *
     * @return string
     */
    protected function getCredentials()
    {
        return base64_encode(config('api-sap.SAP.USER') . ':' . config('api-sap.SAP.PASSWORD'));
    }

    /**
     * @param string $xml
     * @param string $apiUrl
     * @return array
     */
    protected function initCURL(string $xml, string $apiUrl)
    {
        $status = [];
        $credentials = $this->getCredentials();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => $xml,
            CURLOPT_HTTPHEADER     => array(
                'Authorization: Basic ' . $credentials,
                'Content-Type: application/xml'
            ),
        ));

        $response = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $status['status'] = $http_status;
        if ($http_status == 200) {
            $status['response'] = $response;
        } else {
            $status['response'] = null;
        }
        return $status;
    }

    /**
     * @param $date
     * @return false|string
     */
    protected function formatSAPDateType($date)
    {
        if (!$date) {
            return null;
        }
        return date_format(date_create($date), 'Ymd');
    }

    /**
     * @param string $interface
     * @return bool
     */
    protected function validateInterface(string $interface)
    {
        if (!is_array($this->interfaceTypes())) {
            return false;
        }
        if (in_array($interface, $this->interfaceTypes())) {
            return true;
        }
        return false;
    }

    /**
     * @return string[]
     */
    protected function interfaceTypes()
    {
        return ["SO", "PO"];
    }

    protected function checkNull($data)
    {
        if ($data) {
            return $data;
        }
        return " ";
    }
}
