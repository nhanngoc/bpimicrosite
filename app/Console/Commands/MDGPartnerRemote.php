<?php

namespace App\Console\Commands;

use App\Models\MDGPartner;
use App\Repositories\MDGPartner\Interfaces\MDGPartnerInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MDGPartnerRemote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mdg:remote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Partner From MDG SQL SERVER';
    /**
     * @var MDGPartnerInterface
     */
    protected $mdgPartnerRepository;

    /**
     * MDGPartnerRemote constructor.
     *
     * @param MDGPartnerInterface $mdgPartnerRepository
     */
    public function __construct(
        MDGPartnerInterface $mdgPartnerRepository
    )
    {
        parent::__construct();
        $this->mdgPartnerRepository = $mdgPartnerRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Remote new MDG...');
        try {
            @ini_set('max_execution_time', -1);
            @ini_set('memory_limit', -1);
            $insert_data = collect();
            $update_data = collect();
            $connection = \DB::connection('sqlsrv');
            $partners = $connection->table('MDG_Partner')->get();
            DB::beginTransaction();
            if ($partners->count() > 0) {
                foreach ($partners as $partner) {
                    $check_exits = $this->mdgPartnerRepository->getFirstBy([
                        'PARTNER'  => $partner->PARTNER,
                        'BUKRS'    => $partner->BUKRS,
                        'BU_SORT1' => $partner->BU_SORT1
                    ]);
                    if (!$check_exits) {
                        $data = [
                            'PARTNER'                 => trim($partner->PARTNER),
                            'BUKRS'                   => trim($partner->BUKRS),
                            'BU_SORT1'                => trim($partner->BU_SORT1),
                            'GFLAG'                   => trim($partner->GFLAG),
                            'LFLAG'                   => trim($partner->LFLAG),
                            'IF_STATUS'               => trim($partner->IF_STATUS),
                            'NAME1'                   => trim($partner->NAME1),
                            'NAME2'                   => trim($partner->NAME2),
                            'NAME3'                   => trim($partner->NAME3),
                            'NAME4'                   => trim($partner->NAME4),
                            'NAME_CO'                 => trim($partner->NAME_CO),
                            'STR_SUPPL1'              => trim($partner->STR_SUPPL1),
                            'STR_SUPPL2'              => trim($partner->STR_SUPPL2),
                            'STR_SUPPL3'              => trim($partner->STR_SUPPL3),
                            'STREET'                  => trim($partner->STREET),
                            'LOCATION'                => trim($partner->LOCATION),
                            'CITY2'                   => trim($partner->CITY2),
                            'POST_CODE1'              => trim($partner->POST_CODE1),
                            'CITY1'                   => trim($partner->CITY1),
                            'COUNTRY'                 => trim($partner->COUNTRY),
                            'TEL_NUMBER'              => trim($partner->TEL_NUMBER),
                            'MOB_NUMBER'              => trim($partner->MOB_NUMBER),
                            'FAX_NUMBER'              => trim($partner->FAX_NUMBER),
                            'STCD1'                   => trim($partner->STCD1),
                            'STCD2'                   => trim($partner->STCD2),
                            'STCEG'                   => trim($partner->STCEG),
                            'XDELE'                   => trim($partner->XDELE),
                            'VENDOR_OR_CUSTOMER_G'    => trim($partner->VENDOR_OR_CUSTOMER_G),
                            'REF_01'                  => trim($partner->REF_01),
                            'REMARKS_G'               => trim($partner->REMARKS_G),
                            'CRDAT'                   => date('Y-m-d', strtotime($partner->CRDAT)),
                            'CHDAT'                   => date('Y-m-d', strtotime($partner->CHDAT)),
                            'ECONTACT_PERSON'         => trim($partner->ECONTACT_PERSON),
                            'VENDOR_CONTACT_GROUP'    => trim($partner->VENDOR_CONTACT_GROUP),
                            'CUSTOMER_CONTACT_GROUP'  => trim($partner->CUSTOMER_CONTACT_GROUP),
                            'INTER_CO'                => trim($partner->INTER_CO),
                            'IS_USE_BILL2PARTY_SAP_G' => trim($partner->IS_USE_BILL2PARTY_SAP_G),
                            'SMTP_ADDR'               => trim($partner->SMTP_ADDR),
                            'AKONT_C'                 => trim($partner->AKONT_C),
                            'AKONT_V'                 => trim($partner->AKONT_V),
                            'ZTERM1'                  => trim($partner->ZTERM1),
                            'ZWELS'                   => trim($partner->ZWELS),
                            'BUSAB'                   => trim($partner->BUSAB),
                            'WAERS'                   => trim($partner->WAERS),
                            'LOEVM'                   => trim($partner->LOEVM),
                            'SALES_PERSON_NO'         => trim($partner->SALES_PERSON_NO),
                            'IS_CONSOLE_BILLING'      => trim($partner->IS_CONSOLE_BILLING),
                            'IS_USE_FWS'              => trim($partner->IS_USE_FWS),
                            'IS_USE_WMS'              => trim($partner->IS_USE_WMS),
                            'IS_USE_TMS'              => trim($partner->IS_USE_TMS),
                            'IS_USE_LTS'              => trim($partner->IS_USE_LTS),
                            'IS_BL_BLOCK'             => trim($partner->IS_BL_BLOCK),
                            'CONTACT_TYPE_NO'         => trim($partner->CONTACT_TYPE_NO),
                            'VENDOR_OR_CUSTOMER_L'    => trim($partner->VENDOR_OR_CUSTOMER_L),
                            'LCONTACT_PERSON'         => trim($partner->LCONTACT_PERSON),
                            'IS_USE_BILL2PARTY_SAP_L' => trim($partner->IS_USE_BILL2PARTY_SAP_L),
                            'REMARKS_L'               => trim($partner->REMARKS_L),
                            'created_at'              => Carbon::now(),
                            'updated_at'              => Carbon::now()
                        ];
                        $insert_data->push($data);
                    } else {

                        $CHDAT = date('Y-m-d', strtotime($check_exits->CHDAT));
                        $PCHDAT = date('Y-m-d', strtotime($partner->CHDAT));
                        if ($PCHDAT > $CHDAT) {
                            echo $PCHDAT;
                            $dataU = [
                                'PARTNER'                 => trim($partner->PARTNER),
                                'BUKRS'                   => trim($partner->BUKRS),
                                'BU_SORT1'                => trim($partner->BU_SORT1),
                                'GFLAG'                   => trim($partner->GFLAG),
                                'LFLAG'                   => trim($partner->LFLAG),
                                'IF_STATUS'               => trim($partner->IF_STATUS),
                                'NAME1'                   => trim($partner->NAME1),
                                'NAME2'                   => trim($partner->NAME2),
                                'NAME3'                   => trim($partner->NAME3),
                                'NAME4'                   => trim($partner->NAME4),
                                'NAME_CO'                 => trim($partner->NAME_CO),
                                'STR_SUPPL1'              => trim($partner->STR_SUPPL1),
                                'STR_SUPPL2'              => trim($partner->STR_SUPPL2),
                                'STR_SUPPL3'              => trim($partner->STR_SUPPL3),
                                'STREET'                  => trim($partner->STREET),
                                'LOCATION'                => trim($partner->LOCATION),
                                'CITY2'                   => trim($partner->CITY2),
                                'POST_CODE1'              => trim($partner->POST_CODE1),
                                'CITY1'                   => trim($partner->CITY1),
                                'COUNTRY'                 => trim($partner->COUNTRY),
                                'TEL_NUMBER'              => trim($partner->TEL_NUMBER),
                                'MOB_NUMBER'              => trim($partner->MOB_NUMBER),
                                'FAX_NUMBER'              => trim($partner->FAX_NUMBER),
                                'STCD1'                   => trim($partner->STCD1),
                                'STCD2'                   => trim($partner->STCD2),
                                'STCEG'                   => trim($partner->STCEG),
                                'XDELE'                   => trim($partner->XDELE),
                                'VENDOR_OR_CUSTOMER_G'    => trim($partner->VENDOR_OR_CUSTOMER_G),
                                'REF_01'                  => trim($partner->REF_01),
                                'REMARKS_G'               => trim($partner->REMARKS_G),
                                'CRDAT'                   => date('Y-m-d', strtotime($partner->CRDAT)),
                                'CHDAT'                   => date('Y-m-d', strtotime($partner->CHDAT)),
                                'ECONTACT_PERSON'         => trim($partner->ECONTACT_PERSON),
                                'VENDOR_CONTACT_GROUP'    => trim($partner->VENDOR_CONTACT_GROUP),
                                'CUSTOMER_CONTACT_GROUP'  => trim($partner->CUSTOMER_CONTACT_GROUP),
                                'INTER_CO'                => trim($partner->INTER_CO),
                                'IS_USE_BILL2PARTY_SAP_G' => trim($partner->IS_USE_BILL2PARTY_SAP_G),
                                'SMTP_ADDR'               => trim($partner->SMTP_ADDR),
                                'AKONT_C'                 => trim($partner->AKONT_C),
                                'AKONT_V'                 => trim($partner->AKONT_V),
                                'ZTERM1'                  => trim($partner->ZTERM1),
                                'ZWELS'                   => trim($partner->ZWELS),
                                'BUSAB'                   => trim($partner->BUSAB),
                                'WAERS'                   => trim($partner->WAERS),
                                'LOEVM'                   => trim($partner->LOEVM),
                                'SALES_PERSON_NO'         => trim($partner->SALES_PERSON_NO),
                                'IS_CONSOLE_BILLING'      => trim($partner->IS_CONSOLE_BILLING),
                                'IS_USE_FWS'              => trim($partner->IS_USE_FWS),
                                'IS_USE_WMS'              => trim($partner->IS_USE_WMS),
                                'IS_USE_TMS'              => trim($partner->IS_USE_TMS),
                                'IS_USE_LTS'              => trim($partner->IS_USE_LTS),
                                'IS_BL_BLOCK'             => trim($partner->IS_BL_BLOCK),
                                'CONTACT_TYPE_NO'         => trim($partner->CONTACT_TYPE_NO),
                                'VENDOR_OR_CUSTOMER_L'    => trim($partner->VENDOR_OR_CUSTOMER_L),
                                'LCONTACT_PERSON'         => trim($partner->LCONTACT_PERSON),
                                'IS_USE_BILL2PARTY_SAP_L' => trim($partner->IS_USE_BILL2PARTY_SAP_L),
                                'REMARKS_L'               => trim($partner->REMARKS_L),
                                'updated_at'              => Carbon::now()
                            ];
                            $check_exits->fill($dataU);
                            $u = $this->mdgPartnerRepository->createOrUpdate($check_exits);
                        }
                    }
                }
                unset($partner);
                $chunks = $insert_data->chunk(500);
                if ($chunks->count() > 0) {
                    foreach ($chunks as $chunk) {
                        \DB::table('mdg_partners')->insert($chunk->toArray());
                    }
                }
                DB::commit();
            }

        } catch (\Exception $exception) {
            //echo $exception->getMessage();
            $this->error('Remote error.');
            $this->error($exception->getMessage());
            return 1;
        }
    }
}
