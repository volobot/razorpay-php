<?php

namespace Razorpay\Api;

use Requests;

class Payment extends Entity
{
    /**
     * @param $id Payment id
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function all($options = array())
    {
        if(isset($options['X-Razorpay-Account'])){
            $request = new Request;
            $request->addHeader('X-Razorpay-Account', $options['X-Razorpay-Account']);

            unset($options['X-Razorpay-Account']);
        }

        return parent::all($options);
    }

    /**
     * Patches given payment with new attributes
     *
     * @param array $attributes
     *
     * @return Payment
     */
    public function edit($attributes = array())
    {
        $url = $this->getEntityUrl() . $this->id;

        return $this->request(Requests::PATCH, $url, $attributes);
    }

    /**
     * @param $id Payment id
     */
    public function refund($attributes = array())
    {
        $refund = new Refund;

        $attributes = array_merge($attributes, array('payment_id' => $this->id));

        return $refund->create($attributes);
    }

    /**
     * @param $id Payment id
     */
    public function capture($attributes = array())
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/capture';

        return $this->request('POST', $relativeUrl, $attributes);
    }

    public function transfer($attributes = array())
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/transfers';

        return $this->request('POST', $relativeUrl, $attributes);
    }

    public function refunds()
    {
        $refund = new Refund;

        $options = array('payment_id' => $this->id);

        return $refund->all($options);
    }

    public function transfers()
    {
        $transfer = new Transfer();

        $transfer->payment_id = $this->id;

        return $transfer->all();
    }

    public function bankTransfer()
    {
        $relativeUrl = $this->getEntityUrl() . $this->id . '/bank_transfer';

        return $this->request('GET', $relativeUrl);
    }

    public function createRecurring($attributes = array())
    {
        $relativeUrl = $this->getEntityUrl() . 'create/recurring';
 
        return $this->request('POST', $relativeUrl, $attributes);   
    }
}
