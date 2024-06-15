<?php
class convertDate
{
    public function convertDateToDayTimestamp($dateString) {
        if (!$dateString) return null;
        $parts = explode('/', $dateString);
        $day = intval($parts[0]);
        $month = intval($parts[1]);
        $year = intval($parts[2]);
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh")); // Sử dụng múi giờ của Việt Nam
        $date->setDate($year, $month, $day);
        $date->setTime(0, 0, 0);

        return ceil($date->getTimestamp() / 86400); // 86400 là số giây trong một ngày
    }
}
