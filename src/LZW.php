<?php

/**
 * Implementation from http://rosettacode.org/wiki/LZW_compression#PHP
 *
 */

namespace Openbitapp\LZW;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class LZW implements Jsonable, Arrayable
{
    protected $data;

    /**
     * Compress the given string using LZW Algorithm
     *
     * @param string $unc
     * @return self
     */
    public function compress(string $unc)
    {
        $w = '';
        $dictionary = [];
        $result = [];
        $dictSize = 256;

        for ($i = 0; $i < 256; $i += 1) {
            $dictionary[chr($i)] = $i;
        }

        for ($i = 0; $i < strlen($unc); $i++) {
            $c = $unc[$i];
            $wc = $w . $c;

            if (array_key_exists($w . $c, $dictionary)) {
                $w = $w . $c;
            } else {
                $result[] = $dictionary[$w];
                $dictionary[$wc] = $dictSize++;
                $w = (string) $c;
            }
        }

        if ($w !== '') {
            $result[] = $dictionary[$w];
        }

        $this->data = $result;

        return $this;
    }

    /**
     * Return the compressed data as string
     * 
     * @return string
     */
    public function toString(): string
    {
        if (empty($this->data)) {
            return '';
        }

        return implode(',', $this->data);
    }

    /**
     * Return the compressed data as array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data ?? [];
    }

    /**
     * Return the compressed data as array
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->data ?? [], $options);
    }

    /**
     * Decompress the given string using LZW Algorithm
     *
     * @param string|array $unc
     * @return string
     */
    public function decompress($com): string
    {
        if (!is_array($com)) {
            $com = explode(',', $com);
        }

        $dictionary = [];
        $entry = '';
        $dictSize = 256;

        for ($i = 0; $i < 256; $i++) {
            $dictionary[$i] = chr($i);
        }

        $w = chr($com[0]);
        $result = $w;

        for ($i = 1; $i < count($com); $i++) {
            $k = $com[$i];

            if ($dictionary[$k]) {
                $entry = $dictionary[$k];
            } else {
                if ($k === $dictSize) {
                    $entry = $w . $w[0];
                } else {
                    return null;
                }
            }

            $result .= $entry;
            $dictionary[$dictSize++] = $w . $entry[0];
            $w = $entry;
        }

        return $result;
    }

    /**
     * Return the compressed data as string
     * 
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
