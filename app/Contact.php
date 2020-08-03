<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sanitization;

class Contact extends Model
{
    use Sanitization;

    /**
     * Validation rules.
     *
     * @var mixed[]
     */
    public static $rules = [
        'name' => ['required', 'string', 'max:100', "regex:/^[a-zA-Z0-9',.!? ]*$/"],
        'email' => ['required', 'string', 'max:100', 'email:rfc,strict,dns,spoof,filter'],
        'subject' => ['required', 'string', 'max:100', "regex:/^[a-zA-Z0-9',.!? ]*$/"],
        'message' => ['required', 'string', 'max:1000', "regex:/^[a-zA-Z0-9',.!? ]*$/"]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'subject', 'message'
    ];

    /**
     * Return name of contact.
     *
     * @return string|null
     */
    public function getName() : ?string
    {
        $name = $this->getAttribute('name');

        return is_string($name) ? $this->cleanPost($name) : null;
    }

    /**
     * Return email of contact.
     *
     * @return string|null
     */
    public function getEmail() : ?string
    {
        $email = $this->getAttribute('email');

        return is_string($email) ? $this->cleanPost($email) : null;
    }

    /**
     * Return subject of contact.
     *
     * @return string|null
     */
    public function getSubject() : ?string
    {
        $subject = $this->getAttribute('subject');

        return is_string($subject) ? $this->cleanPost($subject) : null;
    }

    /**
     * Return message of contact.
     *
     * @return string|null
     */
    public function getMessage() : ?string
    {
        $message = $this->getAttribute('message');

        return is_string($message) ? $this->cleanPost($message) : null;
    }
}
