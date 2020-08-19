<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Product_model;

class Product extends Controller
{
    public function __construct()
    {
        $this->product = new Product_model();
    }

    public function index()
    {
        return $this->response->setJSON($this->product->findData()); 
    }
}