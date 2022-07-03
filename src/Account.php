<?php

namespace Razorpay\Api;

class Account extends Entity
{
    protected function getEntityUrl()
    {
        return "beta/accounts/";
    }

    /**
     * @param $id Customer id description
     */
    public function fetch($id)
    {
        return parent::fetch($id);
    }

    public function all($options = array())
    {
        return parent::all($options);
    }

    public function create($attributes = array())
    {
        return parent::create($attributes);
    }

    public function edit($attributes = null)
    {
        $entityUrl = $this->getEntityUrl() . $this->id;

        return $this->request('PUT', $entityUrl, $attributes);
    }
}
