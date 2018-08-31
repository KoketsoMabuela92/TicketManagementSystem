<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the log ticket view.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $request->user()->authorizeRoles(['normal']);
        logger($request->user());
        logger($request->user()->roles[0]['name']);
        if ($request->user()->roles[0]['name'] === 'normal') {

            return view('logTicket');
        }
        return view('home');
    }

    /**
     * Store the ticket details.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function submitTicket (Request $request)
    {
        $request->user()->authorizeRoles(['normal']);
        logger($request->user()->id);
        logger($request->user()->roles[0]['name']);
        logger($request);

        if ($request->user()->roles[0]['name'] === 'normal') {

            try {

                Validator::make($request->post(), [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email',
                    'msisdn' => 'required|regex: /^[0-9]{10}+$/',
                    'department' => 'required|string',
                    'issue' => 'required|string',
                ])->validate();

                $ticket = new Ticket();
                $ticket->user_id = $request->user()->id;
                $ticket->ticket_ref = date('YmdHis');
                $ticket->first_name = $request['first_name'];
                $ticket->last_name = $request['last_name'];
                $ticket->email = $request['email'];
                $ticket->msisdn = $request['msisdn'];
                $ticket->department = $request['department'];
                $ticket->issue = $request['issue'];
                $saveTicketRes = $ticket->save();

                if (true === $saveTicketRes) {

                    logger('Ticket details saved successfully. Sending email to: '.$ticket->email);

                    if (true === $this->sendEmail($ticket->ticket_ref, $ticket->email)) {

                        return redirect('/success_request');
                    }

                    return redirect('/technical_error');
                }

            } catch (ValidationException $e) {

                logger('Technical error '.$e->getMessage());

                return redirect('/technical_error');
            }

        } else {

            logger('Unauthorzed user');

            return redirect('/bad_request');
        }
    }

    /**
     * View logged tickets.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function viewTickets (Request $request) {

        $request->user()->authorizeRoles(['normal']);
        if ($request->user()->roles[0]['name'] === 'normal') {

            try {

                $tickets = Ticket::all();
                $dataTable = DataTables::make($tickets)->make(true);

                if (null !== $tickets) {

                    return view('loggedTickets', ['tickets' => $dataTable]);
                    // return view('loggedTickets', ['tickets' => $tickets]);
                }

            } catch (ValidationException $e) {

                logger('Technical error '.$e->getMessage());

                return redirect('/technical_error');
            }

        } else {

            logger('Unauthorzed user');

            return redirect('/bad_request');
        }
    }

    /**
     * Method that sends an email address with ticket ref
     *
     * @param String $ticketRef, String $emailAddress
     * @return bool
     */
    private function sendEmail ($ticketRef, $emailAddress) {

        $isMailSent = mail($emailAddress, 'TicketManagementSystem', 'Your ticket has been successfully logged, please use this reference to check it\'s status: '.$ticketRef);
        if (true === $isMailSent) {

            return true;
        }

        return false;
    }
}
