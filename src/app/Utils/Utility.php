<?php
namespace App\Utils;

class Utility
{
    public static function generateRandomString($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * Get UNIX timestamp in microseconds
     *
     * @return int  Timestamp in microseconds
     */
    public static function getUnixTimestamp()
    {
        return floor(microtime(true) * 1000);
    }

    public static function underScore2Camel($variable)
    {
        $variableName = "";
        if (strstr($variable, '_')) {
            $field_name_array = explode('_', $variable);
            foreach ($field_name_array as $index => $word) {
                $variableName .= ucfirst($word);
            }
        } else {
            $variableName .= ucfirst($variable);
        }
        return $variableName;
    }

    public static function generateDateSequence($startDate, $endDate)
    {
        // 将输入的日期字符串转换为 DateTime 对象
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        // 初始化日期序列数组
        $dates = [];
        // 使用日期迭代器生成日期序列
        for ($date = $start; $date <= $end; $date->modify('+1 day')) {
            // 将日期添加到数组中，这里使用日期的字符串格式
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public static function days($date,$dateAnother)
    {
        $timestamp = strtotime($date);
        $timestampAnother = strtotime($dateAnother);

        $diffInSeconds = abs($timestampAnother - $timestamp);
        return floor($diffInSeconds / (60 * 60 * 24));
    }


}
