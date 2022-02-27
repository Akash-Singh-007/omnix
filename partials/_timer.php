<?php
if ($sting_atime < 2) {
    $display_time = floor($sting_atime) . ' second ago';
} elseif ($sting_atime >= 2 && $sting_atime <= 60) {
    $display_time = floor($sting_atime) . ' seconds ago';
} elseif ($sting_atime > 60 && $sting_atime < 120) {
    $display_time = floor($sting_atime / 60) . ' minute ago';
} elseif ($sting_atime >= 120 && $sting_atime <= 3600) {
    $display_time = floor($sting_atime / 60) . ' minutes ago';
} elseif ($sting_atime > 3600 && $sting_atime < 7200) {
    $display_time = floor($sting_atime / 3600) . ' hour ago';
} elseif ($sting_atime >= 7200 && $sting_atime <= 86400) {
    $display_time = floor($sting_atime / 3600) . ' hours ago';
} elseif ($sting_atime > 86400 && $sting_atime < 172800) {
    $display_time = floor($sting_atime / 86400) . ' day ago';
} elseif ($sting_atime >= 172800 && $sting_atime <= 604800) {
    $display_time = floor($sting_atime / 86400) . ' days ago';
} elseif ($sting_atime > 604800 && $sting_atime < 1209600) {
    $display_time = floor($sting_atime / 604800) . ' week ago';
} elseif ($sting_atime >= 1209600 && $sting_atime <= 2592000) {
    $display_time = floor($sting_atime / 604800) . ' weeks ago';
} elseif ($sting_atime > 2592000 && $sting_atime < 5184000) {
    $display_time = floor($sting_atime / 2592000) . ' month ago';
} elseif ($sting_atime >= 5184000 && $sting_atime <= 31536000) {
    $display_time = floor($sting_atime / 2592000) . ' months ago';
} elseif ($sting_atime >= 31536000 && $sting_atime <= 63072000) {
    $display_time = floor($sting_atime / 31536000) . ' year ago';
} else {
    $display_time = floor($sting_atime / 31536000) . ' years ago';
}
?>