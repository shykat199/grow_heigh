<?php

use App\Models\Country;
use App\Models\StudyArea;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Jenssegers\Agent\Agent;
use App\Models\City;
use App\Models\University;

function show_queries()
{
    $queries = DB::getQueryLog();
    $totalTime = collect($queries)->sum('time');

    $queries = collect($queries)->map(function($q){
        $q['sql_with_bindings'] = vsprintf(
            str_replace('?', "'%s'", $q['query']),
            $q['bindings']
        );
        return $q;
    })->toArray();

    dd([
        'total_queries' => count($queries),
        'total_time_ms' => $totalTime,
        'queries' => $queries,
    ]);
}

function active_class($path, $active = 'active') {
    return request()->is(...(array)$path) ? $active : '';
}

function is_active_route($path) {
    return request()->is(...(array)$path) ? 'true' : 'false';
}

function show_class($path) {
    return request()->is(...(array)$path) ? 'show' : '';
}

function getSettingsData($input = null)
{
    if (empty($input)) {
        $data = \App\Models\SiteSetting::pluck('value', 'key')
            ->toArray();
    } elseif (is_array($input)) {
        $data = \App\Models\SiteSetting::whereIn('key', $input)
            ->pluck('value', 'key')
            ->toArray();
    } else {
        $item = \App\Models\SiteSetting::select('value', 'key')->where('key', $input)->first();

        $data = empty($item) ? '' : $item->value;
    }

    return $data;
}

function getCountryFormData($input = null)
{
    if (empty($input)) {
        $data = \App\Models\CountryForm::pluck('country_form', 'country')
            ->toArray();
    } elseif (is_array($input)) {
        $data = \App\Models\CountryForm::whereIn('country', $input)
            ->pluck('country_form','country')
            ->toArray();
    } else {
        $item = \App\Models\CountryForm::select('country_form', 'country')->where('country', $input)->first();

        $data = empty($item) ? '' : $item->country_form;
    }

    return $data;
}

function getSiteSettingsData($settingArray, $level)
{

    foreach ($settingArray as $key => $item) {
        if ($key == $level) {
            return $item;
        }
    }

}

function formatDate($date, string $format = 'd-M-Y H:i:s')
{

    return \Illuminate\Support\Carbon::parse($date)->format($format);
}

function generateUniversityId()
{
    $lastUniversity = \App\Models\University::orderBy('id', 'desc')->first();

    if (!$lastUniversity) {
        $number = 1;
    } else {
        $lastId = $lastUniversity->university_id;
        $number = (int) str_replace('UNI', '', $lastId) + 1;
    }

    return 'UNI' . str_pad($number, 3, '0', STR_PAD_LEFT);
}

function storeFile ($file, $pathPrefix) {
    $ext = $file->getClientOriginalExtension();
    $fileName = time() . '_' . uniqid('', true) . '.' . $ext;
    $path = rtrim($pathPrefix, '/') . '/' . $fileName;
    Storage::disk('public')->putFileAs($pathPrefix, $file, $fileName);
    return $path;
}

//function updateFile($file, $folderPath, $existingFile = null) {
//
//    $ext = $file->getClientOriginalExtension();
//    $fileName = time() . '_' . uniqid('', true) . '.' . $ext;
//
//    $folderPath = rtrim($folderPath, '/');
//
//    Storage::disk('public')->putFileAs($folderPath, $file, $fileName);
//
//    if ($existingFile) {
//        Storage::disk('public')->delete($existingFile);
//    }
//
//    return $folderPath . '/' . $fileName;
//}

//function updateFile($file, $folderPath, $existingFile = null, $quality = 95)
//{
//    $manager = new ImageManager(new Driver());
//
//    $folderPath = rtrim($folderPath, '/');
//
//    $fileName = time() . '_' . uniqid('', true) . '.webp';
//
//    $relativePath = $folderPath . '/' . $fileName;
//    $fullPath = storage_path('app/public/' . $relativePath);
//
//    if (!Storage::disk('public')->exists($folderPath)) {
//        Storage::disk('public')->makeDirectory($folderPath);
//    }
//
//    $image = $manager->read($file->getRealPath());
//
//    $image->sharpen(8);
//
//    $image->toWebp($quality)->save($fullPath);
//
//    if ($existingFile && Storage::disk('public')->exists($existingFile)) {
//        Storage::disk('public')->delete($existingFile);
//    }
//
//    return $relativePath;
//}

