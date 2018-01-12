<?php

namespace Skytells\Contracts\Support;

interface MessageProvider
{
    /**
     * Get the messages for the instance.
     *
     * @return \Skytells\Contracts\Support\MessageBag
     */
    public function getMessageBag();
}
