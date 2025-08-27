<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BulkRechargeCard;
use App\Models\RechargeBulkPin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BulkAirtime extends Component
{
    public $business_name;
    public $network;
    public $amount;
    public $quantity;

    public $airtimes;
    public $selectedAirtime = null;

    // For showing the modal
    public $showModal = false;
    // For deletion confirmation modal
    public $confirmingNoticeDeletion = false;
    public $selectedNoticeId;


    // For notice details modal
    public $viewingNoticeDetails = false;


    protected $rules = [
        'business_name' => 'required|string|max:255',
        'network' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0.01',
        'quantity' => 'required|integer|min:1',
    ];

    public function submit()
    {
        $this->validate();

        $input = [
            'admin_id' => Auth::id(),
            'business_name' => $this->business_name,
            'network' => $this->network,
            'amount' => $this->amount,
            'quantity' => $this->quantity,
        ];

        // Call the bulk airtime generation process
        //  i feel this should come aftr genereate-epin
        $transaction = $this->postEPinTransaction($input);

        if ($transaction) {
            $gen_pin = $this->generate_e_pin($transaction);

            if ($gen_pin) {
                session()->flash('success', 'Bulk airtime generated successfully.');
            } else {
                session()->flash('error', 'Error generating airtime pins.');
            }
        } else {
            session()->flash('error', 'Transaction failed.');
        }
    }

    public function postEPinTransaction($input)
    {
        $tr = new BulkRechargeCard();
        $tr->user_id = $input['admin_id'];
        $tr->reference = Str::random(7);
        $tr->business_name = $input['business_name'];
        $tr->network = $input['network'];
        $tr->amount = $input['amount'];
        $tr->quantity = $input['quantity'];
        $tr->save();

        if ($tr) {
            return $tr;
        } else {
            return false;
        }
    }

    public function generate_e_pin($trx)
    {
        if ($trx->network == "MTN") {
            $service = "MTNEPIN";
        } elseif ($trx->network == "AIRTEL") {
            $service = "AIRTELEPIN";
        } elseif ($trx->network == "GLO") {
            $service = "GLOEPIN";
        } elseif ($trx->network == "9MOBILE") {
            $service = "9MOBILEEPIN";
        }

        $json = [
            "reference" => $trx->reference,
            "network" => $trx->network,
            "service" => $service,
            "value" => $trx->amount,
            "quantity" => $trx->quantity
        ];

        $response = $this->makeBillPaymentApiCallElec($json, 'https://sagecloud.ng/api/v2/epin/purchase', $trx->id);


        // if ($response) {
        //     session()->flash('success', 'no error in makeBillPaymentApiCallElec .'.$response.'.');
        // } else {
        //     session()->flash('error', $response);
        // }

        if ($response) {
            // Convert the response array to a JSON string
            $responseJson = json_encode($response);
            session()->flash('success', 'no error in makeBillPaymentApiCallElec. Response: ' . $responseJson);
        } else {
            session()->flash('error', 'Error occurred: ' . json_encode($response));
        }

        if (isset($response['status']) && $response['status'] == 'success') {
            foreach ($response['data'] as $item) {
                $np = new RechargeBulkPin();
                $np->bulk_recharge_card_id = $trx->id;
                $np->reference = $trx->reference;
                $np->pin = $item['pin'];
                $np->serial_number = $item['serial_number'];
                $np->amount = $item['Amount'];
                $np->instruction = $item['instruction'];
                $np->save();
            }

            return true;
        } else {
            return false;
        }
    }

    private function makeBillPaymentApiCallElec($json, $url, $trx_id)
    {
        $da = $this->newsagerequestauth();
        // Log the response for debugging purposes
        // Log::info('Newsage Request Auth Response', ['response' => $da]);

        // // Flash the response to session for display in the view
        // Session::flash('newsage_response', $da);
        $token = $da['data']['token']['access_token'];

        try {
            $data = $json;

            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $token,
                        'Content-Type: application/json',
                        'Accept: application/json'
                    ),
                )
            );

            $response = curl_exec($curl);
            curl_close($curl);
            Session::flash('newsage_response', json_decode($response, true));
            return json_decode($response, true);
        } catch (\Exception $exception) {
            return ['status' => 'error', 'message' => $exception->getMessage()];
        }
    }

   

    public function newsagerequestauth()
    {
        $url = "https://sagecloud.ng/api/v2/merchant/authorization";

        $username = 'SCPub-L-e835b2cfb8c8490b9111cb4cf17425ae';
        $password = 'SCSec-L-643cd874219b4ee7949b85bf7d0e0926';
        // Encode the credentials as base64
        $credentials = base64_encode("{$username}:{$password}");

        $client = new  \GuzzleHttp\Client();

        $result = $client->post($url, [

            //'json' => $data,

            'headers' => [

                'Content-Type' => 'application/json',

                'Authorization' => 'Basic ' . $credentials

            ],

        ]);

        return $response = json_decode($result->getBody(), true);
    }






    public function mount()
    {
        // $this->published_by = Auth::user()->name;
        $this->fetchPrintedAirtime();
    }

    public function confirmDelete($noticeId)
    {
        $this->confirmingNoticeDeletion = true;
        $this->selectedNoticeId = $noticeId;
    }


    public function fetchPrintedAirtime()
    {
        $this->airtimes = BulkRechargeCard::orderBy('created_at', 'desc')->get();
    }


    public function viewDetails($airtimeId)
    {
        $this->selectedAirtime = BulkRechargeCard::find($airtimeId);
        $this->viewingNoticeDetails = true;
    }


    public function render()
    {
        return view('livewire.bulk-airtime');
    }
}
