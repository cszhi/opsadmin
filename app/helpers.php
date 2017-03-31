<?php

use App\Models\Log;

function l($h, $i, $c, $t) {
	Log::create([
		'hostname' => $h,
		'ip' => $i,
		'content' => $c,
		'token' => $t,
	]);
}

function modifyEnv(array $data) {
	$envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
	$contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
	$contentArray->transform(function ($item) use ($data) {
		foreach ($data as $key => $value) {
			if (str_contains($item, $key)) {
				return $key . '=' . $value;
			}
		}
		return $item;
	});
	$content = implode($contentArray->toArray(), "\n");
	\File::put($envPath, $content);
}

use Carbon\Carbon;
if(!function_exists('getTime')){
	function getTime($time, $status = True){
		$newTime = new Carbon($time);

		if($status){
			return $newTime->startOfDay();
		}
		return $newTime->endOfDay();
	}
}
