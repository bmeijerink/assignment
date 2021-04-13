<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 */
class Message extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['encrypted_message', 'hashed_password'];

    /**
     * @var string
     */
    public $encryptedMessage;

    /**
     * @var string
     */
    public $hashedPassword;

    /**
     * @var bool
     */
    public $timestamps = false;


}
