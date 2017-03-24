<?
namespace Skytells\Helpers\Money;

  Class CurrencyConverter {


    public $__CFROM;
    public $__CTO;
    public $__AMOUNT;

    public function from($value='')
    {
      if (!isset($value) && empty($value))
      {
        throw new Exception("You need to bypass the currency code, which will be used to convert from it.", 1);
      }
      $this->__CFROM = $value;
      return $this;
    }

    public function to($value='')
    {
      if (!isset($value) && empty($value))
      {
        throw new Exception("You need to bypass the currency code, which will be used to convert into it.", 1);
      }
      $this->__CTO = $value;
      return $this;

    }

    public function convert($value='')
    {
      if (!isset($value) && empty($value))
      {
        throw new Exception("You need to bypass the value", 1);
      }

      $this->__AMOUNT = $value;
      return $this->convertQuick($this->__AMOUNT, $this->__CFROM, $this->__CTO);
    }
    function convertQuick($amount, $from, $to){
    	$data = HttpRequest("https://www.google.com/finance/converter?a=$amount&from=$from&to=$to");
    	preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    	$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    	return number_format(round($converted, 3),2);
    }
  }
