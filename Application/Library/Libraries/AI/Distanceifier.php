<?php
/**
 * Skytells PHP Framework --------------------------------------------------*
 * @category   Web Development ( Programming )
 * @package    Skytells PHP Framework
 * @version 2.3
 * @license Freeware
 * @copyright  2007-2017 Skytells, Inc. All rights reserved.
 * @license    https://www.skytells.net/us/terms  Freeware.
 * @author Dr. Hazem Ali ( fb.com/Haz4m )
 * @see The Framework's changelog to be always up to date.
 */

  Namespace Skytells\Libraries\AI;
  Class Distanceifier extends \Skytells\Core\AI{
    private $_lat;
    private $_lon;

    public function train($lat, $lon) {
      $this->_lat = $lat;
      $this->_lon = $lon;
      return $this;
    }
    public function getDetails() {
      try {
        if (!isset($this->_lat) || !isset($this->_lon)) {
          throw new ErrorException("AI Error: Cannot get details with empty trained values.", 1);
        }
        $deal_lat = $this->_lat;
        $deal_long = $this->_lon;
        $geocode = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$deal_lat.','.$deal_long.'&sensor=false');
        return $geocode;
      } catch (Exception $e) {
        throw new Exception($e->getMessage(), 1);

      }

    }
    public function learn() {
      try {
        $IsLearned = ($this->getLearned() == false ) ? false : true;
        if ($IsLearned == false) { $trained =  $this->getDetails(); } else { return $this->getLearned(); }
        if (!empty($trained)) {
          if(file_put_contents(AI_STORAGE_DIR."Geo/". md5($this->_lat.$this->_lon),$trained)) {
              return $this;
            }
        }else{
          return $this;
        }
      } catch (Exception $e) {
        throw new Exception("AI Error: " . $e->getMessage(), 1);

      }

    }
    public function getAddress() {
      $geoData = json_decode($this->getLearned());
      if(isset($geoData->results[0])) {
          $return = array();
          foreach($geoData->results[0]->address_components as $addressComponet) {
              if(in_array('political', $addressComponet->types)) {
                  if($addressComponet->short_name != $addressComponet->long_name)
                      $return[] = $addressComponet->short_name. " - " . $addressComponet->long_name;
                  else
                      $return[] = $addressComponet->long_name;
              }
          }
          return implode(", ",$return);
      }
      return null;
    }
    public function getLearned() {
      try {
        $file = AI_STORAGE_DIR."Geo/". md5($this->_lat.$this->_lon);
        if (!file_exists($file)) {
          return false;
        }
        return file_get_contents($file);
      } catch (Exception $e) {
        throw new Exception($e->getMessage(), 1);

      }
    }
    
    public function getCountry() {
      $geocode=$this->getLearned();
      $output= json_decode($geocode);
      for($j=0;$j<count($output->results[0]->address_components);$j++){
          $cn=array($output->results[0]->address_components[$j]->types[0]);
          if(in_array("country", $cn)){
              $country= $output->results[0]->address_components[$j]->long_name;
          }
      }

      return $country;
    }
    public function getDistanceTo($lat2, $lon2, $unit) {
      if (empty($this->_lat) || empty($this->_lon)) {
        throw new ErrorException("AI Error: Cannot get details with empty trained values.", 1);
      }
      $lat1 = $this->_lat;
      $lon1 = $this->_lon;
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);

      if ($unit == "K") {
        return ($miles * 1.609344);
      } else if ($unit == "N") {
          return ($miles * 0.8684);
        } else {
            return $miles;
          }
    }

  }
