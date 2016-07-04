<?php

namespace FieldTypes\Console;

use Composer\Script\Event;
use Exception;

class Installer
{
    public static function postInstall(Event $event)
    {
        $io = $event->getIO();
        $io->write('Oh yeah!');
        return;
    }

}
