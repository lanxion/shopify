<?php 
namespace Shopify;

class Shopify extends ShopifyClient
{

    public function __construct($config)
    {
        parent::__construct($config['username'], $config['access_token'], $config['client_id'], $config['client_secret']);

    }

    public function getOrders($lastUpdateTime , $status = 'any')
    {
        $condition = [
            'updated_at_min' => $lastUpdateTime,
            'status' => $status,
        ];
        return $this->call('GET', '/admin/orders.json', $condition);
    }

    public function getOrder($orderId)
    {
        return $this->call('GET', '/admin/orders/'.$orderId.'.json');
    }

    public function modifyOrder($orderId, $data)
    {
        $order['order'] = $data;
        return $this->call('PUT', '/admin/orders.json'.$orderId.'.json', $order);
    }

    public function getCountry()
    {
        return $this->call('GET', '/admin/countries.json');
    }

    public function completeSale($orderId, $data)
    {
        $order['fulfillment'] = $data;
        return $this->call('POST', '/admin/orders/'.$orderId.'/fulfillments.json', $order);
    }

    public function getShippingZone()
    {
        return $this->call('GET', '/admin/shipping_zones.json');
    }
}
?>