function updateFile($file, $folderPath, $existingFile = null, $quality = 95){

    $manager = new ImageManager(new Driver());

    $folderPath = rtrim($folderPath, '/');

    // Get original extension
    $extension = strtolower($file->getClientOriginalExtension());

    // Generate filename
    $fileName = time() . '_' . uniqid('', true) . '.' . ($extension === 'webp' ? 'webp' : 'webp');

    $relativePath = $folderPath . '/' . $fileName;
    $fullPath = storage_path('app/public/' . $relativePath);

    if (!Storage::disk('public')->exists($folderPath)) {
        Storage::disk('public')->makeDirectory($folderPath);
    }

    if ($extension === 'webp') {
        $file->storeAs($folderPath, $fileName, 'public');
    } else {
        $image = $manager->read($file->getRealPath());
        $image->sharpen(8);
        $image->toWebp($quality)->save($fullPath);
    }

    if ($existingFile && Storage::disk('public')->exists($existingFile)) {
        Storage::disk('public')->delete($existingFile);
    }

    return $relativePath;
}
function newUpdateFile($file, $folderPath, $existingFile = null, $quality = 75)
{
    if (!$file || !$file->isValid()) {
        throw new \RuntimeException('Invalid uploaded file');
    }

    // Extra safety: ensure it's an image
    if (!str_starts_with($file->getMimeType(), 'image/')) {
        throw new \RuntimeException('Uploaded file is not an image');
    }

    $manager = new ImageManager(new Driver());

    $folderPath = rtrim($folderPath, '/');
    $fileName = time() . '_' . uniqid('', true) . '.webp';
    $relativePath = $folderPath . '/' . $fileName;

    if (!Storage::disk('public')->exists($folderPath)) {
        Storage::disk('public')->makeDirectory($folderPath);
    }

    // ✅ IMPORTANT: pass file object, NOT realPath
    $image = $manager->read($file);
    $image->toWebp($quality)
        ->save(storage_path('app/public/' . $relativePath));

    // Delete old image AFTER successful save
    if ($existingFile && Storage::disk('public')->exists($existingFile)) {
        Storage::disk('public')->delete($existingFile);
    }

    return $relativePath;
}

function countryCount(){
    return Country::count();
}

function cityCount(){
    return \App\Models\City::count();
}

function universityCount(){
    return \App\Models\University::count();
}

function universityCourseCount(){
    return \App\Models\Course::count();
}

function universityActiveStudyAreaCount(){
    return \App\Models\StudyArea::where('status',ACTIVE_STATUS)->count();
}

function universityInactiveStudyAreaCount(){
    return \App\Models\StudyArea::where('status',PENDING_STATUS)->count();
}

function generateOtpCode($length = 6): int
{
    $min = pow(10, $length - 1);
    $max = pow(10, $length) - 1;

    return random_int($min, $max);
}

function device()
{
    return new Agent();
}

function isMobile()
{
    return (new Agent())->isMobile();
}

function isTablet()
{
    return (new Agent())->isTablet();
}

function isDesktop()
{
    $agent = new Agent();
    return ! $agent->isMobile() && ! $agent->isTablet();
}

function getFolderImages($folderPath, $limit = null)
{
    $fullPath = public_path($folderPath);

    if (!is_dir($fullPath)) {
        return [];
    }

    $files = File::files($fullPath);
    $images = [];

    foreach ($files as $file) {
        $images[] = asset($folderPath . '/' . basename($file));
    }

    if ($limit) {
        $images = array_slice($images, 0, $limit);
    }

    return $images;
}

function slugPreserveLevel($string)
{
    $string = preg_replace_callback('/\(L\d+\)/', function ($matches) {
        return '-' . strtoupper(trim($matches[0], '()'));
    }, $string);

    return Str::slug($string);
}
function formatRoleName($slug) {

    $slug = preg_replace('/-L(\d+)/', ' (L$1)', $slug);

    $slug = str_replace('-', ' ', $slug);

    return preg_replace_callback('/\b[a-z]/', function ($match) {
        return strtoupper($match[0]);
    }, $slug);
}

