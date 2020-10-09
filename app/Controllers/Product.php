<?php namespace App\Controllers;

use App\Models\Product_model;

class Product extends BaseController
{
    public function __construct()
    {
        $this->product = new Product_model();
    }

    public function index()
    {
       $rows = $this->product->findAll();
       return $this->success($rows);
    }
}