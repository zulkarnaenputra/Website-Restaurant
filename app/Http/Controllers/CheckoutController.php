<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Facility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use validator;

class CheckoutController extends Controller
{
    public function index(Request $request, $id)
    {
        $item = Transaction::with(['details','facility','user'])->findOrFail($id);

        return view('pages.checkout',[
            'item' => $item
        ]);
    }

    public function process(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        $transaction = Transaction::create([
            'facilities_id' => $id,
            'users_id' => Auth::user()->id,
            'person' => '1',
            'transaction_total' => $facility->price,
            'transaction_status' => 'IN_CART'
        ]);

        $request->validate([
            'username' => 'required|string',
            'no_handphone' => 'required|max:255',
            'the_person' => 'required|integer',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'massage' => 'required',
        ]);        

        $data = $request->all();
        $data['transactions_id'] = $id;
        
        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'the_person' => $request->the_person,
            'massage' => $request->massage,
            'no_handphone' => $request->no_handphone
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function remove(Request $request, $detail_id)
    {
        $item = TransactionDetail::findorFail($detail_id);

        $transaction = Transaction::with(['details','facility'])
            ->findOrFail($item->transactions_id);

        if($request->the_person)
        {
            $transaction->transaction_total -= 1;
            $transaction->person -= 1;
        }

        $transaction->transaction_total -= $transaction->facility->price;

        $transaction->save();
        $item->delete();

        return redirect()->route('checkout', $item->transactions_id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'the_person' => 'required|integer',
            'massage' => 'required',
            'no_handphone' => 'required|max:255',
        ]);

        //VALIDASI JAM
        $this->validate($request, [
            'time_start' => 'date_format:H:i',
            'time_end' => 'date_format:H:i|after:time_start',
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

        //disini transaction detail ngambil validasi dari $data yang dibuat diatas
        TransactionDetail::create($data);

        $transaction = Transaction::with(['facility'])->find($id);

        if($request->the_person)
        {
            $transaction->transaction_total += 1;
            $transaction->person += 1;
        }

        $transaction->transaction_total += $transaction->facility->price;

        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        return view('pages.success');
    }
}