function getAllCountries($countryId = null, $columns = ['id', 'name', 'slug'])
{
    $query = Country::select($columns)
        ->where('status', ACTIVE_STATUS);

    if ($countryId) {
        return $query->where('id', $countryId)->first();
    }

    return $query->orderBy('name')->get();
}

function modifyTable($html)
{
    if (!$html) return $html;

    // 1. Ensure table has classes
    $html = preg_replace(
        '/<table(?![^>]*class=)/i',
        '<table class="table table-bordered course-table"',
        $html
    );

    // 2. Append classes if table already has class
    $html = preg_replace_callback('/<table([^>]*)class="([^"]*)"/i', function ($m) {
        return '<table' . $m[1] . 'class="' .
            trim($m[2] . ' table table-bordered course-table') . '"';
    }, $html);

    // 3. Fix table width inside style to width:100%
    $html = preg_replace_callback(
        '/<table([^>]*)style="([^"]*)"/i',
        function ($m) {
            $style = $m[2];
            $style = preg_replace('/width\s*:\s*[^;"]+/', 'width:100%', $style);
            return '<table' . $m[1] . 'style="' . $style . '"';
        },
        $html
    );

    // 4. Add style="width:100%" if table has no style
    $html = preg_replace(
        '/<table(?![^>]*style=)/i',
        '<table style="width:100%"',
        $html
    );

    // 5. Add class table-head to first tr inside each tbody
//    $html = preg_replace(
//        '/<tbody>\s*<tr/i',
//        '<tbody><tr class="table-head"',
//        $html
//    );

    $html = preg_replace_callback('/<table\b[^>]*>.*?<\/table>/is', function ($tableMatch) {
        $table = $tableMatch[0];

        // If table has thead, add table-head to first tr inside thead
        if (preg_match('/<thead\b[^>]*>.*?<tr\b/is', $table)) {
            return preg_replace(
                '/(<thead\b[^>]*>.*?<tr\b)(?![^>]*class=)/is',
                '$1 class="table-head"',
                $table,
                1
            );
        }

        // If no thead, old approach: add table-head to first tr inside tbody
        return preg_replace(
            '/(<tbody\b[^>]*>\s*<tr\b)(?![^>]*class=)/is',
            '$1 class="table-head"',
            $table,
            1
        );
    }, $html);

    return $html;
}

function format_course_name(string $text): string
{
    $value = str_replace('-', ' ', $text);

    $value = preg_replace_callback('/<mark>(.*?)<\/mark>/i', function ($matches) {
        return '<mark>' . ucwords($matches[1]) . '</mark>';
    }, $value);

    $value = preg_replace_callback('/\b(?!<mark>)([a-z]+)\b/i', function ($matches) {
        return ucwords($matches[1]);
    }, $value);

    return $value;
}

function universityProviderType()
{
    return \App\Models\Provider::where('status', ACTIVE_STATUS)->get();
}

function universityStudyAreas()
{
    return \App\Models\StudyArea::where('status', ACTIVE_STATUS)->get();
}

function universityStudyLevels()
{
    return \App\Models\StudyLevel::where('status', ACTIVE_STATUS)->get();
}

function getSeoInfo($tableName,$slug)
{
    return DB::table($tableName)->select('seo_title','seo_keyword','seo_description')->where('slug',$slug)->first();
}

function getStudiesArea($count)
{
    return StudyArea::select('name','slug')->where('status', ACTIVE_STATUS)->orderBy('name')->take($count)->get();
}

function getStudyDestinations()
{
    $selectedSessionCountry = session()->get('selected_country');

    return Country::query()
        ->select('name', 'slug')
        ->where('status', ACTIVE_STATUS)
        ->when($selectedSessionCountry === 'australia', function ($q) {
            $q->where('slug', 'australia');
        })
        ->orderBy('name')
        ->get();
}

function getPhoneCode($countryCode)
{
    $codes = [
        'bangladesh' => '+880',
        'india' => '+91',
        'sri-lanka' => '+94',
        'australia' => '+61',
    ];

    return $codes[$countryCode] ?? '';
}



