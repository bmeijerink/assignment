<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class MessageController extends Controller
{
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
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Renderable
     */
    public function store(Request $request): Renderable
    {
        $messageContent = $request->input('messagecontent');

        $password = str_random(8);
        $hashedPassword = Hash::make($password);

        $iv = '8907345f8907345f';
        $encryptedMessage = openssl_encrypt($messageContent, 'AES-256-CBC', $password, 0, $iv);

        $message = Message::create(['encrypted_message' => $encryptedMessage, 'hashed_password' => $hashedPassword]);
        $insertedId = $message->__get('id');

        $url = URL::to('/') . '/message/' . $insertedId;

        return view('encrypt', array('message' => $message, 'url' => $url, 'password' => $password));
    }

    /**
     * Ask for the password to be entered.
     *
     * @param string $url
     * @return Renderable
     */
    public function password(string $url): Renderable
    {
        return view('decrypt', array('url' => $url));
    }

    /**
     * Display the decrypted message.
     *
     * @param Request $request
     * @return Renderable
     */
    public function show(Request $request): Renderable
    {
        $id = $request->input('id');
        $password = $request->input('password');
        $decryptedMessage = '';

        $message = Message::where('id', $id)->first();

        if (is_object($message)) {
            $encryptedMessage = $message->getAttributes()['encrypted_message'];
            $hashedPassword = $message->getAttributes()['hashed_password'];

            if (Hash::check($password, $hashedPassword) === true) {
                $iv = '8907345f8907345f';
                $decryptedMessage = openssl_decrypt($encryptedMessage, 'AES-256-CBC', $password, 0, $iv);
            }
        }

        return view('show', array('decryptedMessage' => $decryptedMessage, 'id' => $id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        Message::destroy($id);
    }
}
