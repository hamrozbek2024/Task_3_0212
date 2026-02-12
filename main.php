<?php
// 3-MASALA: KMP (Substring qidirish)

function buildLPS($pattern) {
    $lps = array_fill(0, strlen($pattern), 0);
    $len = 0;
    $i = 1;

    while ($i < strlen($pattern)) {
        if ($pattern[$i] == $pattern[$len]) {
            $len++;
            $lps[$i] = $len;
            $i++;
        } else {
            if ($len != 0) {
                $len = $lps[$len - 1];
            } else {
                $lps[$i] = 0;
                $i++;
            }
        }
    }
    return $lps;
}

function kmp($text, $pattern) {
    $lps = buildLPS($pattern);
    $i = 0; $j = 0;

    while ($i < strlen($text)) {
        if ($text[$i] == $pattern[$j]) {
            $i++; $j++;
        }
        if ($j == strlen($pattern)) {
            return $i - $j;
        } elseif ($i < strlen($text) && $text[$i] != $pattern[$j]) {
            if ($j != 0) $j = $lps[$j - 1];
            else $i++;
        }
    }
    return -1;
}

echo kmp("ababcabcabababd", "ababd");
