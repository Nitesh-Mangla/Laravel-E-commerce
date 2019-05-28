<?php

namespace App\Http\Controllers\paytmKit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class configPaytm extends Controller
{
    public function config()
	{
		define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
		define('PAYTM_MERCHANT_KEY', 'kaGe9TaDdGZmYvWJ'); //Change this constant's value with Merchant key received from Paytm.
		define('PAYTM_MERCHANT_MID', 'UpBrig99467335208831'); //Change this constant's value with MID (Merchant ID) received from Paytm.
		define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); //Change this constant's value with Website name received from Paytm.

		$PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
		$PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
		if (PAYTM_ENVIRONMENT == 'PROD') {
			$PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
			$PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
		}

		define('PAYTM_REFUND_URL', '');
		define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
		define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
		define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
	}
}
