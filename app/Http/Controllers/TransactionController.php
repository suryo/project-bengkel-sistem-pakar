<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\SparePart;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transactions = Transaction::latest()->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $spareParts = SparePart::where('stock', '>', 0)->get();
        $services = Service::all();
        return view('transactions.create', compact('spareParts', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'vehicle_model' => 'nullable|string|max:255',
            'license_plate' => 'nullable|string|max:20',
            'items' => 'required|array|min:1',
            'items.*.type' => 'required|in:service,part',
            'items.*.id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $transaction = Transaction::create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'vehicle_model' => $request->vehicle_model,
                'license_plate' => $request->license_plate,
                'status' => 'pending',
                'notes' => $request->notes,
                'total_price' => 0, // Will be calculated
            ]);

            $totalPrice = 0;

            foreach ($request->items as $item) {
                $price = 0;
                $name = '';
                
                if ($item['type'] === 'part') {
                    $part = SparePart::findOrFail($item['id']);
                    if ($part->stock < $item['quantity']) {
                        throw new \Exception("Stock for {$part->name} is insufficient.");
                    }
                    $price = $part->price;
                    $part->decrement('stock', $item['quantity']);
                    $name = $part->name;
                } else {
                    $service = Service::findOrFail($item['id']);
                    $price = $service->price;
                    $name = $service->name;
                }

                $subtotal = $price * $item['quantity'];
                $totalPrice += $subtotal;

                // Create detail
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'item_id' => $item['id'],
                    'item_type' => $item['type'],
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
            }

            $transaction->update(['total_price' => $totalPrice]);

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error creating transaction: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('transactionDetails');
        // Helper to get names for details (could be optimized with relations but polymorphic is manual here)
        foreach($transaction->transactionDetails as $detail) {
            if($detail->item_type == 'part') {
                $detail->item_name = SparePart::find($detail->item_id)->name ?? 'Unknown Part';
            } else {
                $detail->item_name = Service::find($detail->item_id)->name ?? 'Unknown Service';
            }
        }
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        // Restore stock if transaction cancelled/deleted? For simplicity, we just delete
        // ideally we should check status or have a cancel method.
        // For strict CRUD, we delete.
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
