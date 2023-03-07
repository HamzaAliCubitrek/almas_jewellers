@php
    $greet = '';
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date('H');
    /* Set the $timezone variable to become the current timezone */
    $timezone = date('e');
    /* If the time is less than 1200 hours, show good morning */
    if ($time < '12') {
        $greet = 'Good morning';
    } /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */ elseif ($time >= '12' && $time < '17') {
        $greet = 'Good afternoon';
    } /* Should the time be between or equal to 1700 and 1900 hours, show good evening */ elseif ($time >= '17' && $time < '19') {
        $greet = 'Good evening';
    } /* Finally, show good night if the time is greater than or equal to 1900 hours */ elseif ($time >= '19') {
        $greet = 'Good night';
    }
@endphp
<!-- Navbar -->

<!-- /.navbar -->
