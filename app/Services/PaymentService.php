<?php


namespace App\Services;


use App\Models\Order;
use App\Models\Product as ProductModel;
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

            return $response->getInvoiceUrl();
        } catch (ApiException $e) {
            return 'Exception: ' . $e->getMessage() . PHP_EOL;
        }
    }

    public function handlePayment($client, $products)
    {
        $products = $this->parseProducts($products, $client);
        $order = $this->createOrder($client, $products);

        if ($client['online_payment']){
            $this->wayForPayRequest($client, $products, $order);
        }else{
            return response()->json(['success' => 'order created'], 201);
        }
    }

    private function createOrder($client, $products): Order
    {
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
            'online_payment' => $client['online_payment']
        ]);

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
                    $product['price'],
                    $product['quantity']
                );
            }

        }

        return $array;
    }
}
