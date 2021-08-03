<?php

namespace mfw;

class UrlParse
{
    public function __construct(
        private array $urlArray = [],
        private array $urlQuery = []
    )
    {
        $this->urlArray = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->urlQuery = explode('&', parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
    }

    /**
     * @return array
     * Возвращает массив частей URL разделённых /
     */

    public function getUrlArray() :array
    {
        return $this->urlArray;
    }

    /**
     * @return int
     * Возвращает количество элементов в массиве URL
     */

    public function getCountUrlArray() :int
    {
        return count($this->getUrlArray());
    }

    /**
     * @param int $num
     * @return string
     * 
     * Возвращает значение массива URL по ключу
     * Если значение ключа больше чем элеменов массива
     * вернёт пустую строку
     */

    public function getByNumUrlArray($num) :string
    {
        if(!is_int($num)) {
            throw new \Exception('Передан неверный тип параметра в метод ' . __METHOD__ .
            ' здесь ожидается число');
        }

        $url = $this->urlArray;
        
        $col = $this->getCountUrlArray();

        if($num >= $col) {
            return '';
        }
        
        // if ($num == $col) {
        //     return '';
        // }

        return $url[$num];
        
    }
}