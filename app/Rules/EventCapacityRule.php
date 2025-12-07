<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EventCapacityRule implements Rule
{
    protected $available_tickets;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($available_tickets)
    {
        $this->available_tickets = $available_tickets;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        return $value <= $this->available_tickets;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sự kiện đã hết vé. Vui lòng đặt số lượng vé ít hơn.';
    }
}
