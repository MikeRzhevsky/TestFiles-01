<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class RandomValue extends Model
{
    protected $table = 'random_value';
    public $timestamps = false;



    public function generate($length = NULL,$type = NULL, $abc = NULL)
    {
        if($length !== NULL)
        {
            $minValue = pow(10, $length - 1);
            $maxValue = pow(10, $length) - 1;


            if($type == 'guid')
            {
                 return (string)Str::uuid();
            }
            elseif($type == 'string')
            {
                 $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                 $alphabetLength = strlen($alphabet) - 1;

                 $result = '';
                 for($i = 0; $i <= $length;$i++)
                 {
                     $result .= $alphabet[mt_rand(0,$alphabetLength)];
                 }
                 return $result;
            }
            elseif($type == 'number')
            {
                 //return mt_rand($minValue, $maxValue);
                $alphabet = '0123456789';
                $alphabetLength = strlen($alphabet) - 1;
                $result = "";
                for($i = 0; $i < $length;$i++)
                {
                    $result .= $alphabet[mt_rand(0,$alphabetLength)];
                }
                return $result;

            }
            elseif($type == 'alphabetNumeric')
            {
                $alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $alphabetLength = strlen($alphabet) - 1;
                $result = "";
                for($i = 0; $i < $length;$i++)
                {
                    $result .= $alphabet[mt_rand(0,$alphabetLength)];
                }
                return $result;
            }
            elseif($type == 'settedValue' & $abc !== NULL)
            {
                $alphabet = $abc;
                $alphabetLength = strlen($alphabet) - 1;
                $result = "";
                for($i = 0; $i < $length;$i++)
                {
                    $result .= $alphabet[mt_rand(0,$alphabetLength)];
                }
                return $result;
            }
            else
            {
                return mt_rand($minValue,$maxValue);
            }

        }
        else
        {
            return mt_rand();
        }
    }

    public function retrieve($requestId = NULL)
    {
        // generate(length: ,type: ,abc: )
        // Argument length - длина сгенерированного значения
        // Argument type - тип сгенерированного значения
        // Надо указывать тип, иначе будет сгенерированно рандомное число,
        // без привязки к длине
        // *Argument abc - набор символов,из которых будет сгенерированно значение,
        // при Argument type =  'settedValue'. Пример: '152hgA'
        // Argument abc указывается при Argument type =  'settedValue'
        // При Argument type = 'guid' , length указывается любой(кроме NULL)
        // Доступные type: 'guid','string','number','alphabetNumeric','settedValue'

        $number = $this->generate(8,'number');

        if($requestId !== NULL)
        {
            $result = RandomValue::where('id', $requestId)->get();
            if ($result == NULL)
            {
                return 'Row with this ID is not finding';
            }
            else
            {
                return $result->toArray();
            }
        }
        else
        {
            $result = new RandomValue();
            $result->str_value = $number;
            $result->save();

            //$result = RandomValue::orderBy('id', 'desc')->take(1)->get();

            return $result->toArray();
        }
    }
}
