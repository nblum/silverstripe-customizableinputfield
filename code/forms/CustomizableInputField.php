<?php


class CustomizableInputField extends Text
{

    /**
     * @return string
     */
    public function forTemplate() {
        return self::Strval($this->value);
    }

    /**
     * checkes whether at least one part is not empty
     * @return bool
     */
    public function NotEmpty()
    {
        return !$this::isEmpty($this->value);
    }

    public static function isEmpty($field)
    {
        $parts = json_decode($field);

        if(empty($parts)) {
            return true;
        }

        foreach ($parts as $part) {
            if(!empty(trim($part->val))) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function Val() {
        $parts = json_decode($this->value);
        $first = array_shift($parts);
        return $first->val;
    }

    /**
     * @return string
     */
    public function Float() {
        return floatval(preg_replace('/,/', '.',self::Strval($this->value)));
    }

    /**
     * formats the float value as currency
     * use setlocale(LC_MONETARY, 'de_DE.utf8'); in your config file for correct format
     * @return string
     */
    public function Money() {
        return money_format('%+n', $this->Float());
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
