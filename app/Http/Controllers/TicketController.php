<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('tickets.index', [
            'tickets' => Ticket::where(['user_id' => auth()->id()])->whereDate('created_at', today())->get(),
            'contact' => "",
            'fromDate' => "",
            'toDate' => "",
        ]);
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact' => ['required'],
        ]);
        $ticket = new Ticket();
        $ticket->user_id = auth()->id();
        $ticket->username = auth()->user()->username;
        $ticket->ticket_id = date('Ymd') . date('His');
        $ticket->contact = $request->contact;
        $ticket->client_name = $request->client_name;
        $ticket->n_i_f = $request->n_i_f;
        $ticket->email = $request->email;
        $ticket->city = $request->city;
        $ticket->address = $request->address;
        $ticket->type = $request->type;
        $ticket->mark = $request->mark;
        $ticket->model = $request->model;
        $ticket->imei_no = $request->imei_no;
        $ticket->warranty = $request->warranty;
        $ticket->repair = $request->repair;
        $ticket->observ_of_damag = $request->observ_of_damag;
        $ticket->technician = $request->technician;
        $ticket->deliver_date = $request->deliver_date;
        $ticket->payment = $request->payment;
        $ticket->total = $request->total;
        $ticket->received = $request->received;
        $ticket->balance = $request->balance;
        $ticket->save();
        return redirect()->route('tickets.show', $ticket->id);
    }

    public function show(Ticket $ticket)
    {
        // dd($ticket);
        return view('tickets.show', [
            'ticket' => $ticket,
        ]);
    }


    public function cdtho()
    {
        return view('tickets.cdtho', [
            'ticket' => '',
            'contact' => '',
        ]);
    }


    public function cdtho_update(Request $request)
    {
        $request->validate([
            'contact' => ['required'],
        ]);
        $ticket = Ticket::where(['user_id' => auth()->id(), 'contact' => $request->contact])->first();

        return view('tickets.cdtho', [
            'ticket' => $ticket,
            'contact' => $request->contact,
        ]);
    }


    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', __('Deleted Successfully'));
    }
    public function history(Request $request)
    {
        $request->validate([
            'fromDate' => ['nullable', 'required_with:toDate'],
            'contact' => ['required_if:fromDate,null'],
        ]);
        if ($request->contact) {
            $tickets = Ticket::where(['user_id' => auth()->id()])->where('contact', 'LIKE', "%$request->contact%")->get();
        } else {
            $toDate = $request->toDate ?? today();

            $startDate = date('Y-m-d', strtotime($request->fromDate));
            $endDate = date('Y-m-d', strtotime($toDate));

            $tickets = Ticket::where(['user_id' => auth()->id()])
                ->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate)
                ->get();
        }
        return view('tickets.index', [
            'tickets' => $tickets,
            'contact' => $request->contact ?? "",
            'fromDate' => $request->fromDate ?? "",
            'toDate' => $request->toDate ?? "",
        ]);
    }
}
