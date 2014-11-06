<?php
namespace Gopher\Providers;

class GopherProviders
{
    const GOPHER_MAP = <<<gophermap
--Rogue--
    Thursday, September 26th, 2013
Ah, Rogue. One of the greatest games ever. You've sucked me back in.
0Continued...	0006-rogue

--Infinity Blade III--
    Monday, September 23th, 2013
Holy cow, is this game awesome. I'm only about an hour in, and already the
story is great, the music and graphics are incredible, the gameplay is
familiar yet also very fresh, and there's a whole new skill system. This is an
excellent follow-up to Infinity Blade 2 and has only solidified how much of a
fan of the series I am.
0Continued...	0005-infinity-blade-3

--Bitmessage--
    Thursday, August 29th, 2013
So, if you are looking into using or trying out bitmessage, think again.
0Continued...	0004-bitmessage
gophermap;

    public static function itemUrlProvider()
    {
        return array(
            array(3, '0006-rogue'),
            array(12, '0005-infinity-blade-3'),
            array(17, '0004-bitmessage'),
        );
    }
}
