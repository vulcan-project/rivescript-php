<?php

namespace Vulcan\Rivescript\Interpreter\Tags;

class Star
{
    /**
     * Regex expression pattern.
     *
     * @var string
     */
    public $pattern = '/<star(([0-9])?)>/i';

    /**
     * Parse the response.
     *
     * @param  string  $response
     * @param  array  $data
     * @return string
     */
    public function parse($response, $data)
    {
        preg_match_all($this->pattern, $response, $matches);

        if (isset($matches[1])) {
            $search = $matches[0];

            foreach ($matches[1] as $match) {
                if (empty($match)) {
                    $match = 0;
                } else {
                    $match--;
                }

                if (isset($data['stars'][$match])) {
                    $replace[] = $data['stars'][$match];
                } else {
                    $replace[] = '';
                }
            }

            if (isset($replace)) {
                $response = str_replace($search, $replace, $response);
            }
        }

        return [
            'response' => $response,
            'metadata' => isset($metadata) ? $metadata : []
        ];
    }
}
