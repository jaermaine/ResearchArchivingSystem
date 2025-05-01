<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CoAuthorService
{
    private const SESSION_KEY = 'co_authors_data';
    
    public static function setCoAuthors(array $coAuthors)
    {
        Log::info('Setting co-authors: ' . json_encode($coAuthors));
        Session::put(self::SESSION_KEY, $coAuthors);
        Log::info('Co-authors set in session');
    }
    
    public static function getCoAuthors()
    {
        $coAuthors = Session::get(self::SESSION_KEY, []);
        Log::info('Getting co-authors from session: ' . json_encode($coAuthors));
        return $coAuthors;
    }
    
    public static function clearCoAuthors()
    {
        Session::forget(self::SESSION_KEY);
        Log::info('Co-authors cleared from session');
    }
}