<?php


class CustomizableInputField extends Text
{

    /**
     * @return string
     */
    public function forTemplate() {
        return self::Strval($this->value);
    }

    public static function Strval($value = '')
    {
        $strval = '';

        if(empty($value)) {
            return $value;
        }

        $parts = json_decode($value);

        if(empty($parts)) {
            return $strval;
        }

        foreach ($parts as $part) {
            $whitespace = (int) $part->whitespaces === 1 ? ' ' : '';
            $strval .= $part->before . $whitespace . $part->val . $whitespace . $part->after;
        }

        return $strval;
    }

    public function Parts()
    {
        $parts = json_decode($this->value);

        $items = array();
        if ($parts) {
            foreach ($parts as $key => $item) {
                $obj = new ArrayData(array(
                    'Value' => $item->val,
                    'Before' => $item->before,
                    'After' => $item->after
                ));
                $items[] = $obj;
            }
        }
        return new ArrayList($items);
    }

}