<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 11/21/2018
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;


use App\City;
use App\Exceptions\ApiException;
use App\Exceptions\UserFriendlyException;
use App\Order;
use App\Page;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BasketController extends Controller
{
//    private const LIQPAY_PRIVATE_KEY = 'sandbox_8LFgWcW7saY2MYEyrPg7eUwMpqNcvOoexYO9hJOG';
//    private const LIQPAY_PUBLIC_KEY = 'sandbox_i36441580441';

//    private const LIQPAY_PRIVATE_KEY = 'ADTmPiGGHc3dlN7tyusvpwqmDWUknSCTnN3MA8Zd';
//    private const LIQPAY_PUBLIC_KEY = 'i9771221124';

    use Basket;

//    public const CHECKOUT_FIELDS = ['name', 'surname', 'phone_num', 'email', 'city', 'address', 'delivery', 'payment'];
//    public const REQUIRED_FIELDS = ['name', 'surname', 'phone_num', 'email', 'city', 'address', 'delivery', 'payment'];

//    private $translateService;
//
//    public function __construct(TranslateService $translateService)
//    {
//        $this->translateService = $translateService;
//    }
//    public function __invoke ()
//    {
//        $this->setAppLocale();
//        $this -> open();
//        $data = self::flattenData($this -> getData());
//        return view('basket',
//            array_merge($this->translateService->translateShopPage($this -> getMetaData('basket'), Page::class), [
//            'items' => $data,
//            'sum' => $this -> getSum($data),
////            'cssBase' => 'bagWishlist',
//        ]));
//    }

//    public function checkout () {
//        $this -> open();
//
//        $this -> open();
//        if (count($this -> items) == 0)
//            return redirect('/shop');
//
//        return view('checkout', array_merge($this -> getMetaData('checkout'), [
//            'sum' => $this -> getSum(self::flattenData($this -> getData())),
//            'cities' => City::all()
////            'cssBase' => 'placeOrder',
//        ]));
//    }

//
//    /**
//     * @param Order $order
//     * @throws UserFriendlyException
//     */
//    private function mailReports(Order $order) {
//        $mailVariables = [
//            'date' => $order -> created_at -> format('d.m.Y о H:i:s'),
//            'formattedBag' => self::flattenData($this -> getData()),
//            'city' => $order -> city(),
//            'address' => $order -> address,
//            'paymentMethod' => $order -> paymentMethod(),
//            'sum' => $order -> sum,
//        ];
//
//        try {
//            Mail::to($order -> email) -> send(new OrderCreated($mailVariables));
//
//            DefaultMail::adminMail() -> send(new OrderReport(array_merge($mailVariables, [
//                'name' => $order -> name.' '.$order -> surname,
//                'phone_num' => $order -> phone_num,
//                'email' => $order -> email,
//                'delivery' => $order -> deliveryType(),
//            ])));
//        } catch (ClientException $exception) {
//            throw new UserFriendlyException('Недійсна email-адреса...');
//        }
//
//    }


//    /**
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     * @throws UserFriendlyException
//     */
//    public function submit() {
//        $inputs = [];
//        foreach (self::CHECKOUT_FIELDS as $el)
//            $inputs[$el] = Input::get($el);
//
//        foreach (self::REQUIRED_FIELDS as $req)
//            if(!isset($inputs[$req]))
//                throw new ApiException('Field '.$req.' missing');
//
//        $this -> open();
//        $inputs['bag'] = json_encode($this -> items);
//        $inputs['sum'] = $this -> getSum(self::flattenData($this -> getData()));
//
//        if ($inputs['sum'] == 0)
//            throw new UserFriendlyException('Кошик порожній!');
//
//        // TODO Delivery is free of charge? o_O
//
//        $order = Order::create($inputs);
//
//        $this -> mailReports($order);
//
//        $this -> flush();
//
//        if ($inputs['payment'] == 'cash') {
//            $order -> completed = true;
//            return $this->finally();
//        } else {
//            list($u, $d, $s) = $this -> liqPayRequest(
//                'UAH',
//                $inputs['sum'],
//                LaravelLocalization::getCurrentLocale() == 'ua' ? 'uk' : LaravelLocalization::getCurrentLocale(),
//                $inputs['phone_num'],
//                $inputs['name'],
//                $order['id'],
//                function($link = '/') {
//                    return LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), $link);
//                }
//            );
//            $cssBase = 'error';
//
//            return view('payment', compact('u', 'd', 's', 'cssBase'));
//        }
//    }
//
//
//
//    public function success () {
//
//        $data = Input::get("data");
//        $signature = Input::get("signature");
//
//        $requireds = base64_encode(sha1(self::LIQPAY_PRIVATE_KEY.$data.self::LIQPAY_PRIVATE_KEY, 1));
//        if ($requireds != $signature)
//            throw new ApiException("ERROR B21: wrong signature");
//
//        // validate data
//        $rdata = (array) json_decode(base64_decode($data));
//        if (!$rdata)
//            throw new ApiException("ERROR B22: no data or data wrong format");
//
//        // get metadata
//        $mdata = (array) unserialize(base64_decode($rdata["dae"]));
//        if (!$mdata)
//            throw new ApiException("ERROR B23: no meta data in transaction or this data is wrong format");
//
//        // Validate status
//        switch ($st = $rdata["status"]) {
//            case "success":
//                break;
//            case "wait_accept":
//            /** @noinspection PhpMissingBreakStatementInspection */
//            case "sandbox":
//                if (env('APP_DEBUG'))
//                    break;
//
//            default:
//                throw new ApiException("ERROR B2: Transaction has got unexpected status: ".$st." Terminating...");
//        }
//
//        // Make needed order successfully paid (with rdata status)
//        $order = Order::findOrFail(intval(substr($mdata['id'], 5)));
//        $order -> update(['payment_received' => TRUE]);
//    }
//
//
//
//    /** @noinspection PhpTooManyParametersInspection */
//    public function liqPayRequest(
//        string $currency, string $sum, string $locale, string $phoneNum, string $userName,
//        $id, callable $uri
//    ) {
//        $data = array(
//            'public_key' => self::LIQPAY_PUBLIC_KEY,
//            'sandbox' => env('APP_DEBUG') ? 1 : 0,
//            'version' => '3',
//            'action' => 'pay',
//            'amount' => $sum,
//            'currency' => $currency,
//
//            'language' => $locale,
//            'phone' => $phoneNum,
//            'sender_first_name' => $userName,
//            'description' => 'Покупка на сайті SanaTech',
//            'order_id' => 'order'.$id,
//
//            'server_url' => $uri('/success-order'),
//            'result_url' => $uri('/order-complete'),
//            'dae' => base64_encode(serialize([
//                'id' => 'order'.$id
//            ]))
//
//        );
//
//        $encoded = base64_encode(json_encode($data));
//
//        $result[] = 'https://www.liqpay.ua/api/3/checkout';
//        $result[] = $encoded;
//        $result[] = base64_encode( sha1( self::LIQPAY_PRIVATE_KEY . $encoded . self::LIQPAY_PRIVATE_KEY, 1 ) );
//
//        return $result;
//    }
//
//
//
//
//    public function finally () {
//        return view('purchaseCompleted', $this -> getMetaData('finally'));
//    }
}
