<?php
class DateFormat {
    public static function timeAgo($datetime) {
        // Convert the stored date into a timestamp
        $timestamp = strtotime($datetime);
        
        // Get the current time
        $now = time();
        
        // Find the difference in seconds
        $difference = $now - $timestamp;
        
        $minutes = floor($difference / 60);
        $hours = floor($difference / (60 * 60));
        $days = floor($difference / (60 * 60 * 24));
        $months = floor($difference / (60 * 60 * 24 * 30));
        $years = floor($difference / (60 * 60 * 24 * 365));
        
        if ($difference < 60) {
            return 'Now';
        } else if ($minutes < 60) {
            return $minutes . 'min';
        } else if ($hours < 24) {
            return $hours . 'h';
        } else if ($days < 30) {
            return $days . 'd';
        } else if ($months < 12) {
            return $months . 'mo';
        } else {
            return $years . 'y';
        }
    }
    
    public static function timeAgoFull($datetime) {
        // Convert the stored date into a timestamp
        $timestamp = strtotime($datetime);
        
        // Get the current time
        $now = time();
        
        // Find the difference in seconds
        $difference = $now - $timestamp;
        
        $minutes = floor($difference / 60);
        $hours = floor($difference / (60 * 60));
        $days = floor($difference / (60 * 60 * 24));
        $months = floor($difference / (60 * 60 * 24 * 30));
        $years = floor($difference / (60 * 60 * 24 * 365));
        
        if ($difference < 60) {
            return 'just now';
        } else if ($minutes < 60) {
            if ($minutes == 1) {
                return '1 minute ago';
            } else {
                return $minutes . ' minutes ago';
            }
        } else if ($hours < 24) {
            if ($hours == 1) {
                return '1 hour ago';
            } else {
                return $hours . ' hours ago';
            }
        } else if ($days < 30) {
            if ($days == 1) {
                return '1 day ago';
            } else {
                return $days . ' days ago';
            }
        } else if ($months < 12) {
            if ($months == 1) {
                return '1 month ago';
            }
            return $months . ' months ago';
        } else {
            if ($years == 1) {
                return '1 year ago';
            } else {
                return $years . ' years ago';
            }
        }
    }
    
    public static function formatDateTime($datetime) {
        // Convert the stored date into a timestamp
        $timestamp = strtotime($datetime);
        
        // Format the date
        $dateFormatted = date('F j, Y', $timestamp);
        
        return $dateFormatted;
    }
}
