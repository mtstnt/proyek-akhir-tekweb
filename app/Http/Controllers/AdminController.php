<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

		return view('admin/index', [
			'title' => 'Dashboard'
		]);
	}

	public function list() {

		return view('admin/storage', [
			'title' => 'Storage list'
		]);
	}

	public function orders() {

		return view('admin/orders', [
			'title' => 'Orders'
		]);
	}
}
