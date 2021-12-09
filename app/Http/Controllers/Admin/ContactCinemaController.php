<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactCinema;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;

class ContactCinemaController extends Controller
{

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver)
    {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contact.cinema.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cinema = new ContactCinema();

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'cord' => 'required',
            'main_img' => '|mimes:jpeg,jpg,png|max:5000',
        ]);


        $data = $request->all();


        $data['main_img'] = $this->imageSaver->upload($request, null, 'hall');

        $cinema->create($data);


        return redirect(route('contact.create'))->withSuccess('Кинотеатр был успешно добавлен!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactCinema  $contactCinema
     * @return \Illuminate\Http\Response
     */
    public function show(ContactCinema $contactCinema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactCinema  $contactCinema
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactCinema $contactCinema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactCinema  $contactCinema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactCinema $contactCinema)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'cord' => 'required',
            'main_img' => '|mimes:jpeg,jpg,png|max:5000',
        ]);


        $data = $request->all();


        $data['main_img'] = $this->imageSaver->upload($request, null, 'contact');

        $contactCinema->updates($data, $contactCinema);


        return redirect(route('contact.edit', 1))->withSuccess('Кинотеатр был успешно обновлен!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactCinema  $contactCinema
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactCinema $contactCinema)
    {
        //
    }
}
