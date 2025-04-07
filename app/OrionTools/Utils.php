<?php

namespace App\OrionTools;

use Exception;
use stdClass;

final class Utils
{
    public static function jsonDecode(string $json, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        if (\function_exists('json_validate')) {
            if (! \json_validate($json)) {
                throw new \InvalidArgumentException('json_decode error: json validate is false ');
            }

            return \json_decode($json, $assoc, $depth, $options);
        }
        /** @from : GuzzleHttp/GuzzleHttp/Utils */
        $data = \json_decode($json, $assoc, $depth, $options);
        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('json_decode error: '.\json_last_error_msg());
        }

        return $data;
    }

    /** @from : GuzzleHttp/GuzzleHttp/Utils */
    public static function jsonEncode(mixed $value, int $options = 0, int $depth = 512): string
    {
        $data = \json_encode($value, $options, $depth);
        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('json_encode error: '.\json_last_error_msg());
        }

        return $data;
    }

    /** @from : GuzzleHttp/GuzzleHttp/Utils */
    public static function currentTime(): float
    {
        return (float) \function_exists('hrtime') ? \hrtime(true) / 1e9 : \microtime(true);
    }

    public static function arrayToObject(array $array): object
    {
        try {
            $data = self::jsonDecode(self::jsonEncode($array));
        } catch (Exception $e) {
            throw new \InvalidArgumentException('array_to_object error :'.$e->getMessage());
        }

        if (! \is_object($data)) {
            $data = (object) $data;
        }

        return $data;
    }

    public static function objectToArray(object $object): array
    {
        try {
            $data = self::jsonDecode(self::jsonEncode($object), true);
        } catch (Exception $e) {
            throw new \InvalidArgumentException('object_to_array error :'.$e->getMessage());
        }

        return $data;
    }

    /**
     * Converts an array to truth object
     * Truth object : is an object contains instances of classes
     *
     * @param array {$array}
     *
     * @example :
     *
     *     class Tester
     *     {
     *         public function test(): string
     *         {
     *             return 'Hello';
     *         }
     *     }
     *
     *     $array = [
     *         'intances' => [
     *             'tester' => new Tester()
     *         ]
     *     ];
     *     $object = Utils::arrayToTruthObject($array);
     *     $object->instances->tester->test(); //Hello
     *
     *     @author : Ajmal Alkhaledi <ajmalalkhaledi@gmail.com>
     */
    public static function arrayToTruthObject(array $array): stdClass
    {
        $object = new stdClass;
        foreach ($array as $key => $value) {
            $object->$key = is_array($value) ? self::arrayToTruthObject($value) : $value;
        }

        return $object;
    }
}
