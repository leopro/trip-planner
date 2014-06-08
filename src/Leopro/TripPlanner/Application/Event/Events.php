<?php

namespace Leopro\TripPlanner\Application\Event;

interface Events
{
    const PRE_COMMAND   = 'application.pre_command';
    const POST_COMMAND  = 'application.post_command';
    const EXCEPTION     = 'application.exception';
} 