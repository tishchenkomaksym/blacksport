<?php


namespace App\Services;


use App\Models\Order;
use App\Models\Product as ProductModel;
use TCG\Voyager\Models\Setting;
use WayForPay\SDK\Collection\ProductCollection;
use WayForPay\SDK\Credential\AccountSecretCredential;
use WayForPay\SDK\Domain\Client;
use WayForPay\SDK\Domain\Product;
use WayForPay\SDK\Wizard\InvoiceWizard;

class PaymentService
{
    private const WAYFORPAY_LOGIN = 'blacksport_org';
    private const WAYFORPAY_SECRET_KEY = '3f88d950a4ce39f85b27c2aa5e75592656b7c880';

    private function wayForPayRequest($client, $products, $order)
    {
        $credential = new AccountSecretCredential(self::WAYFORPAY_LOGIN, self::WAYFORPAY_SECRET_KEY);
        $clientEntity = new Client(
            $client['name'],
            null,
            $client['email'],
            $client['phone']
        );

        $productsCollection = new ProductCollection($products);

        try {
            $response = InvoiceWizard::get($credential)
                                     ->setOrderReference($order->id)
                                     ->setAmount(1)
                                     ->setCurrency('UAH')
                                     ->setOrderDate(new \DateTime())
                                     ->setMerchantDomainName('https://blacksport.org')
                                     ->setClient($clientEntity)
                                     ->setProducts($productsCollection)
                                     ->setServiceUrl(route('api.check-response'))
                                     ->getRequest()
                                     ->send();

            return response()->json(['url' => $response->getInvoiceUrl()], 200);
        } catch (ApiException $e) {
            return response()->json(['error' => 'Exception: ' . $e->getMessage() . PHP_EOL]);
        }
    }

    public function handlePayment($client, $products)
    {
        $wayForPayProducts = $this->parseProducts($products, $client);
        $order = $this->createOrder($client, $products);

        if ($client['online_payment']){
            return $this->wayForPayRequest($client, $wayForPayProducts, $order);
        }else{
            return response()->json(['success' => 'order created'], 201);
        }
    }

    private function createOrder($client, $products): Order
    {
        $delivery = Setting::where('key', 'admin.post_delivery_price')->first();
        return Order::create([
            'name' => $client['name'],
            'phone' => $client['phone'],
            'email' => $client['email'],
            'products' => json_encode($products),
            'delivery' => $client['delivery'],
            'payment_method' => $client['payment_method'] ?? null,
            'post_branch' => $client['post_branch'] ?? '',
            'comment' => $client['comment'] ?? '',
            'address' => $client['address'] ?? '',
            'online_payment' => $client['online_payment'],
            'post_delivery_price' => $delivery->value,
            'total_price' => $this->totalPrice($products, $delivery)
        ]);

    }

    private function totalPrice($products, $delivery)
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $productModel = ProductModel::findOrFail($product['id']);
            $totalPrice += $productModel->price * $product['quantity'];
        }
        $totalPrice = $totalPrice + $delivery->value;
        return $totalPrice;
    }

    private function parseProducts($products, $client): array
    {
        $array = [];
        foreach ($products as $product) {
            $productModel = ProductModel::findOrFail($product['id']);
            $productModel->order_count = ++$productModel->order_count;
            $productModel->save;
            If($client['online_payment']){
                $array[] = new Product(
                    $product['name'],
                    $product->price,
                    $product['quantity']
                );
            }

        }

        return $array;
    }
}
