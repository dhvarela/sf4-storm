<?php

namespace App;

final class Events
{
    /**
     * @Event("Symfony\Component\EventDispatcher\GenericEvent")
     *
     * @var string
     */
    public const PROFILE_SEEN = 'profile.seen';
}
