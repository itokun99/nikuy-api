<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper
{
  static function getSubscribeAndExpired($masaBerlaku)
  {

    $data = new \stdClass;
    $timenow = Carbon::now();
    $format = 'Y-m-d H:i:s';
    $sub = $timenow->format($format);
    $data->subscribe_at = $sub;
    $data->expired_at = NULL;

    if ($masaBerlaku != "Free" && $masaBerlaku != "Selamanya") {
      $mas = Str::of($masaBerlaku)->explode(" ");
      if ($mas[0] && $mas[1]) {
        $value = $mas[0];
        $type = $mas[1];

        switch ($type) {
          case "Hari";
            $data->expired_at = $timenow->addDays((int)$value)->format($format);
            break;
          case "Minggu";
            $data->expired_at = $timenow->addWeeks((int)$value)->format($format);
            break;
          case "Bulan";
            $data->expired_at = $timenow->addMonths((int)$value)->format($format);
            break;
          case "Tahun";
            $data->expired_at = $timenow->addYears((int)$value)->format($format);
            break;
          default:
            break;
        }
      }
    }

    return $data;
  }

  static function showPrice($price)
  {
    if ($price > 0) {
      return 'IDR ' . number_format($price, 0, ',', '.');
    } else if (!is_null($price) && $price == 0) {
      return 'FREE';
    } else {
      return NULL;
    }
  }

  static function getTimeNow($format = 'Y-m-d H:i:s')
  {
    return Carbon::now()->format($format);
  }

  static function getPublicPath()
  {
    if (env('APP_ENV') == 'production') {
      return '/home/u1367281/public_html/';
    }
    return base_path() . '/public/';
  }

  static function formatDate($datetime = NULL, $format = NULL)
  {
    if (!$datetime) return NULL;

    $dt = Carbon::createFromFormat('Y-m-d H:i:s', $datetime);

    if ($format) {
      return $dt->translatedFormat($format);
    }

    return $dt->translatedFormat('H:i, d F Y');
  }

  static function getDefaultImage()
  {
    return env('APP_URL', 'http://localhost:8000') . '/assets/img/nofoto.png';
  }

  static function getFile($type = NULL, $image = NULL)
  {
    if (!$image) {
      return Helper::getDefaultImage();
    }
    return env('APP_URL', 'http://localhost:8000') . '/' . Helper::getAssetPath($type) . '/' . $image;
  }

  static function getAssetPath($type = NULL)
  {
    switch ($type) {
      case 'kelas':
        return 'assets/foto/kelas';
      case 'kursus':
        return 'assets/foto/kursus';
      case 'paket':
        return 'assets/foto/paket';
      case 'event':
        return 'assets/foto/event';
      case 'sosmed':
        return 'assets/foto/sosmed';
      case 'bisnis':
        return 'assets/foto/bisnis';
      case 'transaksi':
        return 'assets/foto/struk';
      case 'banner':
        return 'assets/foto/slider';
      case 'author':
        return 'assets/foto/author';
      case 'bank':
        return 'assets/foto/img';
      default:
        return 'uploads/photo';
    }
  }
}
