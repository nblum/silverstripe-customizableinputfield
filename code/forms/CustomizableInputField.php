<?php


class CustomizableInputField extends Text
{

    /**
     * @return string
     */
    public function forTemplate()
    {
        return self::Strval($this->value);
    }

    /**
     * returns given part value to template
     * @example $Var.Part(1)
     * @return bool
     */
    public function Part($number = 0)
    {
        $parts = json_decode($this->value);
        return isset($parts[$number]) ? $parts[$number]->val : null;
    }

    /**
     * checkes whether at least one part is not empty
     * @return bool
     */
    public function NotEmpty()
    {
        return !$this::isEmpty($this->value);
    }

    /**
     * @param $field
     * @return bool
     */
    public static function isEmpty($field)
    {
        $parts = json_decode($field);

        if (empty($parts)) {
            return true;
        }

        foreach ($parts as $part) {
            if (!empty(trim($part->val))) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function Val()
    {
        $parts = json_decode($this->value);
        $first = array_shift($parts);
        return $first->val;
    }

    /**
     * @param array $selectedParts parts to convert to float eg [1,3]
     * @return float
     */
    public function Float($selectedParts = [])
    {
        return floatval(preg_replace('/,/', '.', self::Strval($this->value, $selectedParts)));
    }

    /**
     * formats the float value as currency
     * use setlocale(LC_MONETARY, 'de_DE.utf8'); in your config file for correct format
     * @return string
     */
    public function Money()
    {
        $args = func_get_args();
        return money_format('%+n', $this->Float($args));
    }

    /**
     * formats the float value as currency
     * use setlocale(LC_MONETARY, 'de_DE.utf8'); in your config file for correct format
     * @return string
     */
    public function Phone()
    {
        return self::formatPhone($this->value);
    }

    /**
     * @param $value
     * @return string
     */
    public static function formatPhone($value)
    {
        $parts = json_decode($value);
        $number = preg_replace('/([0-9]{2})/', '$0 ', $parts[1]->val);
        return sprintf('+49 (0) %s / %s', $parts[0]->val, $number);
    }


    /**
     * @param string $value
     * @param array $selectedParts array of parts to output [1,3]
     * @return string
     */
    public static function Strval($value = '', $selectedParts = [])
    {
        $strval = '';

        if (empty($value)) {
            return $value;
        }

        $parts = json_decode($value);

        if (empty($parts)) {
            return $strval;
        }

        if (!empty($selectedParts)) {
            $selectedParts = array_map('intval', $selectedParts);
        }

        foreach ($parts as $key => $part) {
            if (empty($selectedParts) || (!empty($selectedParts) && in_array($key, $selectedParts))) {
                $whitespace = (int)$part->whitespaces === 1 ? ' ' : '';
                $strval .= $part->before . $whitespace . $part->val . $whitespace . $part->after;
            }
        }
        return $strval;
    }

    /**
     * @return ArrayList
     */
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
