<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Contact;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;

class ContactsController extends Controller
{
    protected $contact_repository;

    public function __construct(ContactRepositoryInterface $contact_list_repository) {
        $this->contact_repository = $contact_list_repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contacts = $this->contact_repository->getAll();
        return response()->json($contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ContactRequest $request)
    {
        $this->contact_repository->store($request->all());
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $contact_info =  $this->contact_repository->getByID($id);
        return response()->json($contact_info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $contact_info = $this->contact_repository->getByID($id);
        return response()->json($contact_info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, ContactRequest $request)
    {
        $requestData = $request->all();
        if($this->contact_repository->update($id,$requestData))
        {
            return response()->json(["success"=>true,"message"=> "Contact Info is updated."]);
        }
        return response()->json(["status"=>false,"message"=> "Something went wrong"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        if($this->contact_repository->destroy($id))
        {
            Session::flash('flash_message', 'ContactList deleted!');
            return response()->json(["status"=>true,"message"=> "Contact Deleted Successfully."]);
        }
        return response()->json(["status"=>false,"message"=> "Invalid Deletion Request!"]);
    }
}
