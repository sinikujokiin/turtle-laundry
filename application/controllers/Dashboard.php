<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!isLogin()) {
			danger("Anda belum login, silahkan login terlebih dahulu");
			redirect('login');
		}

	}

	public function index()
	{
		access('dashboard-read','redirect');

		$where = [];
		if (user()->role == 'Staff') {
			$where = ['created_by' => user()->id];
		}

		$transactions = new Transaction;
		$allTransaction = $transactions->where($where)->count();
		$doneTransaction = $transactions->where($where)->where('status', 'sudah diambil')->count();
		$dueDate = $transactions->where($where)->with(['member'])->where('due_date', '<=' ,date('Y-m-d'))->where('status','!=', 'sudah diambil')->orderBy('due_date', 'ASC')->orderBy('due_time', 'ASC')->get();
		$data = [
			'title' => 'Dashboard',
			'breadcrumb' => 'Dashboard',
			'lastTransaction' => Transaction::orderBy('created_at','DESC')->where($where)->limit(5)->get(),
			'users' => User::select('users.*')->selectRaw('COUNT(t.id) AS count, SUM(t.total) as total')->selectSub(function ($query) {
			        $query->selectRaw('COUNT(member_id)')->from('transactions as st')->whereColumn('st.id', 't.id')->groupBy('member_id');
			    }, 'member_count')->leftJoin('transactions as t', 't.created_by', '=', 'users.id')->where($where)->groupBy('users.id')->orderBy('count', 'desc')->limit(5)->get(),
			'allTransaction' => $allTransaction,
			'doneTransaction' => $doneTransaction,
			'dueDate'	=> $dueDate

			// 'users'			=> $this->db->select('count(transactions.id) as count, users.*')->join('transactions','transactions.created_by=users.id')->group_by('created_by')->get('users', 5)->result_array()
		];

		// var_dump($data['users']);die;

		$this->template->load('templates/cms','cms/dashboard', $data,FALSE);
	}

	function getDataPenghasilan($element)
	{
		access('dashboard-pendapatan','redirect');
		if ($element == 'today') {
			$transactions = Transaction::whereDate('created_at',date("Y-m-d"))->get();
		}else if ($element == 'yesterday') {
			$transactions = Transaction::whereDate('created_at','>=',date('Y-m-d', strtotime("-1 day")))->get();
		}else if ($element == 'week') {
			$transactions = Transaction::whereDate('created_at','>=',date('Y-m-d', strtotime("-7 day")))->get();
		}else if ($element == 'month') {
			$transactions = Transaction::whereDate('created_at','>=',date('Y-m').'-1')->get();
		}else if ($element == 'lastmonth') {
			$transactions = Transaction::whereDate('created_at','>=',date('Y-m', strtotime("-1 month")).'-1')->whereDate('created_at','<',date('Y-m').'-1')->get();
		}

		// var_dump($transactions, date('Y-m', strtotime("-1 month")).'-1',date('Y-m').'-1' );die;

		$sudahdibayar = 0;
		$belumdibayar = 0;

		foreach ($transactions as $value) {
			if ($value->payment_status == 'belum dibayar') {
				$belumdibayar += $value->total;
			}else{
				$sudahdibayar += $value->total;
			}
		}

		echo json_encode(['belum' => $belumdibayar, 'sudah' => $sudahdibayar]);
	}
}
