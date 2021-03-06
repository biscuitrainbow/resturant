<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TableType;
use App\Table;
use App\Member;
use App\Menu;
use App\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class ReservationController extends Controller
{

    public function show(Reservation $reservation)
    {
        return view('reservation-detail', compact('reservation'));
    }
    public function create()
    {
        $members = Member::all();
        $tables = Table::all();
        return view('reservation-create', compact('tables', 'members'));
    }

    public function next(Request $request)
    {

        $tables = Table::with('reservations')->whereDoesntHave('reservations', function ($query) use ($request) {
            $query->whereDate('date_time', Carbon::instance(new \DateTime($request->date_time))->toDateString())->where('section', $request->section);
        })->orderBy('name')->get();

        $menus = Menu::with('type')->orderBy('menu_type_id')->get();
        $detail = $request->all();

        if ($request->filled('member')) {
            $member = 1;

            $m = Member::find($request->member);

            $accumulate_array = $m->reservations->map(function ($item, $key) {
                return $item->net_price;
            });

            $accumulate = $accumulate_array->sum() % 10000;

        } else {
            $accumulate = -10000;
            $member = 0;
            $ac_net_price = 0;
        }

        return view('reservation-food', compact('menus', 'detail', 'member', 'accumulate', 'tables'));
    }


    public function receipt(Request $request)
    {

        $detail = json_decode($request->detail, true);

        $reservation = Reservation::create([
            'name' => $detail['name'],
            'lastname' => $detail['lastname'],
            'tel' => $detail['tel'],
            'member_id' => $detail['member'],
            'user_id' => Auth::user()->id,
            'seat' => $detail['seat'],
            'type' => $detail['type'],
            'section' => $detail['section'],
            'total_price' => $request->total_price,
            'net_price' => $request->net_price,
            'status' => 'Waiting',
            'date_time' => Carbon::instance(new \DateTime($detail['date_time']))->toDateTimeString()
        ]);

        $reservation->tables()->sync($request->table);

        $menus = collect($request->menus);
        $menus->each(function ($menu) use ($reservation) {
            $item = json_decode($menu, true);
            $reservation->menus()->attach([$item['id'] => ['quantity' => $item['qty'], 'discount' => $item['discount'] * $item['qty']]]);
        });

        return redirect('reservation');

    }
    public function index(Request $request, $print = null)
    {
        $reservations = Reservation::filter($request->all())->get();
        $price_array = $reservations->map(function ($item, $key) {
            return $item->net_price;
        });

        $menus = $reservations->map(function ($rev) {
            return $rev->menus;
        });

        $menus = $menus->flatten();
        $unique_menu = $menus->unique('name');

        $menus = $unique_menu->map(function ($menu) use ($menus) {
            $menu->qty = $menus->where('id', $menu->id)->count();
            return $menu;
        });



        $net_price = $price_array->sum();

        if ($request->has('print')) {
            $pdf = PDF::loadView('reservation-index-pdf', compact('reservations', 'net_price', 'menus'));
            return $pdf->download('invoice.pdf');
        }

        $fullUrl = $request->fullUrl();
        return view('reservation-index', compact('reservations', 'net_price', 'fullUrl'));
    }
    public function delete(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->back();
    }

    public function printReceipt(Reservation $reservation)
    {
        $reservation->menus;

        $pdf = PDF::loadView('reservation-pdf', compact('reservation'));
        return $pdf->download('invoice.pdf');
         ///return view('reservation-pdf',compact('reservation'));
    }


    public function printReport()
    {
        
        //$pdf = PDF::loadView('reservation-pdf', compact('reservation'));
        //return $pdf->download('invoice.pdf');
         ///return view('reservation-pdf',compact('reservation'));
    }

    public function filter(Request $request)
    {
        return Reservation::filter($request->all())->get();
    }

    public function update(Reservation $reservation, Request $request)
    {

        $reservation->update([
            'status' => $request->status
        ]);

        return redirect()->back();
    }
}
